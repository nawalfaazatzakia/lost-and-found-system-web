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

.login-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
}

.login-card{
    width:100%;
    max-width:450px;
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:18px;
    padding:2rem;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.login-logo{
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

.login-title{
    font-size:24px;
    font-weight:600;
    margin-top:1rem;
    color:var(--text);
}

.login-subtitle{
    color:var(--muted);
    font-size:14px;
    margin-top:6px;
}

.form-group{
    margin-bottom:1rem;
}

.form-label{
    font-size:14px;
    font-weight:500;
    color:var(--muted);
}

.form-control{
    border:1px solid var(--border);
    border-radius:10px;
    padding:12px;
}

.form-control:focus{
    border-color:var(--green);
    box-shadow:0 0 0 3px rgba(29,158,117,.15);
}

.btn-login{
    width:100%;
    background:var(--green);
    color:white;
    border:none;
    border-radius:10px;
    padding:12px;
    font-weight:600;
    transition:.2s;
}

.btn-login:hover{
    background:var(--green-d);
}

.register-link{
    text-align:center;
    margin-top:1rem;
    font-size:14px;
}

.register-link a{
    color:var(--green);
    text-decoration:none;
    font-weight:600;
}
</style>

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-logo">
            <div class="logo-icon">
                🔍
            </div>

            <div class="login-title">
                Lost & Found
            </div>

            <div class="login-subtitle">
                Masuk ke sistem Lost & Found UIN Ar-Raniry
            </div>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="nama@ar-raniry.ac.id"
                    required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

            <div class="register-link">
                Belum punya akun?
                <a href="{{ route('register.show') }}">
                    Daftar sekarang
                </a>
            </div>

        </form>

    </div>

</div>
@endsection