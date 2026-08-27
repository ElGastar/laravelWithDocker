<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new', [App\Http\Controllers\NewController::class, 'index']);
Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create']);
Route::get('/post/update', [App\Http\Controllers\PostController::class, 'update']);