<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller{

   public function index(){
        $comments = Comment::latest()->get();
        return view('comments.index', compact('comments'));
    }

    public function store(Request $request){
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


    public function edit($id){
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }


    public function update(Request $request, $id){
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

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')
            ->with('success', 'Komentar berhasil dihapus!');
    }

    public function listAll(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest');
        $commentsQuery = Comment::query();

        if ($sortOrder === 'oldest') {
            $commentsQuery->orderBy('created_at', 'asc');
        } else {
            $commentsQuery->orderBy('created_at', 'desc');
        }

        $comments = $commentsQuery->get();

        return view('comments.list', compact('comments', 'sortOrder'));
    }
}
