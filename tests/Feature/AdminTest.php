<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Claim;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\AdminContract;
use App\Services\AdminService;

class AdminServiceTest extends TestCase
{
    use RefreshDatabase;

    private AdminContract $adminService;

    protected function setUp(): void
    {
        parent::setUp();

        // langsung pakai implementasi service
        $this->adminService = new AdminService();
    }

    /** @test */
    public function test_get_pending_claims_success()
    {
        Claim::factory()->count(2)->create([
            'status' => 'pending',
        ]);

        $result = $this->adminService->getPendingClaims();

        $this->assertNotEmpty($result);
    }

    /** @test */
    public function test_approve_claim_success()
    {
        $claim = Claim::factory()->create([
            'status' => 'pending',
        ]);

        $this->adminService->approveClaim($claim->id);

        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'status' => 'approved',
        ]);
    }

    /** @test */
    public function test_reject_claim_success()
    {
        $claim = Claim::factory()->create([
            'status' => 'pending',
        ]);

        $this->adminService->rejectClaim($claim->id);

        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'status' => 'rejected',
        ]);
    }

    /** @test */
    public function test_get_dashboard_data_success()
    {
        Claim::factory()->count(3)->create([
            'status' => 'pending',
        ]);

        Claim::factory()->count(2)->create([
            'status' => 'approved',
        ]);

        Report::factory()->count(5)->create();

        $result = $this->adminService->getDashboardData();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('pending_claims', $result);
    }
}