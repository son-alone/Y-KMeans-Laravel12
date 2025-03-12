<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ptprodi', function (Blueprint $table) {
            $table->id();
            $table->string('id_pt');
            $table->string('id_prodi');
            $table->string('jenjang');
            $table->string('akreditasi');
            $table->string('sk');
            $table->date('tanggal_berlaku');
            $table->string('jumlah_dosen');
            $table->string('jumlah_mahasiswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ptprodi');
    }
};
