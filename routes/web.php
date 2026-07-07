<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\WeddingSetting;

// ========================================================
// KODE CANGGIH: Halaman Depan Membaca Data CMS!
// ========================================================
Route::get('/', function () {
    $settings = WeddingSetting::first();
    
    // Jaga-jaga jika database setting kosong, buatkan 1 data default
    if (!$settings) {
        $settings = WeddingSetting::create([]);
    }
    
    return view('welcome', compact('settings'));
});

// ========================================================
// Jalur Login & Logout
// ========================================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================================================
// KODE CANGGIH: Mengunci Dashboard Admin!
// Semua URL di dalam grup ini WAJIB LOGIN.
// ========================================================
Route::middleware('auth')->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index']);
    
    // Fitur Export Data Tamu (Excel/CSV)
    Route::get('/admin/export', [AdminController::class, 'export']);
    
    // KODE BARU: Jalur untuk menghapus ucapan tamu
    Route::delete('/admin/comments/{id}', [AdminController::class, 'destroy']);
    
    // KODE BARU: Jalur untuk menyimpan perubahan Pengaturan Website (CMS)
    Route::post('/admin/settings', [AdminController::class, 'updateSettings']);
    
    // KODE BARU: Jalur untuk mereset CMS ke setelan awal (Bawaan)
    Route::post('/admin/settings/reset', [AdminController::class, 'resetSettings']);
});
