<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pt',
        'id_prodi',
        'npm',
        'nama_mhs',
        'ipk',
        'jml_sks',
        'tgl_masuk',
        'jk',
    ];
    public function Prodi()
    {
        return $this->hasOne(Prodi::class, 'id', 'id_prodi');
    }
    public function Pt()
    {
        return $this->hasOne(Pt::class, 'id', 'id_pt');
    }
}
