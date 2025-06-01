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
        Schema::create('yudisium', function (Blueprint $table) {
            $table->id();
            $table->string('id_batch');
            $table->string('id_pt');
            $table->date('tanggal_yudisium');
            $table->string('file');
            $table->date('tanggal_verifikasi');
            $table->string('id_verifikator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yudisium');
    }
};
