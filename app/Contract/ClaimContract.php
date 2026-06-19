<?php

namespace App\Contract;

interface ClaimContract
{
    public function submitClaim(array $data);

    public function calculateMatchScore(
        array $claimAnswers,
        array $originalAnswers
    );

    public function uploadProof(int $claimId, string $filePath);

    public function getClaimById(int $id);
}