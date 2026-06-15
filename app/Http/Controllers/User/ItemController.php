<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return "Form tambah barang";
    }

    public function store()
    {
        return "Simpan barang";
    }

    public function show($id)
    {
        return "Detail barang ID: ".$id;
    }
}