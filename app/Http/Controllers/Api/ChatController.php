<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contract\ChatContract;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatContract $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * POST /api/v1/chat/send
     * Mengirim pesan dalam konteks klaim.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'claim_id'    => 'required|integer|exists:claims,id',
            'receiver_id' => 'required|integer|exists:users,id',
            'message'     => 'required|string',
        ]);

        $validated['sender_id'] = $request->user()->id;

        $result = $this->chatService->sendMessage($validated);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ], 201);
    }

    /**
     * GET /api/v1/chat/messages/{claimId}
     * Mengambil semua pesan dalam suatu klaim.
     */
    public function messages(Request $request, $claimId)
    {
        $result = $this->chatService->getMessages((int) $claimId);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ]);
    }

    /**
     * POST /api/v1/chat/read/{id}
     * Menandai pesan sebagai sudah dibaca.
     */
    public function markRead(Request $request, $id)
    {
        $result = $this->chatService->markAsRead((int) $id);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
        ]);
    }
}
