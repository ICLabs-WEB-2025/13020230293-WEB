@extends('layouts.admin')

@section('title', 'Manajemen Komentar')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Komentar Siswa</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
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
                                <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
