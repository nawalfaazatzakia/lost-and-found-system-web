<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |------------------------------------------------------------------
    | USER (Mahasiswa) LOGIN
    |------------------------------------------------------------------
    */

    public function showUserLogin()
    {
        // Kalau sudah login sebagai mahasiswa, langsung ke beranda
        if (Auth::check() && Auth::user()->role === 'mahasiswa') {
            return redirect()->route('user.beranda');
        }
        return view('auth.login-user');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string',
            'password' => 'required|string',
        ], [
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'password.required' => 'Password / NIM wajib diisi.',
        ]);

        $credentials = [
            'whatsapp' => $request->whatsapp,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials) && Auth::user()->role === 'mahasiswa') {
            $request->session()->regenerate();
            return redirect()->intended(route('user.beranda'))
                ->with('success', 'Selamat datang, ' . Auth::user()->nama . '!');
        }

        return back()
            ->withInput($request->only('whatsapp'))
            ->with('error', 'Nomor WhatsApp atau password salah.');
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login')
            ->with('success', 'Kamu berhasil keluar.');
    }


    /*
    |------------------------------------------------------------------
    | ADMIN LOGIN — halaman & logic terpisah dari user
    |------------------------------------------------------------------
    */

    public function showAdminLogin()
    {
        // Kalau sudah login sebagai admin, langsung ke dashboard
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string',
            'password' => 'required|string',
        ], [
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'whatsapp' => $request->whatsapp,
            'password' => $request->password,
        ];

        // Pastikan yang login memang admin
        if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, Admin ' . Auth::user()->nama . '!');
        }

        // Kalau berhasil login tapi bukan admin, logout lagi
        Auth::logout();

        return back()
            ->withInput($request->only('whatsapp'))
            ->with('error', 'Akun ini bukan admin atau password salah.');
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')
            ->with('success', 'Admin berhasil keluar.');
    }
}