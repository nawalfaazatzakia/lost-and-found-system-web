<?php

namespace App\Services;

use App\Contract\ClaimContract;
use App\Models\Claim;
use App\Models\ClaimAnswer;

class ClaimService implements ClaimContract
{
    public function submitClaim(array $data)
    {
        $claim = Claim::create([
            'user_id' => $data['user_id'],
            'report_id' => $data['report_id'],
            'status' => 'pending'
        ]);

        if (isset($data['answers'])) {
            foreach ($data['answers'] as $questionId => $answer) {
                ClaimAnswer::create([
                    'claim_id' => $claim->id,
                    'question_id' => $questionId,
                    'answer' => $answer
                ]);
            }
        }

        return [
            'message' => 'Klaim berhasil diajukan',
            'data' => $claim
        ];
    }

    public function calculateMatchScore(array $claimAnswers, array $originalAnswers)
    {
        $total = count($originalAnswers);
        $match = 0;

        foreach ($originalAnswers as $key => $answer) {
            if (
                isset($claimAnswers[$key]) &&
                strtolower(trim($claimAnswers[$key])) === strtolower(trim($answer))
            ) {
                $match++;
            }
        }

        return $total > 0 ? ($match / $total) * 100 : 0;
    }

    public function uploadProof(int $claimId, string $filePath)
    {
        $claim = Claim::findOrFail($claimId);

        $claim->update([
            'proof_file' => $filePath
        ]);

        return [
            'message' => 'Bukti berhasil diunggah',
            'data' => $claim
        ];
    }

    public function getClaimById(int $id)
    {
        return [
            'message' => 'Detail klaim',
            'data' => Claim::with(['answers', 'report'])->findOrFail($id)
        ];
    }
}