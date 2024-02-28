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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 20)->nullable(false)->unique();
            $table->string('phone', 15);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('reset_password_token')->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->timestamp('ends_on')->nullable();
            $table->boolean('online')->nullable();
            $table->boolean('status')->nullable();
            $table->string('pending_roles', 20)->nullable();
            $table->boolean('verified');
            $table->string('role')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('profile_pict')->nullable();
            $table->timestamp('last_login_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
