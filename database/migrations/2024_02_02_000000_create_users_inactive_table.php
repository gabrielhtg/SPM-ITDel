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
        Schema::create('users_inactive', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 20)->nullable(false);
            $table->string('phone', 15);
            $table->string('email');
            $table->timestamp('ends_on')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
            $table->string('profile_pict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_inactive');
    }
};
