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
        'tanggal_verifikasi',
        'id_verifikator',
    ];
    public function batch()
    {
        return $this->hasOne(batch::class, 'id', 'id_batch');
    }
    public function pt()
    {
        return $this->hasOne(pt::class, 'id', 'id_pt');
    }
}
