@extends('template.authenticate')

@section('content')
    <div class="authenticate-banner login"></div>
    <div class="authenticate-content">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <h2 class="title">Reset Password Baru</h2>
        <form action="{{ route('user.store-reset') }}" method="POST" class="form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email anda...">
                @error('email')
                    <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" class="input" name="password" placeholder="Masukkan password anda...">
                @error('password')
                    <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="input" name="password_confirmation" placeholder="Masukkan password konfirmasi anda...">
                @error('password_confirmation')
                    <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="button-primary w-full text-center">Reset Password</button>
        </form>
    </div>
@endsection
