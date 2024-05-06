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
        Schema::create('log_laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_laporan');
            $table->foreign('id_jenis_laporan')->references('id')->on('jenis_laporan');
            $table->unsignedBigInteger('upload_by');
            $table->foreign('upload_by')->references('id')->on('users');
            $table->string('status')->nullable();
            $table->timestamp('create_at')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_laporan');
    }
};
