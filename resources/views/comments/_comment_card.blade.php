{{-- File: resources/views/comments/_comment_card.blade.php --}}
<div class="comment-card" data-id="{{ $comment->id }}">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="user-avatar">
                <div class="ms-3">
                    <h5 class="card-title mb-1">{{ $comment->nama }}</h5>
                    <p class="text-muted mb-0">{{ $comment->email }}</p>
                    <small class="text-muted">Kelas: {{ $comment->kelas }}</small>
                    <br>
                    <small class="text-muted">Dikirim: {{ $comment->created_at->format('d M Y, H:i') }}</small>
                </div>
            </div>
            <div class="action-buttons">
                {{-- Tombol Edit & Delete bisa dipertimbangkan untuk halaman ini --}}
                {{-- Jika ingin ada, pastikan modalnya juga tersedia atau di-include --}}
                {{-- Untuk saat ini, kita fokus pada tampilan daftar saja --}}
            </div>
        </div>
        <div class="card-text mt-3">{{ $comment->komentar }}</div>
    </div>
</div>
