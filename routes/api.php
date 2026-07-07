<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/settings', function () {
    return response()->json([
        'is_confetti_animation' => true,
        'tenor_key' => null 
    ]);
});

Route::get('/comments', [CommentController::class, 'index']);

// KODE CANGGIH: Membatasi 5 ucapan per menit dari 1 HP/Laptop (mencegah SPAM)
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/comments/{uuid}/likes', [LikeController::class, 'store']);
});
