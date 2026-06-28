<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return "Daftar user";
    }

    public function show($id)
    {
        return "Detail user ".$id;
    }

    public function destroy($id)
    {
        return "User dihapus";
    }
}