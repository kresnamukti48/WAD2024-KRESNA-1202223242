<?php

include("dbconnection.php");

// buatkan function addStudent()
function addStudent()
{
    // variabel global
    global $conn;

    // Silakan buat variabel di bawah dengan data yang diambil dari form
    if (isset($_POST["submit"])){
        $nama = $_POST["stuname"];
        $nim = $_POST["stuid"];
        $jurusan = $_POST["stuclass"];
        $angkatan = $_POST["stuangkatan"];
    }



    // Periksa apakah NIM sudah ada
    $ret = mysqli_query($conn, "SELECT nim FROM tb_student WHERE nim=$nim");

    if (mysqli_num_rows($ret) == 0) {
        // Masukkan data ke tabel tb_student
        $query = "INSERT INTO tb_student (nama, nim, jurusan, angkatan) VALUES('$nama','$nim','$jurusan','$angkatan')";
        $result = mysqli_query($conn, $query);

        if($result > 0){
            echo '<script>alert("Student data has been added.")</script>';
            echo "<script>window.location.href ='add-students.php'</script>";
        }elseif($result <= 0){
            echo '<script>alert("Data gagal di tambahkan!")</script>';
            echo "<script>window.location.href ='manage-students.php'</script>";
        }
    }else{
        echo '<script>alert("Gagal, NIM Sudah ada!")</script>';
        echo "<script>window.location.href ='manage-students.php'</script>";
    }



        /**
         * Buatlah logika untuk Memeriksa hasil dari operasi penambahan data mahasiswa.
         * 
         * Jika operasi berhasil, menampilkan pesan bahwa mahasiswa telah ditambahkan
         * dan mengarahkan pengguna ke halaman 'add-students.php'.
         * Jika operasi gagal, menampilkan pesan kesalahan.
         * Jika NIM sudah ada, menampilkan pesan bahwa NIM sudah ada.
         */
        
    }


function editStudent($id) {
    global $conn;

    // Ambil input dari form dan simpan dalam variabel
    if (isset($_GET["submit"])){
        $nama = $_GET["stuname"];
        $nim = $_GET["stuid"];
        $jurusan = $_GET["stuclass"];
        $angkatan = $_GET["stuangkatan"];
    }
    

    // Update data mahasiswa berdasarkan ID
    $query = "UPDATE tb_student SET nama = '$nama', nim = '$nim', jurusan = '$jurusan', angkatan = '$angkatan' WHERE id =$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Student data has been updated.")</script>';
        echo "<script>window.location.href ='manage-students.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}


?>