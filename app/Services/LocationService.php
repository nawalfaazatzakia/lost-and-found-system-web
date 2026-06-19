<?php

namespace App\Services;

use App\Contract\LocationContract;

class LocationService implements LocationContract
{
    public function getPickupLocation(int $claimId)
    {
        return [
            'claim_id' => $claimId,
            'latitude' => '-6.200000',
            'longitude' => '106.816666'
        ];
    }

    public function getDirections(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    ) {
        return [
            'origin' => [$originLat, $originLng],
            'destination' => [$destLat, $destLng]
        ];
    }

    public function estimateDistance(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    ) {
        return [
            'distance' => '2.5 KM',
            'duration' => '8 Menit'
        ];
    }
}