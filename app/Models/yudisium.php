<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yudisium extends Model
{
    use HasFactory;

    protected $table = 'yudisium';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_batch',
        'id_pt',
        'tanggal_yudisium',
        'file',
        'tanggal_verifikasi',
        'id_verifikator',
    ];
    public function Batch()
    {
        return $this->hasOne(Batch::class, 'id', 'id_batch');
    }
    public function Pt()
    {
        return $this->hasOne(Pt::class, 'id', 'id_pt');
    }

    public function Verifikator()
    {
        return $this->hasOne(User::class, 'id', 'id_verifikator');
    }
}
