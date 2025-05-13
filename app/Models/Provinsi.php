<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'provinsi';  // Gantilah dengan nama tabel sesuai database

    public function Pt()
    {
        return $this->hasMany(Pt::class);
    }
}
