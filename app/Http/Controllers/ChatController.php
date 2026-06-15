<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatSendRequest;
use App\Models\Chat;

class ChatController extends Controller
{
    public function send(ChatSendRequest $request)
    {
        $data = $request->validated();

        // optional: persist chat if model configured
        if (class_exists(Chat::class)) {
            try {
                $chat = Chat::create($data);
            } catch (\Throwable $e) {
                $chat = null;
            }
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Pesan berhasil dikirim',
            'data' => $data,
            'chat' => $chat ?? null,
        ]);
    }
}
