<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contract\ClaimContract;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    protected $claimService;

    public function __construct(ClaimContract $claimService)
    {
        $this->claimService = $claimService;
    }

    /**
     * GET /api/v1/claims
     * Daftar semua klaim (admin) atau klaim milik user.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $claims = \App\Models\Claim::with(['user', 'report'])->latest()->get();
        } else {
            $claims = \App\Models\Claim::with(['report'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar klaim',
            'data'    => $claims,
        ]);
    }

    /**
     * POST /api/v1/claims
     * Mengajukan klaim atas suatu laporan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_id' => 'required|integer|exists:reports,id',
            'proof'     => 'nullable|string',
            'answers'   => 'nullable|array',
        ]);

        $validated['user_id'] = $request->user()->id;

        $result = $this->claimService->submitClaim($validated);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ], 201);
    }

    /**
     * GET /api/v1/claims/{id}
     * Detail klaim.
     */
    public function show(Request $request, $id)
    {
        $result = $this->claimService->getClaimById((int) $id);
        $claim  = $result['data'];
        $user   = $request->user();

        if ($user->role !== 'admin' && $claim->user_id !== $user->id) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda tidak memiliki akses ke klaim ini.',
            ], 403);
        }

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $claim,
        ]);
    }
}
