@extends('auth.main')
@section('title', 'Login')
@section('content')
    <div class="card-body">
        <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
        </a>
        <p class="text-center">REGISTRATION</p>
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    aria-describedby="textHelp" name="email">

                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">SignUp</button>
            <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold">Sudah Punya Akun?</p>
                <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
@endsection
