@extends('layouts.app')

@section('title', 'Form Responden')

@section('content')
    <div class="container-fluid">
        <!-- Header dengan Toggle Sidebar -->
        <div class="header-container d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <button id="sidebarToggle" class="hamburger-btn me-3">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <h1 class="suara-siswa-title">SUARA SISWA</h1>
            </div>
        </div>
        <hr class="border-dark mb-4">

        <!-- Baris  tombol Add & Search -->
<div class="row action-row align-items-center mb-4">
    <div class="col-lg-4 col-md-5 col-sm-12 mb-3 mb-md-0">
        <button type="button" class="btn add-button d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#commentModal">
            <i class="fas fa-plus me-2"></i> Add New Comment
        </button>
    </div>
    <div class="col-lg-5 col-md-7 col-sm-12 ms-auto">
        <div class="search-container">
            <input type="text" class="form-control search-input" id="searchInput" placeholder="Search...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
</div>

        <div class="comments-container">
            @foreach($comments as $comment)
                <div class="comment-card" data-id="{{ $comment->id }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="user-avatar">
                                <div class="ms-3">
                                    <h5 class="card-title mb-1">{{ $comment->nama }}</h5>
                                    <p class="text-muted mb-0">{{ $comment->email }}</p>
                                    <small class="text-muted">Kelas: {{ $comment->kelas }}</small>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $comment->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-text mt-3">{{ $comment->komentar }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        @include('partials.modals')
    </div>
@endsection
