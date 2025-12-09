@extends('template.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <div class="content-menu content-table">
        <div class="table-header">
            <form method="GET" class="form">
                <input type="search" class="input" name="search" placeholder="Cari PIC..." value="{{ $search }}">
            </form>
            <a href="{{ route('pic.create') }}" class="button-primary">Tambah PIC</a>
        </div>
        <div class="table-group">
            <table>
                <thead>
                <tr>
                    <th>Nama PIC</th>
                    <th>Event</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($pics->count() == 0)
                    <td colspan="4">Data PIC tidak ditemukan!</td>
                @else
                    @foreach ($pics as $pic)
                        <tr>
                            <td>{{ $pic->username }}</td>
                            <td>{{ $pic->event->name }}</td>
                            <td>
                                <div class="action-button">
                                    <a href="{{ route('pic.show', $pic) }}" class="button icon-detail">
                                        <span class="bg-detail-primary"></span>
                                    </a>
                                    <a href="{{ route('pic.edit', $pic) }}" class="button icon-edit">
                                        <span class="bg-edit-warning"></span>
                                    </a>
                                    <button class="button icon-delete" data-target="deleteModal" data-id="{{ $pic->id }}" onclick="openModal(this)">
                                        <span class="bg-delete-danger"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="table-paginate">
            {{ $pics->links() }}
        </div>
    </div>
    @include('modal.pic')

    <script>
        function openModal(element) {
            const modalTarget = element.getAttribute('data-target')
            const modalId = element.getAttribute('data-id')
            document.getElementById(`${modalTarget}`).classList.add('show')
            if (modalTarget.includes('delete')) {
                document.getElementById('buttonDeletePic').setAttribute('action', '/pic/' + modalId)
            }
        }

        function closeModal(modalTarget) {
            document.getElementById(`${modalTarget}`).classList.remove('show')
        }
    </script>
@endsection
