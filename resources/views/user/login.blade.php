@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow p-4" style="width: 400px;">
        
        <h2 class="text-center mb-3">Login User</h2>
        <p class="text-center text-muted">
            Masuk untuk melihat status laporan dan melakukan klaim barang.
        </p>

        <form>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Masukkan email">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>

        <div class="text-center mt-3">
            <small>
                Belum punya akun?
                <a href="#">Daftar di sini</a>
            </small>
        </div>
    </div>
</div>
@endsection