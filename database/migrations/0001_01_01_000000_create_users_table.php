<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Users Utama
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Kolom kustom undangan kamu
            $table->string('access_key', 50)->unique()->nullable();
            $table->boolean('is_filter')->default(true);
            $table->boolean('can_edit')->default(true);
            $table->boolean('can_delete')->default(true);
            $table->boolean('can_reply')->default(true);
            $table->boolean('is_active')->nullable();
            $table->string('tenor_key', 100)->nullable();
            $table->boolean('is_confetti_animation')->default(true);
            $table->string('tz', 70)->default('Asia/Jakarta');
            
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel untuk reset password (Bawaan Laravel - biarkan saja)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel untuk sesi / login (Bawaan Laravel - biarkan saja)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
