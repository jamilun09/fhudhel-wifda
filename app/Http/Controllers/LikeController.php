<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LikeController extends Controller
{
    public function store($uuid)
    {
        // Cek apakah komentar ada
        $comment = Comment::where('uuid', $uuid)->firstOrFail();

        // Simulasi toggle like (karena ini tanpa sistem login/auth tamu, kita gunakan IP Address)
        $ip = request()->ip();
        
        // Catatan: idealnya menggunakan session/cookie, tapi untuk undangan digital IP cukup efektif
        $existingLike = Like::where('comment_id', $uuid)->where('uuid', $ip)->first();

        if ($existingLike) {
            $existingLike->delete(); // Jika sudah dilike, maka unlike
            return response()->json(['message' => 'Unliked']);
        } else {
            Like::create([
                'uuid' => $ip,
                'comment_id' => $uuid
            ]);
            return response()->json(['message' => 'Liked'], 201);
        }
    }
}
