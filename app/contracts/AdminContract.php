<?php

namespace App\Contracts;

interface AdminContract
{
    public function getPendingClaims();

    public function approveClaim($claimId);

    public function rejectClaim($claimId);

    public function getDashboardData();
}