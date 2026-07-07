<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bride_name')->default('Wifda');
            $table->string('groom_name')->default('Nama Kamu');
            $table->date('wedding_date')->default('2026-09-12');
            $table->string('music_url')->default('https://cdn.pixabay.com/download/audio/2022/03/15/audio_c8e70c5867.mp3');
            $table->string('bride_photo_url')->default('https://images.unsplash.com/photo-1594736797933-d0501ba2fe65');
            $table->string('groom_photo_url')->default('https://images.unsplash.com/photo-1521572163474-6864f9cf17ab');
            $table->string('cover_photo_url')->default('https://images.unsplash.com/photo-1519741497674-611481863552');
            $table->text('welcome_quote')->nullable();
            $table->string('akad_location')->default('Jl. Melati Indah No. 21, Jakarta Selatan');
            $table->string('akad_time')->default('08:00 - 09:30 WIB');
            $table->string('reception_location')->default('The Grand Ballroom, Hotel Mulia');
            $table->string('reception_time')->default('11:00 - 14:00 WIB');
            $table->string('google_maps_url')->default('https://maps.google.com/?q=Hotel+Mulia+Senayan+Jakarta');
            $table->string('bank_name')->default('BCA');
            $table->string('bank_account')->default('1234 5678 90');
            $table->string('bank_owner')->default('a.n. Nama Anda');
            $table->timestamps();
        });

        // Masukkan data awal (default) ke dalam database secara otomatis
        DB::table('wedding_settings')->insert([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_settings');
    }
};
