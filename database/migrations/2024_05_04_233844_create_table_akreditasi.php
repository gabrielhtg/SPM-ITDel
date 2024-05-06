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
        Schema::create('table_akreditasi', function (Blueprint $table) {
            $table->id();
            $table->string('judulakreditasi');
            $table->String('gambarakreditasi');
            $table->text('keteranganakreditasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_akreditasi');
    }
};
