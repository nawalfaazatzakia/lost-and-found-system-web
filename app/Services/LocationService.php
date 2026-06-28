<?php

namespace App\Services;

use App\Contract\LocationContract;
use App\Models\Claim;

class LocationService implements LocationContract
{
    public function getPickupLocation(int $claimId)
    {
        $claim  = Claim::with('report')->findOrFail($claimId);
        $report = $claim->report;

        return [
            'message'  => 'Lokasi pengambilan barang',
            'claim_id' => $claimId,
            'location' => $report ? $report->location : null,
        ];
    }

    public function getDirections(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    ) {
        $distance = $this->hitungJarak($originLat, $originLng, $destLat, $destLng);

        return [
            'message'     => 'Arah rute berhasil dihitung',
            'origin'      => ['latitude' => $originLat, 'longitude' => $originLng],
            'destination' => ['latitude' => $destLat,   'longitude' => $destLng],
            'distance_km' => $distance,
            'maps_url'    => "https://www.google.com/maps/dir/{$originLat},{$originLng}/{$destLat},{$destLng}",
        ];
    }

    public function estimateDistance(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    ) {
        $distance = $this->hitungJarak($originLat, $originLng, $destLat, $destLng);

        return [
            'message'     => 'Estimasi jarak berhasil dihitung',
            'distance_km' => $distance,
            'distance'    => $distance . ' KM',
        ];
    }

    // -----------------------------------------------
    // Helper: Haversine Formula
    // -----------------------------------------------
    private function hitungJarak(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;

        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lngDiff / 2) * sin($lngDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }
}
