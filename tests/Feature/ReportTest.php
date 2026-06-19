<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\ReportContract;
use App\Services\ReportService;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    private ReportContract $reportService;

    protected function setUp(): void
    {
        parent::setUp();

        // langsung pakai implementasi service
        $this->reportService = new ReportService();
    }

    /** @test */
    public function test_create_report_success()
    {
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'type' => 'lost',
            'item_name' => 'Dompet Hitam',
            'description' => 'Hilang di kampus',
            'location' => 'Kampus A',
        ];

        $this->reportService->createReport($data);

        $this->assertDatabaseHas('reports', [
            'user_id' => $user->id,
            'item_name' => 'Dompet Hitam',
        ]);
    }

    /** @test */
    public function test_get_all_reports_success()
    {
        Report::factory()->count(3)->create();

        $result = $this->reportService->getAllReports();

        $this->assertNotEmpty($result);
    }

    /** @test */
    public function test_get_report_by_id_success()
    {
        $report = Report::factory()->create();

        $result = $this->reportService->getReportById($report->id);

        $this->assertEquals($report->id, $result->id);
    }

    /** @test */
    public function test_update_report_success()
    {
        $report = Report::factory()->create([
            'item_name' => 'Dompet Lama',
        ]);

        $data = [
            'item_name' => 'Dompet Baru',
        ];

        $this->reportService->updateReport($report->id, $data);

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'item_name' => 'Dompet Baru',
        ]);
    }

    /** @test */
    public function test_delete_report_success()
    {
        $report = Report::factory()->create();

        $this->reportService->deleteReport($report->id);

        $this->assertDatabaseMissing('reports', [
            'id' => $report->id,
        ]);
    }
}
