<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Contract\ChatContract;
use PHPUnit\Framework\MockObject\MockObject;

class ChatContractTest extends TestCase
{
    /**
     * @var ChatContract|MockObject
     */
    protected $chatService;

    protected function setUp(): void
    {
        parent::setUp();

        // mock ChatContract
        $this->chatService = $this->createMock(ChatContract::class);

        // bind ke Laravel container
        $this->app->instance(
            ChatContract::class,
            $this->chatService
        );
    }

    /** @test */
    public function test_send_message_success()
    {
        $payload = [
            'room_id' => 1,
            'sender_id' => 2,
            'message' => 'Hello world'
        ];

        $this->chatService
            ->method('sendMessage')
            ->with($payload)
            ->willReturn([
                'id' => 1,
                'status' => 'sent'
            ]);

        $result = $this->chatService->sendMessage($payload);

        $this->assertIsArray($result);
        $this->assertEquals('sent', $result['status']);
    }

    /** @test */
    public function test_get_messages_success()
    {
        $this->chatService
            ->method('getMessages')
            ->with(1)
            ->willReturn([
                ['id' => 1, 'message' => 'Hi'],
                ['id' => 2, 'message' => 'Hello']
            ]);

        $result = $this->chatService->getMessages(1);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    /** @test */
    public function test_create_chat_room_success()
    {
        $this->chatService
            ->method('createChatRoom')
            ->with(1, 2)
            ->willReturn([
                'room_id' => 10,
                'owner_id' => 1,
                'finder_id' => 2
            ]);

        $result = $this->chatService->createChatRoom(1, 2);

        $this->assertIsArray($result);
        $this->assertEquals(10, $result['room_id']);
    }

    /** @test */
    public function test_mark_as_read_success()
    {
        $this->chatService
            ->method('markAsRead')
            ->with(5)
            ->willReturn(true);

        $result = $this->chatService->markAsRead(5);

        $this->assertTrue($result);
    }
}