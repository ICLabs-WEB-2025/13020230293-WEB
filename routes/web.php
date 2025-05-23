<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController; // Tambahkan jika Anda menggunakan UserController


// Landing Page Route
Route::get('/', function () {
    return view('landingpage');
})->name('landing'); //

// Comments Routes (Publik)
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index'); //
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); //
// Jika user biasa bisa mengedit/menghapus komentar mereka sendiri (membutuhkan logika otorisasi tambahan di controller)
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit'); // (menggunakan {comment} untuk route model binding)
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update'); // (menggunakan {comment} untuk route model binding)
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // (menggunakan {comment} untuk route model binding)
Route::get('/comments-list', [CommentController::class, 'listAll'])->name('comments.listAll');
// Auth Routes (untuk Admin dan mungkin User)
Route::post('/login', [AuthController::class, 'login'])->name('login'); //
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); //

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () { //
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); //

    // Admin - Comments Management
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index'); //
    Route::get('/comments/{comment}', [AdminController::class, 'showComment'])->name('comments.show'); // (menggunakan {comment})
    // Jika admin bisa update comment dari panel admin, tambahkan route untuk edit & update
    // Route::get('/comments/{comment}/edit', [AdminController::class, 'editComment'])->name('comments.edit'); // Anda perlu method editComment di AdminController
    Route::put('/comments/{comment}', [AdminController::class, 'updateComment'])->name('comments.update'); // Anda sudah punya updateComment di AdminController
    Route::delete('/comments/{comment}', [AdminController::class, 'destroyComment'])->name('comments.destroy'); // (menggunakan {comment})
    Route::get('/comments/export/pdf', [AdminController::class, 'exportCommentsPdf'])->name('comments.export.pdf');
    Route::get('/comments/export/spreadsheet', [AdminController::class, 'exportCommentsSpreadsheet'])->name('comments.export.spreadsheet');

    // Admin - Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index'); // Ini yang baru ditambahkan
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show'); // Menggunakan {user} untuk route model binding
    // Jika admin bisa edit user dari panel admin, tambahkan route untuk form edit
    // Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit'); // Anda perlu method editUser di AdminController
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update'); // Anda sudah punya updateUser di AdminController
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy'); // Anda sudah punya destroyUser di AdminController


});

