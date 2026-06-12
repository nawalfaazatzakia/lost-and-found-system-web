<?php

namespace App\Contracts;

interface ClaimContract
{
    public function submitClaim(array $data);

    public function verifyClaim($claimId);

    public function getClaimStatus($claimId);

    public function uploadProof(array $data);
}