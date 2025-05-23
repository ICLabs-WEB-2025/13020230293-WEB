@extends('layouts.app')

@section('title', 'Daftar Semua Komentar')

@section('content')
<div class="container-fluid">
    <div class="header-container d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="hamburger-btn me-3">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <h1 class="suara-siswa-title">DAFTAR KOMENTAR SISWA</h1>
        </div>
    </div>
    <hr class="border-dark mb-4">

    <div class="row mb-4">
        <div class="col-md-6 col-lg-4">
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
</div>
@endsection
