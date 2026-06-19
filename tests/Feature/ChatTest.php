<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Claim;
use App\Models\Chat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\ChatContract;
use App\Services\ChatService;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    private ChatContract $chatService;

    protected function setUp(): void
    {
        parent::setUp();

        // langsung pakai implementasi service
        $this->chatService = new ChatService();
    }

    /** @test */
    public function test_send_message_success()
    {
        $user = User::factory()->create();

        $claim = Claim::factory()->create();

        $data = [
            'claim_id' => $claim->id,
            'sender_id' => $user->id,
            'message' => 'Halo, apakah barang masih ada?',
        ];

        $this->chatService->sendMessage($data);

        $this->assertDatabaseHas('chats', [
            'claim_id' => $claim->id,
            'sender_id' => $user->id,
            'message' => 'Halo, apakah barang masih ada?',
        ]);
    }

    /** @test */
    public function test_get_conversation_success()
    {
        $claim = Claim::factory()->create();

        Chat::factory()->count(3)->create([
            'claim_id' => $claim->id,
        ]);

        $result = $this->chatService->getConversation($claim->id);

        $this->assertNotEmpty($result);
    }

    /** @test */
    public function test_store_chat_history_success()
    {
        $claim = Claim::factory()->create();

        Chat::factory()->count(2)->create([
            'claim_id' => $claim->id,
        ]);

        $this->chatService->storeChatHistory($claim->id);

        $this->assertDatabaseHas('chats', [
            'claim_id' => $claim->id,
        ]);
    }
}
