<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Requests\ClaimStoreRequest;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $claims = Claim::latest()->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['data' => $claims]);
        }

        return view('verification', compact('claims'));
    }

    public function store(ClaimStoreRequest $request)
    {

        $data = $request->validated();

        $claim = Claim::create([
            'report_id' => $data['report_id'],
            'user_id'   => auth()->id(),
            'proof'     => $data['proof'] ?? null,
            'status'    => 'pending',
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['data' => $claim], 201);
        }

        return redirect()->back()->with('success', 'Klaim berhasil dikirim');
    }

    public function approve(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        $claim->update(['status' => 'approved']);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['data' => $claim]);
        }

        return redirect()->back();
    }

    public function reject(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        $claim->update(['status' => 'rejected']);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['data' => $claim]);
        }

        return redirect()->back();
    }
}