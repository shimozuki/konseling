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
        Schema::create('tbl_kasus_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_data_user');
            $table->foreignId('id_kasus');
            $table->timestamps();

            $table->foreign('id_data_user')->references('id')->on('tbl_data_user')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kasus')->references('id')->on('tbl_kasus')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kasus_siswa');
    }
};
