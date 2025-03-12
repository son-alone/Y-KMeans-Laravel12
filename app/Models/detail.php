<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_yudisium',
        'id_prodi',
        'npm',
        'nama_mhs',
        'ipk',
        'jml_sks',
        'tgl_masuk',
        'jk',
    ];
}
