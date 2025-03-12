<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class yudisium extends Model
{
    use HasFactory;

    protected $table = 'yudisium';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_batch',
        'id_pt',
        'tanggal_yudisium',
        'tanggal_verifikasi',
        'id_verifikator',
    ];
}
