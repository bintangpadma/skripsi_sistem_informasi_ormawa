@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('pic.update', $pic) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input">
                <label for="username">Nama Event</label>
                <input type="text" class="input" name="username" placeholder="Masukkan username pic..." value="{{ $pic->username }}">
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
                        <option value="{{ $event->id }}" {{ $pic->events_id === $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                    @endforeach
                </select>
                @error('events_id')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('pic.index') }}" class="button-secondary">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection
