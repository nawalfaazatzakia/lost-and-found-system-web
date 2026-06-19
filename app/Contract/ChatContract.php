<?php

namespace App\Contract;

interface ChatContract
{
    public function sendMessage(array $data);

    public function getMessages(int $roomId);

    public function createChatRoom(int $ownerId, int $finderId);

    public function markAsRead(int $messageId);
}