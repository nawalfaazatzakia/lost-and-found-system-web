<?php

namespace App\Contracts;

interface ChatContract
{
    public function sendMessage(array $data);

    public function getConversation($claimId);

    public function storeChatHistory($claimId);
}