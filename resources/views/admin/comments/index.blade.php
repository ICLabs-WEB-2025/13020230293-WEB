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
            {{-- !!! TOMBOL EKSPOR SPREADSHEET (EXCEL) BARU !!! --}}
            <a href="{{ route('admin.comments.export.spreadsheet') }}" class="btn btn-success btn-sm" target="_blank">
                <i class="fas fa-file-excel me-1"></i> Ekspor ke Excel
            </a>
        </div>
    </div>

    {{-- ... (sisa kode view: @if(session('success')), card, table, dll.) ... --}}
    {{-- Tabel komentar Anda yang sudah ada --}}
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
                                <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
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
