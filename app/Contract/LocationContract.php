<?php

namespace App\Contract;

interface LocationContract
{
    public function getPickupLocation(int $claimId);

    public function getDirections(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    );

    public function estimateDistance(
        float $originLat,
        float $originLng,
        float $destLat,
        float $destLng
    );
}