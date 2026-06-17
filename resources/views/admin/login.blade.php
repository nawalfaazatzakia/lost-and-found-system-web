@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow p-4 border-danger" style="width: 400px;">

        <h2 class="text-center mb-3 text-danger">Login Admin</h2>
        <p class="text-center text-muted">
            Halaman khusus administrator Lost & Found.
        </p>

        <form>
            <div class="mb-3">
                <label class="form-label">Email Admin</label>
                <input type="email" class="form-control" placeholder="Masukkan email admin">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn btn-danger w-100">
                Login Admin
            </button>
        </form>

        <div class="mt-3 text-center">
            <small class="text-muted">
                Hanya administrator yang memiliki akses ke dashboard admin.
            </small>
        </div>

    </div>
</div>
@endsection