<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Claim;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalReports = Report::count();
        $totalClaims  = Claim::count();
        $totalUsers   = User::count();

        $reports = Report::latest()->get();

        return view('admin', compact(
            'totalReports',
            'totalClaims',
            'totalUsers',
            'reports'
        ));
    }
}