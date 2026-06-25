<?php

namespace App\Http\Controllers;

use App\Contract\ChatContract;
use App\Http\Requests\ChatSendRequest;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatContract $chatService)
    {
        $this->chatService = $chatService;
    }

    public function send(ChatSendRequest $request)
    {
        $chat = $this->chatService->sendMessage(
            $request->validated()
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'Pesan berhasil dikirim',
            'data' => $chat,
        ]);
    }
}