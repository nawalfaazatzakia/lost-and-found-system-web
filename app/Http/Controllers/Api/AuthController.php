<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * POST /api/v1/register
     * Mendaftarkan akun pengguna baru.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'nim'      => 'nullable|string|unique:users,nim',
            'prodi'    => 'nullable|string',
            'phone'    => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'nim'      => $validated['nim'] ?? null,
            'prodi'    => $validated['prodi'] ?? null,
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        $token = PersonalAccessToken::generateFor($user);

        return response()->json([
            'status'  => 'success',
            'message' => 'Registrasi berhasil',
            'token'   => $token->token,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'nim'   => $user->nim,
                'prodi' => $user->prodi,
                'phone' => $user->phone,
                'role'  => $user->role,
            ],
        ], 201);
    }

    /**
     * POST /api/v1/login
     * Autentikasi pengguna dan menghasilkan token akses.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Email atau password salah.',
            ], 401);
        }

        // Hapus token lama, buat token baru
        PersonalAccessToken::where('user_id', $user->id)->delete();
        $token = PersonalAccessToken::generateFor($user);

        return response()->json([
            'status' => 'success',
            'token'  => $token->token,
            'user'   => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'nim'   => $user->nim,
                'prodi' => $user->prodi,
                'phone' => $user->phone,
                'role'  => $user->role,
            ],
        ]);
    }

    /**
     * POST /api/v1/logout
     * Menghapus token akses (logout).
     * Butuh: Authorization: Bearer <token>
     */
    public function logout(Request $request)
    {
        $bearerToken = $request->bearerToken();

        if ($bearerToken) {
            PersonalAccessToken::where('token', $bearerToken)->delete();
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Logout berhasil.',
        ]);
    }

    /**
     * GET /api/v1/profile
     * Menampilkan data profil pengguna yang sedang login.
     * Butuh: Authorization: Bearer <token>
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'nim'   => $user->nim,
                'prodi' => $user->prodi,
                'phone' => $user->phone,
                'role'  => $user->role,
            ],
        ]);
    }
}
