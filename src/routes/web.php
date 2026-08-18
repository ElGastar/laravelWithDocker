<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new', [App\Http\Controllers\NewController::class, 'index']);
