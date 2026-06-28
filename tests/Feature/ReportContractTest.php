<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Contract\ReportContract;
use PHPUnit\Framework\MockObject\MockObject;

class ReportContractTest extends TestCase
{
    /**
     * @var ReportContract|MockObject
     */
    protected $reportService;

    protected function setUp(): void
    {
        parent::setUp();

        // mock ReportContract
        $this->reportService = $this->createMock(ReportContract::class);

        // bind ke Laravel container
        $this->app->instance(
            ReportContract::class,
            $this->reportService
        );
    }

    /** @test */
    public function test_create_lost_report_success()
    {
        $data = [
            'user_id' => 1,
            'title' => 'Lost Wallet',
            'description' => 'Black wallet lost near campus'
        ];

        $this->reportService
            ->method('createLostReport')
            ->with($data)
            ->willReturn([
                'id' => 10,
                'type' => 'lost',
                'status' => 'created'
            ]);

        $result = $this->reportService->createLostReport($data);

        $this->assertIsArray($result);
        $this->assertEquals('lost', $result['type']);
    }

    /** @test */
    public function test_create_found_report_success()
    {
        $data = [
            'user_id' => 2,
            'title' => 'Found Phone',
            'description' => 'iPhone found in library'
        ];

        $this->reportService
            ->method('createFoundReport')
            ->with($data)
            ->willReturn([
                'id' => 11,
                'type' => 'found',
                'status' => 'created'
            ]);

        $result = $this->reportService->createFoundReport($data);

        $this->assertIsArray($result);
        $this->assertEquals('found', $result['type']);
    }

    /** @test */
    public function test_get_all_reports_success()
    {
        $this->reportService
            ->method('getAllReports')
            ->willReturn([
                ['id' => 1, 'title' => 'Report A'],
                ['id' => 2, 'title' => 'Report B']
            ]);

        $result = $this->reportService->getAllReports();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    /** @test */
    public function test_get_report_by_id_success()
    {
        $this->reportService
            ->method('getReportById')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'title' => 'Lost Bag'
            ]);

        $result = $this->reportService->getReportById(1);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
    }

    /** @test */
    public function test_delete_report_success()
    {
        $this->reportService
            ->method('deleteReport')
            ->with(1)
            ->willReturn(true);

        $result = $this->reportService->deleteReport(1);

        $this->assertTrue($result);
    }
}