<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptprodi extends Model
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

    public function Prodi()
    {
        return $this->hasOne(Prodi::class, 'id', 'id_prodi');
    }
    public function Pt()
    {
        return $this->hasOne(Pt::class, 'id', 'id_pt');
    }
}
