<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\PrivateChannel; // <-- Ini kuncinya, jalur rahasia!
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// ShouldBroadcastNow artinya sinyal dikirim seketika itu juga tanpa antre
class TamuBaruHadir implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    // Menentukan di frekuensi mana sinyal ini dipancarkan
    public function broadcastOn(): array
    {
        // KODE CANGGIH: Memancarkan sinyal ke jalur Private (Rahasia)
        return [
            new PrivateChannel('admin-channel'),
        ];
    }

    // Nama sinyalnya
    public function broadcastAs(): string
    {
        return 'tamu.hadir';
    }
}
