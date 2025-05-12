<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchSeeder extends Seeder
{
    public function run()
    {
        DB::table('batch')->insert([
            ['nama' => 'Batch 1 2025', 'universitas_id' => 1],
            ['nama' => 'Batch 2 2025', 'universitas_id' => 2],
            // Tambahkan batch lainnya
        ]);
    }
}
