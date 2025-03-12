<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ptprodi extends Model
{
    use HasFactory;

    protected $table = 'ptprodi';
    protected $primaryKey = 'id';

    protected $fillable = [
            'id_pt',
            'id_prodi',
            'jenjang',
            'akreditasi',
            'sk',
            'tanggal_berlaku',
            'jumlah_dosen',
            'jumlah_mahasiswa',
    ];
}
