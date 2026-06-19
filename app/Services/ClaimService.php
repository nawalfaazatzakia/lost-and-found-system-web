<?php

namespace App\Services;

use App\Contracts\ClaimContract;

class ClaimService implements ClaimContract
{
    public function submitClaim(array $data)
    {
        return [
            'message' => 'Klaim berhasil diajukan',
            'data' => $data
        ];
    }

    public function calculateMatchScore(
        array $claimAnswers,
        array $originalAnswers
    ) {
        $total = count($originalAnswers);
        $match = 0;

        foreach ($originalAnswers as $key => $answer) {
            if (
                isset($claimAnswers[$key]) &&
                strtolower($claimAnswers[$key]) ==
                strtolower($answer)
            ) {
                $match++;
            }
        }

        return ($match / $total) * 100;
    }

    public function uploadProof(
        int $claimId,
        string $filePath
    ) {
        return [
            'message' => 'Bukti berhasil diunggah',
            'claim_id' => $claimId,
            'file' => $filePath
        ];
    }

    public function getClaimById(int $id)
    {
        return [
            'message' => 'Detail klaim',
            'id' => $id
        ];
    }
}