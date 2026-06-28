<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
       $reports = Report::latest()->get();

    $totalReports = Report::count();

    $returnedItems = Report::where('status', 'returned')->count();
    // kalau status di database pakai 'approved' atau 'completed', ganti sesuai itu

    $successRate = $totalReports > 0
        ? round(($returnedItems / $totalReports) * 100)
        : 0;

    return view('home', compact(
        'reports',
        'totalReports',
        'returnedItems',
        'successRate'
    ));
    }

    public function create()
    {
        return view('user.items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in:lost,found'
        ]);

        Report::create([
            ...$validated,
            'user_id' => auth()->id() ?? 1,
            'status' => 'pending'
        ]);

        return redirect()->route('user.beranda')
            ->with('success', 'Barang berhasil dilaporkan');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);

        return view('user.items.show', compact('report'));
    }
}