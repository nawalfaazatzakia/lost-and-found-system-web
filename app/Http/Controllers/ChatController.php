<?php

namespace App\Http\Controllers;

use App\Contract\ChatContract;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatContract $chatService)
    {
        $this->chatService = $chatService;
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'claim_id' => 'required|exists:claims,id',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        return response()->json(
            $this->chatService->sendMessage($validated)
        );
    }

    public function messages($claimId)
    {
        return response()->json(
            $this->chatService->getMessages($claimId)
        );
    }

    public function markRead($id)
    {
        return response()->json(
            $this->chatService->markAsRead($id)
        );
    }
}