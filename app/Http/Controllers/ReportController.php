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
        $reports = $this->reportService->getAllReports();

        return view('home', compact('reports'));
    }

    public function show($id)
    {
        $report = $this->reportService->getReportById($id);

        return view('report-detail', compact('report'));
    }

    public function storeLost(Request $request)
    {
        $this->reportService->createLostReport($request->all());

        return redirect()->back();
    }

    public function storeFound(Request $request)
    {
        $this->reportService->createFoundReport($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->reportService->deleteReport($id);

        return redirect()->back();
    }
}