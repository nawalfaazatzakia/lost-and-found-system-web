<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contract\ReportContract;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportContract $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * GET /api/v1/reports
     * Menampilkan seluruh laporan.
     */
    public function index(Request $request)
    {
        $result = $this->reportService->getAllReports();

        // Filter opsional berdasarkan type: lost / found
        if ($request->has('type')) {
            $type = $request->query('type');
            $result['data'] = $result['data']->where('type', $type)->values();
        }

        return response()->json([
            'status' => 'success',
            'message' => $result['message'],
            'data'   => $result['data'],
        ]);
    }

    /**
     * POST /api/v1/lost-items
     * Melaporkan barang hilang.
     */
    public function storeLost(Request $request)
    {
        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'image'       => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['type']    = 'lost';

        $result = $this->reportService->createLostReport($validated);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ], 201);
    }

    /**
     * POST /api/v1/found-items
     * Melaporkan barang ditemukan.
     */
    public function storeFound(Request $request)
    {
        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'image'       => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['type']    = 'found';

        $result = $this->reportService->createFoundReport($validated);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ], 201);
    }

    /**
     * GET /api/v1/reports/{id}
     * Detail laporan.
     */
    public function show($id)
    {
        $result = $this->reportService->getReportById((int) $id);

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data'],
        ]);
    }

    /**
     * DELETE /api/v1/reports/{id}
     * Hapus laporan (hanya pemilik atau admin).
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->reportService->getReportById((int) $id);
        $report = $result['data'];

        $user = $request->user();

        if ($report->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda tidak memiliki izin untuk menghapus laporan ini.',
            ], 403);
        }

        $deleted = $this->reportService->deleteReport((int) $id);

        return response()->json([
            'status'  => 'success',
            'message' => $deleted['message'],
        ]);
    }
}
