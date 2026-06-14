<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::latest()->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['data' => $reports]);
        }

        return view('home', compact('reports'));
    }
}
