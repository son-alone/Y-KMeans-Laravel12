<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'mahasiswa'; // Pastikan nama tabel sesuai dengan yang ada di database

    public function programStudi()
    {
        return $this->belongsTo(Prodi::class);
    }
}


