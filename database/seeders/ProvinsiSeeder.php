<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // Tambahkan ini untuk mengimpor DB
use Illuminate\Support\Facades\Schema;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        DB::table('provinsi')->insert([
            ['nama' => 'Sumatera Selatan'],
            ['nama' => 'Bangka Belitung'],
            ['nama' => 'Bengkulu'],
            ['nama' => 'Lampung'],
        ]);
    }
}