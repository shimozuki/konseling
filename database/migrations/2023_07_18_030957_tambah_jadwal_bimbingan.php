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
        Schema::create('tbl_jadwal_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_konselor');
            $table->foreignId('id_data_user');
            $table->timestamp('tgl_bimbingan');
            $table->tinyInteger('bimbingan');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('id_data_user')->references('id')->on('tbl_data_user')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_konselor')->references('id')->on('tbl_konselor')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jadwal_bimbingan');
    }
};
