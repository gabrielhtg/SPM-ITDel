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
        Schema::create('responsible', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role");
            $table->foreign('role')->references("id")->on("roles");
            $table->unsignedBigInteger("responsible_to");
            $table->foreign('responsible_to')->references("id")->on("roles");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsible');
    }
};
