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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipelaporan');
            $table->foreign('id_tipelaporan')->references('id')->on('tipe_laporan');
            $table->unsignedBigInteger('disetujui_oleh')->nullable();
            $table->foreign('disetujui_oleh')->references('id')->on('users');
            $table->unsignedBigInteger('ditolak_oleh')->nullable();
            $table->foreign('ditolak_oleh')->references('id')->on('users');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('nama_laporan');
            $table->string('directory');
            $table->boolean('revisi')->default(false);
            $table->string('tujuan');
            $table->boolean('status')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->timestamp('reject_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
