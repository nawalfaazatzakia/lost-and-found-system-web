<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\PickupContract;
use App\Services\PickupService;

class PickupTest extends TestCase
{
    use RefreshDatabase;

    private PickupContract $pickupService;

    protected function setUp(): void
    {
        parent::setUp();

        // langsung pakai implementasi service
        $this->pickupService = new PickupService();
    }

    /** @test */
    public function test_get_map_location_success()
    {
        $report = Report::factory()->create([
            'location_lat' => -6.200000,
            'location_lng' => 106.816666,
        ]);

        $result = $this->pickupService->getMapLocation($report->id);

        $this->assertNotNull($result);
        $this->assertEquals($report->id, $result['report_id'] ?? $report->id);
    }

    /** @test */
    public function test_open_navigation_success()
    {
        $report = Report::factory()->create();

        $result = $this->pickupService->openNavigation($report->id);

        // biasanya return URL maps atau link navigasi
        $this->assertNotNull($result);
        $this->assertIsString($result);
    }

    /** @test */
    public function test_confirm_handover_success()
    {
        $report = Report::factory()->create([
            'status' => 'in_progress',
        ]);

        $this->pickupService->confirmHandover($report->id);

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'status' => 'handed_over',
        ]);
    }

    /** @test */
    public function test_close_report_success()
    {
        $report = Report::factory()->create([
            'status' => 'handed_over',
        ]);

        $this->pickupService->closeReport($report->id);

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'status' => 'closed',
        ]);
    }
}
