<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingSetting extends Model
{
    // Mengizinkan semua kolom untuk diubah dari form admin
    protected $guarded = ['id'];
}
