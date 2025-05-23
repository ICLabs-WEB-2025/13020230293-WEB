<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


// Landing Page Route
Route::get('/', function () {
    return view('landingpage');
})->name('landing'); //

// Comments Routes (Publik)
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); 
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/comments-list', [CommentController::class, 'listAll'])->name('comments.listAll');

// Auth Routes
Route::post('/login', [AuthController::class, 'login'])->name('login'); //
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); //

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin - Comments Management
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
    Route::get('/comments/{comment}', [AdminController::class, 'showComment'])->name('comments.show');
    Route::put('/comments/{comment}', [AdminController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{comment}', [AdminController::class, 'destroyComment'])->name('comments.destroy');
    Route::get('/comments/export/pdf', [AdminController::class, 'exportCommentsPdf'])->name('comments.export.pdf');
    Route::get('/comments/export/spreadsheet', [AdminController::class, 'exportCommentsSpreadsheet'])->name('comments.export.spreadsheet');

    // Admin - Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');


});

