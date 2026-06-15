<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClaimReviewController extends Controller
{
    public function index()
    {
        return view('verification');
    }

    public function show($id)
    {
        return "Detail klaim ".$id;
    }

    public function decide($id)
    {
        return "Klaim diproses";
    }
}