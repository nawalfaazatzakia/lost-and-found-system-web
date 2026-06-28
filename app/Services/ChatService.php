<?php

namespace App\Services;

use App\Models\Chat;
use App\Contract\ChatContract;

class ChatService implements ChatContract
{
    public function createChatRoom(int $ownerId, int $finderId)
    {
        return [
            'message'   => 'Room chat berhasil dibuat',
            'owner_id'  => $ownerId,
            'finder_id' => $finderId,
        ];
    }

    public function sendMessage(array $data)
    {
        $chat = Chat::create([
            'claim_id'    => $data['claim_id'],
            'sender_id'   => $data['sender_id'],
            'receiver_id' => $data['receiver_id'] ?? null,
            'message'     => $data['message'],
            'is_read'     => false,
        ]);

        return [
            'message' => 'Pesan berhasil dikirim',
            'data'    => $chat->load(['sender', 'receiver']),
        ];
    }

    public function getMessages(int $claimId)
    {
        $messages = Chat::with(['sender', 'receiver'])
            ->where('claim_id', $claimId)
            ->oldest()
            ->get();

        return [
            'message' => 'Daftar pesan',
            'data'    => $messages,
        ];
    }

    public function markAsRead(int $messageId)
    {
        $chat = Chat::findOrFail($messageId);
        $chat->update(['is_read' => true]);

        return [
            'message' => 'Pesan telah dibaca',
        ];
    }
}
