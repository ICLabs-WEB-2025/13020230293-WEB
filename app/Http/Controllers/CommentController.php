<?php
// File: app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of comments
     */
   public function index()
    {
        $comments = Comment::latest()->get();
        return view('comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'kelas' => 'required|string|max:50',
            'komentar' => 'required|string',
        ]);

        Comment::create($request->all());

        return redirect()->route('comments.index')
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the comment
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the comment
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'kelas' => 'required|string|max:50',
            'komentar' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return redirect()->route('comments.index')
            ->with('success', 'Komentar berhasil diperbarui!');
    }

    /**
     * Remove the comment
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')
            ->with('success', 'Komentar berhasil dihapus!');
    }

    public function listAll(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest'); // Default filter adalah 'latest'
        $commentsQuery = Comment::query();

        if ($sortOrder === 'oldest') {
            $commentsQuery->orderBy('created_at', 'asc'); // Urutkan dari yang terlama
        } else { // Default atau jika sort=latest
            $commentsQuery->orderBy('created_at', 'desc'); // Urutkan dari yang terbaru
        }

        $comments = $commentsQuery->get();
        // Jika Anda ingin menggunakan paginasi (halaman bernomor jika data banyak):
        // $comments = $commentsQuery->paginate(10); // Misalnya 10 komentar per halaman

        return view('comments.list', compact('comments', 'sortOrder'));
        // Kita akan membuat view 'comments.list.blade.php' pada langkah berikutnya
    }
}
