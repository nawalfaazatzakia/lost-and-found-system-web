<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contract\AdminApprovalContract;

class ClaimReviewController extends Controller
{
    protected $approvalService;

    public function __construct(AdminApprovalContract $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    public function index()
    {
        $claims = $this->approvalService->getPendingClaims();

        return view('verification', compact('claims'));
    }

    public function show($id)
    {
        $claim = $this->approvalService->getClaimDetail($id);

        return response()->json($claim);
    }

    public function decide($id)
    {
        $result = $this->approvalService->approveClaim($id);

        return response()->json($result);
    }
}