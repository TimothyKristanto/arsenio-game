@extends('template.authPage')

@section('webTitle', 'Arsenio: Pendaftaran sebagai Pahlawan')

@section('mainContent')
    <div class="align-items-center justify-content-center">

        <h2 class="text-center auth-title">Daftarkan dirimu sebagai pahlawan sekarang juga!</h2>

        <form action="{{ route('register.store') }}" method="POST" class="auth-register align-items-center">
            @csrf
            <div class="form-group">
                <label for="name">
                    Nama
                    @error('name')
                        <span class="error-message"> Error: {{ $message }}</span>
                    @enderror
                </label>
                <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">
                    Email
                    @error('email')
                        <span class="error-message"> Error: {{ $message }}</span>
                    @enderror
                </label>
                <input type="email" class="form-control @error("email") is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="password">
                    Password
                    @error('password')
                        <span class="error-message"> Error: {{ $message }}</span>
                    @enderror
                </label>
                <input type="password" id="password" name="password" class="form-control @error("password") is-invalid @enderror" required>
            </div>

            <div class="form-group mt-3">
                <label for="passwordConfirmation">
                    Konfirmasi Password
                    @error('passwordConfirmation')
                        <span class="error-message"> Error: {{ $message }}</span>
                    @enderror
                </label>
                <input type="password" id="passwordConfirmation" name="passwordConfirmation" class="form-control @error("passwordConfirmation") is-invalid @enderror" required>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-dark mt-3 text-center brown">
                    Daftar
                </button>
            </div>

        </form>

        <div class="d-flex justify-content-end change-auth-register-area">
            <img src="/images/FeatherOnly.png">
            <a href="/" class="change-auth-register">
                Masuk
            </a>
        </div>
    </div>

    @if(session()->has('registerError'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('registerError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif

@endsection
