<?php

namespace App\Http\Controllers;

use App\Contract\ReportContract;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportContract $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return response()->json(
            $this->reportService->getAllReports()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_name' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|string',
            'type' => 'required|in:lost,found'
        ]);

        if ($validated['type'] === 'lost') {
            $result = $this->reportService->createLostReport($validated);
        } else {
            $result = $this->reportService->createFoundReport($validated);
        }

        return response()->json($result);
    }

    public function show($id)
    {
        return response()->json(
            $this->reportService->getReportById($id)
        );
    }

    public function destroy($id)
    {
        return response()->json(
            $this->reportService->deleteReport($id)
        );
    }
}