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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();
            $table->timestamps();
            $table->unsignedBigInteger('atasan_id')->nullable();
            $table->foreign('atasan_id')->references('id')->on('roles');
            $table->string('bawahan')->nullable();
            $table->boolean('status')->nullable();
            $table->string('responsible_to')->nullable();
            $table->string('accountable_to')->nullable();
            $table->string('informable_to')->nullable();
            $table->boolean("is_admin")->nullable();
            $table->string("required_to_submit_document")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('roles');
    }
};
