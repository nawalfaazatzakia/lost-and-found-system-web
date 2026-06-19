<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Claim;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\ClaimContract;
use App\Services\ClaimService;

class ClaimServiceTest extends TestCase
{
    use RefreshDatabase;

    private ClaimContract $claimService;

    protected function setUp(): void
    {
        parent::setUp();

        // pakai implementation service langsung
        $this->claimService = new ClaimService();
    }

    /** @test */
    public function test_submit_claim_success()
    {
        $user = User::factory()->create();

        $report = Report::factory()->create();

        $data = [
            'user_id' => $user->id,
            'report_id' => $report->id,
            'message' => 'Ini barang saya',
        ];

        $this->claimService->submitClaim($data);

        $this->assertDatabaseHas('claims', [
            'user_id' => $user->id,
            'report_id' => $report->id,
            'message' => 'Ini barang saya',
        ]);
    }

    /** @test */
    public function test_verify_claim_success()
    {
        $claim = Claim::factory()->create([
            'status' => 'pending',
        ]);

        $this->claimService->verifyClaim($claim->id);

        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'status' => 'verified',
        ]);
    }

    /** @test */
    public function test_get_claim_status_returns_correct_status()
    {
        $claim = Claim::factory()->create([
            'status' => 'verified',
        ]);

        $status = $this->claimService->getClaimStatus($claim->id);

        $this->assertEquals('verified', $status);
    }

    /** @test */
    public function test_upload_proof_success()
    {
        $claim = Claim::factory()->create();

        $data = [
            'claim_id' => $claim->id,
            'proof' => 'bukti.jpg',
        ];

        $this->claimService->uploadProof($data);

        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'proof' => 'bukti.jpg',
        ]);
    }
}