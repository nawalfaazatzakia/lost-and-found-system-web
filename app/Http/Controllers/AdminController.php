<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $totalReports = Report::count();
        $totalClaims  = Claim::count();
        $totalUsers   = User::count();

        $reports = Report::latest()->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'totalReports' => $totalReports,
                'totalClaims' => $totalClaims,
                'totalUsers' => $totalUsers,
                'reports' => $reports,
            ]);
        }

        return view('admin', compact(
            'totalReports',
            'totalClaims',
            'totalUsers',
            'reports'
        ));
    }
}