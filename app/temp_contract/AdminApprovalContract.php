<?php

namespace App\Contracts;

interface AdminApprovalContract
{
    public function getPendingClaims();

    public function approveClaim(int $claimId);

    public function rejectClaim(int $claimId, string $reason);

    public function getClaimDetail(int $claimId);
}