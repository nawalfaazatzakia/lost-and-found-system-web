<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contract\AdminApprovalContract;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $approvalService;

    public function __construct(AdminApprovalContract $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    /**
     * GET /api/v1/admin/claims/pending
     * Daftar klaim yang menunggu persetujuan.
     */
    public function pendingClaims(Request $request)
    {
        $this->requireAdmin($request);

        $result = $this->approvalService->getPendingClaims();

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ]);
    }

    /**
     * POST /api/v1/admin/claims/{id}/approve
     * Menyetujui klaim.
     */
    public function approveClaim(Request $request, $id)
    {
        $this->requireAdmin($request);

        $result = $this->approvalService->approveClaim((int) $id);

        $status = isset($result['error']) ? 'error' : 'success';
        $code   = isset($result['error']) ? 422 : 200;

        return response()->json([
            'status'  => $status,
            'message' => $result['message'],
            'data'    => $result['data'] ?? null,
        ], $code);
    }

    /**
     * POST /api/v1/admin/claims/{id}/reject
     * Menolak klaim.
     */
    public function rejectClaim(Request $request, $id)
    {
        $this->requireAdmin($request);

        $request->validate([
            'reason' => 'required|string',
        ]);

        $result = $this->approvalService->rejectClaim((int) $id, $request->reason);

        $status = isset($result['error']) ? 'error' : 'success';
        $code   = isset($result['error']) ? 422 : 200;

        return response()->json([
            'status'  => $status,
            'message' => $result['message'],
            'data'    => $result['data'] ?? null,
        ], $code);
    }

    /**
     * GET /api/v1/admin/claims/{id}
     * Detail klaim tertentu (untuk review admin).
     */
    public function claimDetail(Request $request, $id)
    {
        $this->requireAdmin($request);

        $result = $this->approvalService->getClaimDetail((int) $id);

        $status = isset($result['error']) ? 'error' : 'success';
        $code   = isset($result['error']) ? 404 : 200;

        return response()->json([
            'status'  => $status,
            'message' => $result['message'],
            'data'    => $result['data'] ?? null,
        ], $code);
    }

    // -----------------------------------------------
    // Helper
    // -----------------------------------------------

    private function requireAdmin(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(response()->json([
                'status'  => 'error',
                'message' => 'Akses ditolak. Hanya admin yang dapat melakukan aksi ini.',
            ], 403));
        }
    }
}
