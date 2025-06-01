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
        Schema::create('detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_yudisium');
            $table->string('id_pt');
            $table->string('id_prodi');
            $table->string('id_batch');
            $table->string('npm');
            $table->string('nama_mhs');
            $table->double('ipk');
            $table->string('jml_sks');
            $table->date('tgl_masuk');
            $table->date('tgl_lulus');
            $table->string('jk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail');
    }
};
