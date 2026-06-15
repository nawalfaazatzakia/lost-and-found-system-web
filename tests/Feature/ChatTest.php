<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Claim;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_chat_persists_message()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();
        $claim = Claim::factory()->create();

        $this->withoutMiddleware();

        $this->actingAs($sender)
            ->postJson('/api/chat/send', [
                'message' => 'Halo, saya penemu',
                'sender' => $sender->id,
                'receiver' => $receiver->id,
            ])
            ->assertStatus(200)
            ->assertJson(['status' => 'ok']);
    }
}
