<?php

namespace App\Contracts;

interface PickupContract
{
    public function getMapLocation($reportId);

    public function openNavigation($reportId);

    public function confirmHandover($reportId);

    public function closeReport($reportId);
}