<?php

namespace App\Services;

use App\Contract\ClaimContract;
use App\Models\Claim;
use App\Models\ClaimAnswer;
use App\Models\VerificationQuestion;

class ClaimService implements ClaimContract
{
    public function submitClaim(array $data)
    {
        $claim = Claim::create([
            'user_id'   => $data['user_id'],
            'report_id' => $data['report_id'],
            'proof'     => $data['proof'] ?? null,
            'status'    => 'pending',
        ]);

        // Simpan jawaban verifikasi jika ada
        if (isset($data['answers']) && is_array($data['answers'])) {
            foreach ($data['answers'] as $questionId => $answer) {
                // Cek apakah jawaban cocok dengan expected_answer
                $question = VerificationQuestion::find($questionId);
                $isMatch  = $question
                    ? strtolower(trim($answer)) === strtolower(trim($question->expected_answer))
                    : false;

                ClaimAnswer::create([
                    'claim_id'                 => $claim->id,
                    'verification_question_id' => $questionId,
                    'answer'                   => $answer,
                    'is_match'                 => $isMatch,
                ]);
            }
        }

        return [
            'message' => 'Klaim berhasil diajukan',
            'data'    => $claim->load(['answers', 'report']),
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
            'proof' => $filePath,
        ]);

        return [
            'message' => 'Bukti berhasil diunggah',
            'data'    => $claim,
        ];
    }

    public function getClaimById(int $id)
    {
        return [
            'message' => 'Detail klaim',
            'data'    => Claim::with(['answers.question', 'report', 'user', 'handover', 'adminReviews'])->findOrFail($id),
        ];
    }
}
