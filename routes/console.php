<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Comment;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
| File ini mengatur perintah-perintah terminal (Artisan commands).
*/

// Command bawaan Laravel untuk menampilkan kutipan motivasi
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Menampilkan kutipan motivasi');

// KODE CANGGIH: Command khusus untuk memantau tamu pernikahan!
Artisan::command('wedding:status', function () {
    $total = Comment::count();
    $hadir = Comment::where('hadir', true)->count();
    $tidakHadir = Comment::where('hadir', false)->count();
    
    $this->info("=======================================");
    $this->info(" 💍 STATUS UNDANGAN WIFDA & PASANGAN 💍");
    $this->info("=======================================");
    $this->line(" 📝 Total Ucapan Masuk : <fg=cyan;options=bold>{$total}</> tamu");
    $this->line(" ✅ Konfirmasi Hadir   : <fg=green;options=bold>{$hadir}</> tamu");
    $this->line(" ❌ Tidak Hadir        : <fg=red;options=bold>{$tidakHadir}</> tamu");
    $this->info("=======================================");
    $this->comment(" Jalankan 'php artisan serve' untuk membuka Dashboard GUI.");
    $this->info("=======================================");
})->purpose('Cek statistik kehadiran tamu langsung dari terminal');

// KODE CANGGIH: Membuat Akun Master Langsung dari Terminal
Artisan::command('make:admin', function () {
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@wedding.com'],
        [
            'nama' => 'Admin Wifda',
            'password' => \Illuminate\Support\Facades\Hash::make('wifda2026'),
            'is_active' => true,
        ]
    );
    $this->info('====================================');
    $this->info(' ✅ AKUN MASTER BERHASIL DIBUAT! ✅');
    $this->info('====================================');
    $this->line(' Email    : <fg=yellow>admin@wedding.com</>');
    $this->line(' Password : <fg=yellow>wifda2026</>');
    $this->info('====================================');
})->purpose('Membuat akun rahasia untuk login ke Dashboard Admin');
