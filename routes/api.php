<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/tes-api', function () {
    return response()->json(['status' => 'API nyala bos']);
});
Route::apiResource('comments', CommentController::class);
