<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ItemReviewController extends Controller
{
    public function index()
    {
        return "Daftar laporan barang";
    }

    public function show($id)
    {
        return "Detail laporan ".$id;
    }

    public function updateStatus($id)
    {
        return "Status laporan diperbarui";
    }
}