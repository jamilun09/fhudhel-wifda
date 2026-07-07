<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// UBAH 'name' menjadi 'nama', dan tambahkan kolom lainnya agar canggih
#[Fillable(['nama', 'email', 'password', 'access_key', 'is_filter', 'can_edit', 'can_delete', 'can_reply', 'is_active', 'tenor_key', 'is_confetti_animation', 'tz'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
