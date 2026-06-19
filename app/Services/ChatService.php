<?php

namespace App\Services;

use App\Contracts\Communication\ChatContract;

class ChatService implements ChatContract
{
    public function createChatRoom(
        int $ownerId,
        int $finderId
    ) {
        return [
            'message' => 'Room chat berhasil dibuat',
            'owner_id' => $ownerId,
            'finder_id' => $finderId
        ];
    }

    public function sendMessage(array $data)
    {
        return [
            'message' => 'Pesan berhasil dikirim',
            'data' => $data
        ];
    }

    public function getMessages(int $roomId)
    {
        return [
            'message' => 'Daftar pesan',
            'room_id' => $roomId
        ];
    }

    public function markAsRead(int $messageId)
    {
        return [
            'message' => 'Pesan telah dibaca',
            'message_id' => $messageId
        ];
    }
}