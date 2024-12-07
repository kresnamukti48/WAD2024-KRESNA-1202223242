<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['kode_dosen', 'nama_dosen', 'nip', 'email', 'no_telepon'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
