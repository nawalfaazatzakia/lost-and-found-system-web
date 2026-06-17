@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow p-5 mx-auto" style="max-width:500px;">
        <h1 class="mb-3">Lost & Found</h1>
        <p class="text-muted">Pilih jenis login</p>

        <a href="{{ route('login.user') }}" class="btn btn-primary w-100 mb-3">
            Login Sebagai User
        </a>

        <a href="{{ route('login.admin') }}" class="btn btn-danger w-100">
            Login Sebagai Admin
        </a>
    </div>
</div>
@endsection