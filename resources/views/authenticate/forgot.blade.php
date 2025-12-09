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
        <h2 class="title">Lupa Password</h2>
        <form action="{{ route('user.store-forgot') }}" method="POST" class="form">
            @csrf
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email anda...">
                @error('email')
                    <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="button-primary w-full text-center">Kirim Link Reset Password</button>
        </form>
    </div>
@endsection
