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
        Schema::create('informable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role");
            $table->foreign('role')->references("id")->on("roles");
            $table->unsignedBigInteger("informable_to");
            $table->foreign('informable_to')->references("id")->on("roles");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informable');
    }
};
