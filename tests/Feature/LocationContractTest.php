<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Contracts\LocationContract;
use PHPUnit\Framework\MockObject\MockObject;

class LocationContractTest extends TestCase
{
    /**
     * @var LocationContract|MockObject
     */
    protected $locationService;

    protected function setUp(): void
    {
        parent::setUp();

        // mock LocationContract
        $this->locationService = $this->createMock(LocationContract::class);

        // bind ke Laravel container
        $this->app->instance(
            LocationContract::class,
            $this->locationService
        );
    }

    /** @test */
    public function test_get_pickup_location_success()
    {
        $this->locationService
            ->method('getPickupLocation')
            ->with(1)
            ->willReturn([
                'lat' => 5.5483,
                'lng' => 95.3238,
                'address' => 'Banda Aceh'
            ]);

        $result = $this->locationService->getPickupLocation(1);

        $this->assertIsArray($result);
        $this->assertEquals('Banda Aceh', $result['address']);
    }

    /** @test */
    public function test_get_directions_success()
    {
        $this->locationService
            ->method('getDirections')
            ->with(
                5.5, 95.3,
                5.6, 95.4
            )
            ->willReturn([
                'distance' => '12 km',
                'duration' => '25 mins'
            ]);

        $result = $this->locationService->getDirections(
            5.5, 95.3,
            5.6, 95.4
        );

        $this->assertIsArray($result);
        $this->assertArrayHasKey('distance', $result);
    }

    /** @test */
    public function test_estimate_distance_success()
    {
        $this->locationService
            ->method('estimateDistance')
            ->with(
                5.5, 95.3,
                5.6, 95.4
            )
            ->willReturn(12.5);

        $result = $this->locationService->estimateDistance(
            5.5, 95.3,
            5.6, 95.4
        );

        $this->assertIsFloat($result);
        $this->assertEquals(12.5, $result);
    }
}