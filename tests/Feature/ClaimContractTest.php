<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Contracts\ClaimContract;
use PHPUnit\Framework\MockObject\MockObject;

class ClaimContractTest extends TestCase
{
    /**
     * @var ClaimContract|MockObject
     */
    protected $claimService;

    protected function setUp(): void
    {
        parent::setUp();

        // mock ClaimContract
        $this->claimService = $this->createMock(ClaimContract::class);

        // bind ke Laravel container
        $this->app->instance(
            ClaimContract::class,
            $this->claimService
        );
    }

    /** @test */
    public function test_submit_claim_success()
    {
        $data = [
            'user_id' => 1,
            'report_id' => 10,
            'description' => 'claiming item'
        ];

        $this->claimService
            ->method('submitClaim')
            ->with($data)
            ->willReturn([
                'claim_id' => 100,
                'status' => 'pending'
            ]);

        $result = $this->claimService->submitClaim($data);

        $this->assertIsArray($result);
        $this->assertEquals('pending', $result['status']);
    }

    /** @test */
    public function test_calculate_match_score_success()
    {
        $claimAnswers = [
            'color' => 'black',
            'brand' => 'nike'
        ];

        $originalAnswers = [
            'color' => 'black',
            'brand' => 'nike'
        ];

        $this->claimService
            ->method('calculateMatchScore')
            ->with($claimAnswers, $originalAnswers)
            ->willReturn(100);

        $result = $this->claimService->calculateMatchScore(
            $claimAnswers,
            $originalAnswers
        );

        $this->assertEquals(100, $result);
    }

    /** @test */
    public function test_upload_proof_success()
    {
        $this->claimService
            ->method('uploadProof')
            ->with(1, 'proof.jpg')
            ->willReturn([
                'claim_id' => 1,
                'file' => 'proof.jpg',
                'status' => 'uploaded'
            ]);

        $result = $this->claimService->uploadProof(1, 'proof.jpg');

        $this->assertIsArray($result);
        $this->assertEquals('uploaded', $result['status']);
    }

    /** @test */
    public function test_get_claim_by_id_success()
    {
        $this->claimService
            ->method('getClaimById')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'status' => 'approved'
            ]);

        $result = $this->claimService->getClaimById(1);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
    }
}