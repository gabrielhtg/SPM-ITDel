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
            $table->foreign('id_tipelaporan')->references('id')->on('jenis_laporan');
            $table->unsignedBigInteger('direview_oleh')->nullable();
            $table->foreign('direview_oleh')->references('id')->on('users');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('nama_laporan');
            $table->string('directory');
            $table->boolean('revisi')->default(false);
            $table->string('status')->default('Menunggu');
            $table->string('cek_revisi')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->timestamp('reject_at')->nullable();
            $table->text('komentar')->nullable();
            $table->string('file_catatan')->nullable();
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
