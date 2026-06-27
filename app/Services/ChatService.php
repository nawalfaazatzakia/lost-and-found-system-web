<?php

namespace App\Services;

use App\Models\Chat;
use App\Contract\ChatContract;

class ChatService implements ChatContract
{
    public function createChatRoom(int $ownerId, int $finderId)
    {
        return [
            'message' => 'Room chat berhasil dibuat',
            'owner_id' => $ownerId,
            'finder_id' => $finderId
        ];
    }

    public function sendMessage(array $data)
    {
        $chat = Chat::create($data);

        return [
            'message' => 'Pesan berhasil dikirim',
            'data' => $chat
        ];
    }

    public function getMessages(int $roomId)
    {
        $messages = Chat::where('room_id', $roomId)->latest()->get();

        return [
            'message' => 'Daftar pesan',
            'data' => $messages
        ];
    }

    public function markAsRead(int $messageId)
    {
        $chat = Chat::findOrFail($messageId);
        $chat->update([
            'is_read' => true
        ]);

        return [
            'message' => 'Pesan telah dibaca'
        ];
    }
}