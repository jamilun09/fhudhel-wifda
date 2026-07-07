<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    protected $guarded = ['id']; // Mengizinkan semua kolom diisi

    // Otomatis membuat UUID saat komentar baru dibuat
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'comment_id', 'uuid');
    }

    // TAMBAHKAN INI AGAR BISA MEMBALAS KOMENTAR
    public function replies() 
    {
        return $this->hasMany(Comment::class, 'parent_id', 'uuid');
    }
}
