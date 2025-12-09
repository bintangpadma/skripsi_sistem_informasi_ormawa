@extends('template.homepage')

@section('content')
    <section class="form-recruitment container mt-[44px] lg:mt-[56px]">
        <div class="recruitment-banner">
            <img src="{{ asset('assets/image/banner/banner-recruitment.jpg') }}" alt="Banner Image" class="banner-image">
        </div>
        <div class="recruitment-form">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            @php
                \Carbon\Carbon::setLocale('id');
                $today = \Carbon\Carbon::now('Asia/Jakarta');
                $start = \Carbon\Carbon::parse($event->start_date)->startOfDay();
                $end = \Carbon\Carbon::parse($event->end_date)->endOfDay();

                $isOpen = $today->between($start, $end);
            @endphp
            <div class="detail-group flex gap-[16px] items-center mb-[12px]">
                <p class="detail-date text-[0.813rem] lg:text-[0.875rem] leading-[112%] text-light/[0.62] flex gap-[8px] items-center">
                    <i class="fa-regular fa-calendar text-light/[0.62]"></i>
                    {{ $start->translatedFormat('d F Y') }} - {{ $end->translatedFormat('d F Y') }}
                </p>
                <p class="detail-quota text-[0.813rem] lg:text-[0.875rem] leading-[112%] text-light/[0.62] flex gap-[8px] items-center">
                    <i class="fa-regular fa-user text-light/[0.62]"></i>
                    Kuota {{ $event->quota }} Orang
                </p>
            </div>
            <h2 class="title mb-[24px]">Pendaftaran Panitia {{$event->name}}</h2>
            <form action="{{ route('event-recruitment.store', $event) }}" method="POST" class="form lg:!grid-cols-2">
                @csrf
                <div class="form-input">
                    <label for="event_divisions_id">Divisi</label>
                    <select class="input" required name="event_divisions_id">
                        <option value="">Pilih divisi anda...</option>
                        @foreach($event->event_divisions as $eventDivision)
                            @if($eventDivision->status)
                                <option value="{{ $eventDivision->id }}">{{ $eventDivision->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('event_divisions_id')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="student_name">Nama Mahasiswa</label>
                    <input type="text" class="input" required name="student_name" placeholder="Masukkan nama mahasiswa anda..." value="{{ old('student_name') }}">
                    @error('student_name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="student_code">NIM</label>
                    <input type="number" class="input" required name="student_code" placeholder="Masukkan nim anda..." value="{{ old('student_code') }}">
                    @error('student_code')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" class="input" required name="email" placeholder="Masukkan email perekrut..." value="{{ old('email') }}">
                    @error('email')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="number_phone">Nomor Telepon</label>
                    <input type="text" class="input" required name="number_phone" placeholder="Masukkan nomor telepon anda..." value="{{ old('number_phone') }}" pattern="^(^\+62|62|0)8[1-9][0-9]{6,11}$" title="Nomor telepon harus diawali 08, 62, atau +62 dan hanya untuk nomor seluler Indonesia.">
                    @error('number_phone')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="study_program">Program Studi</label>
                    <select class="input" required name="study_program">
                        <option value="">Pilih program studi anda...</option>
                        <option value="informatika">Informatika</option>
                        <option value="sistem informasi">Sistem Informasi</option>
                        <option value="sistem informasi akuntansi">Sistem Informasi Akuntansi</option>
                        <option value="desain komunikasi visual">Desain Komunikasi Visual</option>
                        <option value="management">Management</option>
                        <option value="akuntansi">Akuntansi</option>
                        <option value="bisnis digital">Bisnis Digital</option>
                    </select>
                    @error('study_program')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="class">Kelas</label>
                    <select class="input" required name="class">
                        <option value="">Pilih kelas anda...</option>
                        <option value="pagi">Pagi</option>
                        <option value="malam">Malam</option>
                    </select>
                    @error('class')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="year_appointment">Tahun Angkatan</label>
                    <select class="input" required name="year_appointment">
                        <option value="">Pilih tahun angkatan anda...</option>
                        @foreach($classYears as $classYear)
                            <option value="{{ $classYear }}">{{ $classYear }}</option>
                        @endforeach
                    </select>
                    @error('year_appointment')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="reason">Motivasi/ Alasan Mengikuti Kepanitiaan</label>
                    <textarea rows="4" class="input" required name="reason" placeholder="Masukkan motivasi/ alasan mengikuti kepanitiaan anda..."></textarea value="{{ old('reason') }}">
                    @error('reason')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary w-full text-center font-xd-prime-medium">Daftar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
