<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pt extends Model
{
    use HasFactory;

    protected $table = 'pt';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_provinsi',
        'nama_pt',
        'no_hp',
        'email',
        'alamat',
        'logo',
    ];
    public function Provinsi()
    {
        return $this->hasOne(Provinsi::class, 'id', 'id_provinsi');
    }
}
