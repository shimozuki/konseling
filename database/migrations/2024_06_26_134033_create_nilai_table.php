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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konselor');
            $table->unsignedBigInteger('id_jadwal');
            $table->integer('nilai');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('id_jadwal')->references('id')->on('tbl_jadwal_bimbingan')->onDelete('cascade');
            $table->foreign('id_konselor')->references('id')->on('tbl_konselor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
