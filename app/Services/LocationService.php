<?php

namespace App\Services;

use App\Contract\LocationContract;
use App\Models\Claim;

class LocationService implements LocationContract
{
    public function getPickupLocation(int $claimId)
    {
        $claim = Claim::findOrFail($claimId);

        return [
            'claim_id' => $claimId,
            'latitude' => $claim->pickup_latitude,
            'longitude' => $claim->pickup_longitude
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
        $earthRadius = 6371;

        $latDiff = deg2rad($destLat - $originLat);
        $lngDiff = deg2rad($destLng - $originLng);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($originLat)) *
             cos(deg2rad($destLat)) *
             sin($lngDiff / 2) *
             sin($lngDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return [
            'distance' => round($distance, 2) . ' KM'
        ];
    }
}