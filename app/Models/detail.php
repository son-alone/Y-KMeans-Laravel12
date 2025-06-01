<?php

namespace App\Models;

use App\Http\Controllers\YudisiumController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_yudisium',
        'id_pt',
        'id_prodi',
        'id_batch',
        'npm',
        'nama_mhs',
        'ipk',
        'jml_sks',
        'tgl_masuk',
        'tgl_lulus',
        'jk',
    ];
    public function Yudisium()
    {
        return $this->hasOne(Yudisium::class, 'id', 'id_yudisium');
    }
    public function Prodi()
    {
        return $this->hasOne(Prodi::class, 'id', 'id_prodi');
    }
    public function Pt()
    {
        return $this->hasOne(Pt::class, 'id', 'id_pt');
    }
    public function Batch()
    {
        return $this->hasOne(Batch::class, 'id', 'id_batch');
    }
}
