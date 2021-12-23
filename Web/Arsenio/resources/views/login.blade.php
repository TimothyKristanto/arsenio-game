@extends('template.authPage')

@section('webTitle', 'Arsenio: Lanjutkan Petualangan sebagai Pahlawan')

@section('mainContent')

<div class="align-items-center justify-content-center">

    <h2 class="text-center auth-title">Lanjutkan Petualanganmu sebagai Pahlawan!</h2>

    <form action="/" method="POST" class="auth-login align-items-center">
        @csrf
        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-dark mt-5 text-center brown">
                Masuk
            </button>
        </div>

    </form>


</div>

<div class="d-flex justify-content-end change-auth-login-area">
    <img src="/images/FeatherOnly.png">
    <a href="{{ route('register.index') }}" class="change-auth-login">
        Daftar
    </a>
</div>

@if(session()->has('loginError'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@endsection
