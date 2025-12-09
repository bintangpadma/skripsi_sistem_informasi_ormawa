@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('pic.store') }}" method="POST" class="form !grid-cols-2" enctype="multipart/form-data">
            @csrf
            <div class="form-input cols-span-2">
                <label for="username">Nama PIC</label>
                <input type="text" class="input" name="username" placeholder="Masukkan username pic...">
                @error('username')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input cols-span-2">
                <label for="password">Password</label>
                <input type="password" class="input" name="password" placeholder="Masukkan password pic...">
                @error('password')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input cols-span-2">
                <label for="events_id">Event PIC</label>
                <select class="input" name="events_id" id="events_id">
                    <option value="">Pilih event pic...</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
                @error('events_id')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah PIC</button>
                <a href="{{ route('pic.index') }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>
@endsection
