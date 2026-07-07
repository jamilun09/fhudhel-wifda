<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat Tabel Comments (Hanya siapkan kolom parent_id, jangan di-relasikan dulu)
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nama', 255);
            $table->boolean('hadir')->default(false);
            $table->text('komentar')->nullable();
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('parent_id')->nullable(); 
            $table->string('own')->unique()->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('gif_url')->nullable();
            $table->timestamps();
        });

        // 2. Relasikan parent_id ke uuid SETELAH tabel comments berhasil dibuat
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('uuid')->on('comments')->onDelete('cascade');
        });

        // 3. Tabel Likes
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('comment_id');
            $table->foreign('comment_id')->references('uuid')->on('comments')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
        
        // Praktik terbaik: lepas relasi sebelum menghapus tabel
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        
        Schema::dropIfExists('comments');
    }
};
