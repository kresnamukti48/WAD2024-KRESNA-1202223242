<?php

class AuthController
{
    private $conn;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once 'config/database.php';
        $this->conn = $conn;
    }

    public function login()
    {
        $conn = $this->conn;
        if (isset($_POST['submit'])) {

            // TODO: Lengkapi fungsi login dengan langkah berikut:
            // 1. Ambil nim dan password dari form login
            $nim = $_POST['nim'];
            $password = $_POST['password'];
            // 2. Buat query untuk mencari mahasiswa berdasarkan NIM
            $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            // 3. Eksekusi query menggunakan mysqli_query
            $result = mysqli_query($conn, $query);
            // 4. Ambil hasil query menggunakan mysqli_fetch_assoc
            $data = mysqli_fetch_assoc($result);
            // 5. Cek apakah mahasiswa ditemukan
            if (mysqli_num_rows($result) == 1){

            
            // 6. Jika ditemukan, verifikasi password menggunakan password_verify
                if(password_verify($password, $data['password'])){

            
            // 7. Jika password benar:
            //    - Set session login = true
            //    - Set session user dengan data mahasiswa
            //    - Set session message dengan "Login Berhasil"
            //    - Jika remember_me dicentang, buat cookie untuk nim dan password
            //    - Redirect ke halaman dashboard menggunakan (header('Location: index.php?controller=dashboard&action=index'))
            //    - Jangan lupa exit setelah redirect
                    $_SESSION["login"] = true;
                    $_SESSION["nim"] = $data["nim"];
                    $_SESSION["password"] = $data["password"];
                    $_SESSION['message'] = "Login Berhasil";
                    if(isset($_POST["remember_me"])){
                        setcookie("nim", $nim, time() + (86400 * 30), "/");
                        setcookie("password", $password, time() + (86400 * 30), "/");
                    }else{
                        setcookie("id", "", time() - 3600, "/"); 
                    }
                    header('Location: index.php?controller=dashboard&action=index');
                    exit;
                }
            // 8. Jika password salah, set session message "Login Gagal NIM atau Password Salah"
                else{
                $_SESSION['message'] = "Login Gagal NIM atau Password Salah";
                }
            // 9. Jika mahasiswa tidak ditemukan, set session message "NIM Tidak Ditemukan"

        }else{
            $_SESSION['message'] = "NIM tidak ditemukan";
        }
    }

        include 'views/auth/login.php';
    }

    private function getJurusan($jurusan){
        // TODO: Lengkapi fungsi untuk mendapatkan kode jurusan
        // 1. Buat variabel $kode_jurusan dengan nilai default 0
        $kode_jurusan = 0;
        
        // 2. Gunakan switch-case atau if-else untuk mengatur kode jurusan:
        //    - kedokteran = 11
        //    - psikologi = 12
        //    - biologi = 13
        //    - teknik informatika = 14
        if($jurusan == "kedokteran"){
            $kode_jurusan = 11;
        }else if ($jurusan == "psikologi"){
            $kode_jurusan = 12;
        }else if ($jurusan == "biologi"){
            $kode_jurusan = 13;
        }else if ($jurusan == "teknik informatika"){
            $kode_jurusan = 14;
        }
        // 3. Return nilai kode_jurusan
        return $kode_jurusan;
    }

    private function generateNIM($id_pendaftaran){
        $conn = $this->conn;
        // TODO: Lengkapi fungsi untuk generate NIM dengan format: [kode_jurusan][tahun_masuk][id_pendaftaran]
        // 1. Buat query untuk mengambil data pendaftaran berdasarkan id_pendaftaran
        $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran'";
        // 2. Eksekusi query dan ambil hasilnya
        $result = mysqli_query($conn, $query);
        // 3. Ambil tahun sekarang dalam format 2 digit menggunakan date('y')
        $year = date('y');
        // 4. Jika data ditemukan:
        if (mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
        //    - Ambil data jurusan dari hasil query
            $jurusan = $data["jurusan"];
        //    - Dapatkan kode jurusan menggunakan fungsi getJurusan()
            $kode_jurusan = getJurusan($jurusan);
        //    - Jika kode jurusan valid (tidak 0):
        //      * Generate NIM dengan format: [kode_jurusan][tahun][id_pendaftaran_dengan_padding]
        //      * Gunakan str_pad untuk id_pendaftaran 2 digit
            if($kode_jurusan == 1){
                $nim = $kode_jurusan. $year. str_pad($id_pendaftaran,2, '0');
            }else{
                
        //    - Return false jika kode jurusan tidak valid
                return false;
            }
        // 5. Return false jika data tidak ditemukan
    }else{
        return false;
    }
    }

    public function register_step_1()
    {
        $conn = $this->conn;
        if (isset($_POST['submit'])) {
            // TODO: Lengkapi fungsi register step 1
            // 1. Ambil id_pendaftaran dari form register step 1
            $id_pendaftaran = $_POST['id_pendaftaran'];

            // 2. Buat query untuk mencari pendaftaran berdasarkan id_pendaftaran dengan status 'lulus'
            $query = "SELECT * FROM pendaftaran WHERE status = 'lulus'";
            // 3. Eksekusi query dan ambil hasilnya
            $result = mysqli_query($conn, $query);
            // 4. Jika ditemukan:
            //    - Set session id_pendaftaran dengan id_pendaftaran
            //    - Redirect ke register step 2 menggunakan (header('Location: index.php?controller=auth&action=register_step_2'))
            //    - Jangan lupa exit setelah redirect
            if (mysqli_num_rows($result) == 1) {
                $_SESSION["id_pendaftaran"] = $id_pendaftaran;
                header('Location: index.php?controller=auth&action=register_step_2');
                exit;
            // 5. Jika tidak ditemukan, set session message error
        }else{
            $_SESSION['message'] = "Error";
        }
        
        include 'views/auth/register_step_1.php';
    }
}

    public function register_step_2() 
    {
        $conn = $this->conn;
        // TODO: Cek apakah id_pendaftaran sudah ada di session
        // 1. Jika id_pendaftaran belum ada di session:
        //    - Redirect ke halaman register step 1
        //    - Gunakan header('Location: index.php?controller=auth&action=register_step_1')
        //    - Jangan lupa exit setelah redirect
        if(!isset($_SESSION['id_pendaftaran'])){
            header('Location: index.php?controller=auth&action=register_step_1');
            exit;
        }
        if (isset($_POST['submit'])) {
            // TODO: Ambil data dari form register step 2
            
            // 1. Ambil password dari form
            $password = $_POST['password'];
            // 2. Ambil confirm_password dari form
            $confirm_password = $_POST['confirm_password'];
        

            // TODO: Validasi password
            // 1. Cek apakah password sama dengan confirm_password
            if($password == $confirm_password){


            
            // 2. Jika sama:
                
            //    - Ambil id_pendaftaran dari session
                $id_pendaftaran = $_SESSION['id_pendaftaran'];
            //    - Buat query untuk mengambil data pendaftaran berdasarkan id_pendaftaran
                $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran'";
            //    - Eksekusi query menggunakan mysqli_query
                $result = mysqli_query($conn, $query);
            //    - Ambil hasil query menggunakan mysqli_fetch_assoc
                $data = mysqli_fetch_assoc($result);
            //    - Generate NIM menggunakan fungsi generateNIM()
                $nim = generateNIM($id_pendaftaran);
            //    
            //    - Buat query untuk cek apakah NIM sudah ada di database
                $query_nim = "SELECT nim FROM mahasiswa WHERE nim='$nim'";
            //    - Eksekusi query cek NIM
                $result_nim = mysqli_query($conn, $query);

            //    - Jika NIM sudah ada:
                if($result_nim > 0){
                    $_SESSION['message'] = "NIM sudah terdaftar";
                }else{
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $nama = $data['nama'];
                    $jurusan = $data['jurusan'];
                    $query = "INSERT INTO mahasiswa (nim, id_pendaftaran, password, nama, jurusan) VALUES ('$nim', '$id_pendaftaran', '$password', '$nama', '$jurusan')";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 1){
                        $_SESSION['message'] = "Berhasil menambahkan NIM: ". $nim;
                        unset($_SESSION['id_pendaftaran']);
                        header('Location: index.php?controller=auth&action=login');
                        exit;
                }else{
                    $_SESSION['message'] = "Register Gagal";
                }
            //      * Set session message "NIM sudah terdaftar"
            //    - Jika NIM belum ada:
            //      * Hash password menggunakan password_hash dengan PASSWORD_DEFAULT
            //      * Ambil nama dan jurusan dari data pendaftaran
            //      * Buat query INSERT untuk menyimpan data mahasiswa (nim, id_pendaftaran, password, nama, jurusan)
            //      * Eksekusi query INSERT
            //      * Jika berhasil:
            //        - Set session message berisi informasi berhasil dan NIM
            //        - Hapus session id_pendaftaran
            //        - Redirect ke halaman login menggunakan header('Location: index.php?controller=auth&action=login')
            //        - Exit setelah redirect
            //      * Jika gagal:
            //        - Set session message "Register Gagal"
            // 3. Jika password tidak sama:
            //    - Set session message "Password Tidak Cocok"
            }
        }else{
            $_SESSION['message'] = "Password Tidak Cocok";
        }

        include 'views/auth/register_step_2.php';
    }
}

    public function logout() 
    {
        // TODO: Implementasikan fungsi logout
        // 1. Hapus semua data session
        session_destroy();
        // 2. Redirect ke halaman login dengan:
        header('Location: index.php?controller=auth&action=login');
        exit;
        //    - Gunakan header('Location: index.php?controller=auth&action=login')
        //    - Jangan lupa exit setelah redirect
                
    }
}

?>