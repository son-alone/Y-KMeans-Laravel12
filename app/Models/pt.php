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
        'nama_pt',
        'no_hp',
        'email',
        'alamat',
        'logo',
    ];
}
