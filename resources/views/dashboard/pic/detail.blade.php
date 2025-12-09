@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input">
                <label for="username">Nama PIC</label>
                <input type="text" class="input" name="username" value="{{ $pic->username }}" readonly>
            </div>
            <div class="form-input cols-span-2">
                <label for="events_id">Event PIC</label>
                <select class="input" name="events_id" id="events_id" disabled>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="button-group">
                <a href="{{ route('pic.index') }}" class="button-secondary">Kembali ke Halaman PIC</a>
            </div>
        </form>
    </div>
@endsection
