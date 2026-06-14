<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class PickupController extends Controller
{
    public function show($id)
    {
        $report = Report::find($id);

        if (request()->wantsJson() || request()->is('api/*')) {
            if (! $report) {
                return response()->json(['message' => 'Report not found'], 404);
            }
            return response()->json(['data' => $report]);
        }

        return view('pickup', compact('report'));
    }
}
