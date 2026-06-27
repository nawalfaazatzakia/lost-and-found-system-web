<?php

namespace App\Services;

use App\Contract\AdminApprovalContract;
use App\Models\Claim;
use App\Models\AdminReview;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminApprovalService implements AdminApprovalContract
{
    public function getPendingClaims()
    {
        $claims = Claim::with([
            'user',
            'report',
            'answers'
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();

        return [
            'message' => 'Daftar klaim yang menunggu persetujuan',
            'data' => $claims
        ];
    }

    public function approveClaim(int $claimId)
    {
        DB::beginTransaction();

        try {
            $claim = Claim::with('report')->findOrFail($claimId);

            if ($claim->status !== 'pending') {
                throw new Exception('Klaim sudah diproses');
            }

            $claim->update([
                'status' => 'approved'
            ]);

            // update report agar item dianggap sudah ditemukan pemiliknya
            if ($claim->report) {
                $claim->report->update([
                    'status' => 'claimed'
                ]);
            }

            AdminReview::create([
                'claim_id' => $claim->id,
                'admin_id' => auth()->id(),
                'decision' => 'approved',
                'notes' => 'Klaim disetujui admin'
            ]);

            DB::commit();

            return [
                'message' => 'Klaim berhasil disetujui',
                'data' => $claim
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'message' => 'Gagal menyetujui klaim',
                'error' => $e->getMessage()
            ];
        }
    }

    public function rejectClaim(int $claimId, string $reason)
    {
        DB::beginTransaction();

        try {
            $claim = Claim::findOrFail($claimId);

            if ($claim->status !== 'pending') {
                throw new Exception('Klaim sudah diproses');
            }

            $claim->update([
                'status' => 'rejected'
            ]);

            AdminReview::create([
                'claim_id' => $claim->id,
                'admin_id' => auth()->id(),
                'decision' => 'rejected',
                'notes' => $reason
            ]);

            DB::commit();

            return [
                'message' => 'Klaim berhasil ditolak',
                'data' => $claim
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'message' => 'Gagal menolak klaim',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getClaimDetail(int $claimId)
    {
        try {
            $claim = Claim::with([
                'user',
                'report',
                'answers',
                'adminReviews'
            ])->findOrFail($claimId);

            return [
                'message' => 'Detail klaim',
                'data' => $claim
            ];
        } catch (Exception $e) {
            return [
                'message' => 'Klaim tidak ditemukan',
                'error' => $e->getMessage()
            ];
        }
    }
}