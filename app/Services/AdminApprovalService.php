<?php

namespace App\Services;

use App\Contract\AdminApprovalContract;

class AdminApprovalService implements AdminApprovalContract
{
    public function getPendingClaims()
    {
        return [
            'message' => 'Daftar klaim yang menunggu persetujuan',
            'data' => []
        ];
    }

    public function approveClaim(int $claimId)
    {
        return [
            'message' => 'Klaim berhasil disetujui',
            'claim_id' => $claimId,
            'status' => 'approved'
        ];
    }

    public function rejectClaim(int $claimId, string $reason)
    {
        return [
            'message' => 'Klaim ditolak',
            'claim_id' => $claimId,
            'status' => 'rejected',
            'reason' => $reason
        ];
    }

    public function getClaimDetail(int $claimId)
    {
        return [
            'message' => 'Detail klaim',
            'claim_id' => $claimId
        ];
    }
}