<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Report;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::latest()->get();

        return view('verification', compact('claims'));
    }

    public function store(Request $request)
    {
        Claim::create([
            'report_id' => $request->report_id,
            'user_id'   => auth()->id(),
            'proof'     => $request->proof,
            'status'    => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Klaim berhasil dikirim');
    }

    public function approve($id)
    {
        $claim = Claim::findOrFail($id);

        $claim->update([
            'status' => 'approved'
        ]);

        return redirect()->back();
    }

    public function reject($id)
    {
        $claim = Claim::findOrFail($id);

        $claim->update([
            'status' => 'rejected'
        ]);

        return redirect()->back();
    }
}