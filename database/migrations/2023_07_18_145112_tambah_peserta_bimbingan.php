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
        Schema::create('tbl_peserta_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal_bimbingan');
            $table->foreignId('id_data_user');
            $table->timestamps();

            $table->foreign('id_jadwal_bimbingan')->references('id')->on('tbl_jadwal_bimbingan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_data_user')->references('id')->on('tbl_data_user')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_peserta_bimbingan');
    }
};
