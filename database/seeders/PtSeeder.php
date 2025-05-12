<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PtSeeder extends Seeder
{
    public function run()
    {
        DB::table('pt')->insert([
            ['provinsi_id' => 1, 'nama' => 'Universitas Sriwijaya'],
            ['provinsi_id' => 2, 'nama' => 'Universitas Bangka Belitung'],
            // Tambahkan lebih banyak perguruan tinggi sesuai kebutuhan
        ]);
    }
}
