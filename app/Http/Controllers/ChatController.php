<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'Pesan berhasil dikirim',
            'data' => $request->only(['message', 'sender', 'receiver']),
        ]);
    }
}
