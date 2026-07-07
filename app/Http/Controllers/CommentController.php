<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\TamuBaruHadir; // Memanggil pemancar sinyal real-time

class CommentController extends Controller
{
    // Menampilkan daftar ucapan ke website undangan
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $ip = $request->ip(); // Ambil IP tamu yang sedang membuka undangan
        
        $comments = Comment::withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // KODE CANGGIH: Cek satu per satu apakah tamu ini sudah me-like komentar tersebut
        $comments->getCollection()->transform(function ($comment) use ($ip) {
            $comment->liked_by_me = $comment->likes()->where('uuid', $ip)->exists();
            return $comment;
        });

        return response()->json([
            'data' => $comments->items(),
            'meta' => [
                'hasMore' => $comments->hasMorePages()
            ]
        ]);
    }

    // Menyimpan ucapan tamu dari form RSVP dan mengirim sinyal Real-Time
    public function store(Request $request)
    {
        // 1. Memastikan data yang dikirim tidak kosong
        $request->validate([
            'nama' => 'required|string|max:255',
            'hadir' => 'required|boolean',
            'komentar' => 'required|string',
        ]);

        // 2. Simpan data ke Database Neon Tech
        $comment = Comment::create([
            'nama' => $request->nama,
            'hadir' => $request->hadir,
            'komentar' => $request->komentar,
            'parent_id' => $request->parent_id ?? null,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // 3. Set nilai awal bawaan agar frontend tidak error
        $comment->likes_count = 0;
        $comment->liked_by_me = false;
        
        // 4. TEMBAKKAN SINYAL REAL-TIME KE DASHBOARD ADMIN!
        event(new TamuBaruHadir($comment));
        
        // 5. Mengembalikan respons sukses ke website
        return response()->json($comment, 201);
    }
}
