@extends('layouts.app')

@section('content')
<style>
:root{
    --green:#1D9E75;
    --green-d:#0F6E56;
    --green-l:#E1F5EE;
    --bg:#F7F9F8;
    --surface:#FFFFFF;
    --border:#E2E8E5;
    --text:#1A1F1C;
    --muted:#6B7C74;
}

.register-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
}

.register-card{
    width:100%;
    max-width:550px;
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:18px;
    padding:2rem;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.register-logo{
    text-align:center;
    margin-bottom:1.5rem;
}

.logo-icon{
    width:65px;
    height:65px;
    background:var(--green);
    color:white;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    font-size:28px;
}

.register-title{
    font-size:24px;
    font-weight:600;
    margin-top:1rem;
}

.register-subtitle{
    color:var(--muted);
    font-size:14px;
    margin-top:6px;
}

.form-group{
    margin-bottom:1rem;
}

.form-label{
    display:block;
    margin-bottom:6px;
    font-size:14px;
    font-weight:500;
    color:var(--muted);
}

.form-control{
    width:100%;
    border:1px solid var(--border);
    border-radius:10px;
    padding:12px;
}

.form-control:focus{
    outline:none;
    border-color:var(--green);
    box-shadow:0 0 0 3px rgba(29,158,117,.15);
}

.btn-register{
    width:100%;
    background:var(--green);
    color:white;
    border:none;
    border-radius:10px;
    padding:12px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
}

.btn-register:hover{
    background:var(--green-d);
}

.login-link{
    text-align:center;
    margin-top:1rem;
    font-size:14px;
}

.login-link a{
    color:var(--green);
    text-decoration:none;
    font-weight:600;
}
</style>

<div class="register-wrapper">
    <div class="register-card">

        <div class="register-logo">
            <div class="logo-icon">📝</div>

            <div class="register-title">
                Daftar Akun
            </div>

            <div class="register-subtitle">
                Buat akun Lost & Found UIN Ar-Raniry
            </div>
        </div>

        <form method="POST" action="{{ route('user.register.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Prodi</label>
                <input type="text" name="prodi" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">No HP</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn-register">
                Daftar
            </button>

            <div class="login-link">
                Sudah punya akun?
                <a href="{{ route('user.login') }}">Masuk</a>
            </div>
        </form>

    </div>
</div>
@endsection