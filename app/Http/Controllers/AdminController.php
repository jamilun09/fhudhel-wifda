<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $totalTamu = $comments->count();
        $totalHadir = $comments->where('hadir', true)->count();
        $totalTidakHadir = $comments->where('hadir', false)->count();

        $settings = WeddingSetting::first();
        if (!$settings) {
            $settings = WeddingSetting::create([]);
        }

        return view('admin', compact('comments', 'totalTamu', 'totalHadir', 'totalTidakHadir', 'settings'));
    }

    public function export()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $filename = "Data_Tamu_Undangan_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID', 'Nama Tamu', 'Status Hadir', 'Ucapan', 'Tanggal Kirim'];

        $callback = function() use($comments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($comments as $comment) {
                $statusHadir = $comment->hadir ? 'Hadir' : 'Tidak Hadir';
                $tanggal = $comment->created_at ? $comment->created_at->format('d-m-Y H:i:s') : '-';
                fputcsv($file, [$comment->id, $comment->nama, $statusHadir, $comment->komentar, $tanggal]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Ucapan berhasil dihapus secara permanen!');
    }

    public function updateSettings(Request $request)
    {
        $settings = WeddingSetting::first();
        if (!$settings) {
            $settings = WeddingSetting::create([]);
        }
        $settings->update($request->except(['_token']));
        return back()->with('success', 'Tampilan & Konten Website berhasil diperbarui!');
    }

    // ========================================================
    // KODE BARU: Logika Reset ke Setelan Awal HTML kamu
    // ========================================================
    public function resetSettings()
    {
        $settings = WeddingSetting::first();
        if (!$settings) {
            $settings = WeddingSetting::create([]);
        }

        // Teks Kisah Cinta bawaan kamu
        $defaultStory = "2021 — Pertemuan\nBertemu di sebuah acara kampus, obrolan singkat itu ternyata membuka jalan panjang yang tak pernah kami rencanakan sebelumnya.\n\n2022 — Kedekatan\nDari diskusi ringan hingga rencana masa depan, kami sadar bahwa kami saling melengkapi lebih dari yang kami bayangkan.\n\n2024 — Lamaran\nSebuah lamaran sederhana namun penuh makna, disaksikan oleh keluarga tercinta di kedua belah pihak.\n\n2026 — Pernikahan\nDan kini, kami siap melangkah bersama dalam ikatan yang suci, memulai kehidupan baru sebagai satu keluarga.";

        // Kembalikan ke pengaturan HTML awal
        $settings->update([
            'bride_name' => 'Wifda',
            'bride_parents' => 'Bapak & Ibu',
            'groom_name' => 'Nama Anda',
            'groom_parents' => 'Bapak & Ibu',
            'wedding_date' => '2026-09-12',
            'music_url' => 'https://cdn.pixabay.com/download/audio/2022/03/15/audio_c8e70c5867.mp3',
            'bride_photo_url' => 'https://images.unsplash.com/photo-1594736797933-d0501ba2fe65',
            'groom_photo_url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab',
            'cover_photo_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552',
            'welcome_quote' => '"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan dari jenismu sendiri..."',
            'love_story' => $defaultStory,
            'akad_location' => 'Jl. Melati Indah No. 21, Jakarta Selatan',
            'akad_time' => '08:00 WIB',
            'reception_location' => 'The Grand Ballroom, Hotel Mulia',
            'reception_time' => '11:00 WIB',
            'google_maps_url' => 'https://maps.google.com/?q=Hotel+Mulia+Senayan+Jakarta',
            'bank_name' => 'BCA',
            'bank_account' => '1234 5678 90',
            'bank_owner' => 'a.n. Nama Anda',
            'theme_bg_color' => '#FBF6EC',
            'theme_text_color' => '#1E1C1A',
        ]);

        return back()->with('success', 'Website berhasil di-RESET ke pengaturan pabrik (awal)!');
    }
}
