<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
            'sender' => 'required|integer',
            'receiver' => 'required|integer',
        ]);

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
