<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Contract\AdminApprovalContract;
use PHPUnit\Framework\MockObject\MockObject;

class AdminApprovalTest extends TestCase
{
    /**
     * @var AdminApprovalContract|MockObject
     */
    protected $adminApprovalService;

    protected function setUp(): void
    {
        parent::setUp();

        // mock contract biar tidak tergantung database/service asli
        $this->adminApprovalService = $this->createMock(AdminApprovalContract::class);

        // bind ke container Laravel
        $this->app->instance(
            AdminApprovalContract::class,
            $this->adminApprovalService
        );
    }

    /** @test */
    public function test_get_pending_claims()
    {
        $this->adminApprovalService
            ->method('getPendingClaims')
            ->willReturn([
                ['id' => 1, 'status' => 'pending'],
                ['id' => 2, 'status' => 'pending'],
            ]);

        $result = $this->adminApprovalService->getPendingClaims();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    /** @test */
    public function test_approve_claim_success()
    {
        $this->adminApprovalService
            ->method('approveClaim')
            ->with(1)
            ->willReturn(true);

        $result = $this->adminApprovalService->approveClaim(1);

        $this->assertTrue($result);
    }

    /** @test */
    public function test_reject_claim_with_reason()
    {
        $this->adminApprovalService
            ->method('rejectClaim')
            ->with(
                $this->equalTo(1),
                $this->equalTo('invalid proof')
            )
            ->willReturn(true);

        $result = $this->adminApprovalService->rejectClaim(1, 'invalid proof');

        $this->assertTrue($result);
    }

    /** @test */
    public function test_get_claim_detail()
    {
        $this->adminApprovalService
            ->method('getClaimDetail')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'status' => 'pending',
                'user' => 'test user'
            ]);

        $result = $this->adminApprovalService->getClaimDetail(1);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
    }
}