<?php

namespace App\Http\Controllers;

use App\Contract\AdminApprovalContract;
use Illuminate\Http\Request;

class AdminApprovalController extends Controller
{
    protected $approvalService;

    public function __construct(AdminApprovalContract $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    public function pending()
    {
        return response()->json(
            $this->approvalService->getPendingClaims()
        );
    }

    public function approve($id)
    {
        return response()->json(
            $this->approvalService->approveClaim($id)
        );
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        return response()->json(
            $this->approvalService->rejectClaim($id, $request->reason)
        );
    }
}