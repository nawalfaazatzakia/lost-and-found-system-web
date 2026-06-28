<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use App\Http\Requests\ClaimStoreRequest;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $claims = Claim::latest()->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Daftar klaim',
                'data' => $claims
            ]);
        }

        return view('verification', compact('claims'));
    }

    public function store(ClaimStoreRequest $request)
    {
        $data = $request->validated();

        $claim = Claim::create([
            'report_id' => $data['report_id'],
            'user_id'   => auth()->id() ?? 1,
            'proof'     => $data['proof'] ?? null,
            'status'    => 'pending',
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Klaim berhasil dibuat',
                'data' => $claim
            ], 201);
        }

        return redirect()->back()->with('success', 'Klaim berhasil dikirim');
    }

    public function show(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Detail klaim',
                'data' => $claim
            ]);
        }

        return view('claims.show', compact('claim'));
    }
}