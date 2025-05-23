{{-- File: resources/views/admin/comments/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Komentar')

@section('content')
<div class="container-fluid pt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Komentar Siswa</h1>
        <div>
            <a href="{{ route('admin.comments.export.pdf') }}" class="btn btn-danger btn-sm me-1" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Ekspor ke PDF
            </a>
            <a href="{{ route('admin.comments.export.spreadsheet') }}" class="btn btn-success btn-sm" target="_blank">
                <i class="fas fa-file-excel me-1"></i> Ekspor ke Excel
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- !!! FORM FILTER BARU !!! --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('admin.comments.index') }}" method="GET" id="filterSortFormAdminComments">
                <div class="input-group input-group-sm"> {{-- Ukuran form group dikecilkan --}}
                    <label class="input-group-text" for="sortAdminComments">Urutkan:</label>
                    <select class="form-select form-select-sm" name="sort" id="sortAdminComments" onchange="document.getElementById('filterSortFormAdminComments').submit();">
                        {{-- Pastikan $sortOrder terdefinisi, jika tidak beri nilai default --}}
                        <option value="latest" @if(isset($sortOrder) && $sortOrder == 'latest') selected @endif>Komentar Terbaru</option>
                        <option value="oldest" @if(isset($sortOrder) && $sortOrder == 'oldest') selected @endif>Komentar Terlama</option>
                    </select>
                </div>
            </form>
        </div>
        {{-- Anda bisa menambahkan filter lain di sini jika perlu, misal search box --}}
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Komentar</th>
                            <th>Dikirim Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->nama }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->kelas }}</td>
                            <td>{{ Str::limit($comment->komentar, 50) }}</td>
                            <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada komentar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
