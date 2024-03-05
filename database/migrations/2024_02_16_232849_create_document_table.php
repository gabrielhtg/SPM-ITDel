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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nama_dokumen');
            $table->string('nomor_dokumen');
            $table->string('deskripsi');
            $table->string('directory');
            $table->string('give_access_to');
            $table->string('created_by');
            $table->string('status');
            $table->string('menggantikan_dokumen');
            $table->integer('year');;
            $table->string('tipe_dokumen');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('keterangan_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
