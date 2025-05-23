<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Form Pengisian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Class</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Enter Class" required>
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Comment</label>
                        <textarea class="form-control" id="komentar" name="komentar" rows="3" placeholder="Write your comment here..." required></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit  -->
@foreach($comments as $comment)
<div class="modal fade" id="editModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $comment->id }}">Edit Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama{{ $comment->id }}" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="nama{{ $comment->id }}" name="nama" value="{{ $comment->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email{{ $comment->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email{{ $comment->id }}" name="email" value="{{ $comment->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas{{ $comment->id }}" class="form-label">Class</label>
                        <input type="text" class="form-control" id="kelas{{ $comment->id }}" name="kelas" value="{{ $comment->kelas }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="komentar{{ $comment->id }}" class="form-label">Comment</label>
                        <textarea class="form-control" id="komentar{{ $comment->id }}" name="komentar" rows="3" required>{{ $comment->komentar }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
