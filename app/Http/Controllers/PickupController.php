<?php

namespace App\Http\Controllers;

use App\Contract\LocationContract;
use Illuminate\Http\Request;
use App\Models\Report;

class PickupController extends Controller
{
    protected $locationService;

    public function __construct(LocationContract $locationService)
    {
        $this->locationService = $locationService;
    }

    public function show($id)
    {
        $report = Report::find($id);

        $pickupLocation = $this->locationService->getPickupLocation($id);

        if (request()->wantsJson() || request()->is('api/*')) {
            if (! $report) {
                return response()->json(['message' => 'Report not found'], 404);
            }

            return response()->json([
                'data' => $report,
                'location' => $pickupLocation
            ]);
        }

        return view('pickup', compact('report', 'pickupLocation'));
    }
}