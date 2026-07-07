<?php

use Illuminate\Support\Facades\Broadcast;

// Jalur Rahasia Dashboard Admin
Broadcast::channel('admin-channel', function ($user) {
    // Sinyal ini HANYA BOLEH didengarkan oleh user yang sudah Login
    return $user !== null; 
});
