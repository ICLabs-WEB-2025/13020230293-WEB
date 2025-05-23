@extends('layouts.app') {{-- Sesuaikan jika layout utama Anda berbeda --}}

@section('title', 'Daftar Semua Komentar')

@section('content')
<div class="container-fluid">
    <div class="header-container d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="hamburger-btn me-3">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <h1 class="suara-siswa-title">DAFTAR SEMUA KOMENTAR</h1> {{-- Judul bisa disesuaikan --}}
        </div>
    </div>
    <hr class="border-dark mb-4">

    <div class="row mb-4">
        <div class="col-md-6 col-lg-4"> {{-- Anda bisa sesuaikan lebar kolom --}}
            <form action="{{ route('comments.listAll') }}" method="GET" id="filterSortForm">
                <div class="input-group">
                    <label class="input-group-text" for="sort">Urutkan Berdasarkan:</label>
                    <select class="form-select" name="sort" id="sort" onchange="document.getElementById('filterSortForm').submit();">
                        <option value="latest" @if(isset($sortOrder) && $sortOrder == 'latest') selected @endif>Komentar Terbaru</option>
                        <option value="oldest" @if(isset($sortOrder) && $sortOrder == 'oldest') selected @endif>Komentar Terlama</option>
                    </select>
                </div>
            </form>
        </div>
        {{-- Anda bisa menambahkan filter lain di sini, misalnya search box --}}
    </div>

    <div class="comments-container">
        @forelse($comments as $comment)
            @include('comments._comment_card', ['comment' => $comment]) {{-- Menggunakan partial card --}}
        @empty
            <div class="alert alert-info text-center" role="alert">
                Belum ada komentar yang dapat ditampilkan.
            </div>
        @endforelse
    </div>

    {{-- Jika Anda menggunakan paginasi di controller, tampilkan linknya di sini --}}
    {{-- <div class="mt-4 d-flex justify-content-center">
        {{ $comments->appends(request()->query())->links() }}
    </div> --}}
</div>
@endsection
