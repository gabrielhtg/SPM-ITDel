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
        Schema::create('jenis_laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipelaporan');
            $table->foreign('id_tipelaporan')->references('id')->on('tipe_laporan');
            $table->string('nama');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_laporan');
    }
};
