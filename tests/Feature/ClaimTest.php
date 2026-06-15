<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Report;

class ClaimTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_claim()
    {
        $user = User::factory()->create();
        $report = Report::factory()->create();

        $this->withoutMiddleware();

        $this->actingAs($user)
            ->post('/mahasiswa/klaim', [
                'report_id' => $report->id,
                'proof' => 'Saya membawa foto bukti',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('claims', [
            'report_id' => $report->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
    }
}
