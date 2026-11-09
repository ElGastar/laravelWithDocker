<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-admin', function () {
    return 'Welcome, Admin!';
})->middleware('role');

Route::get('/new', [App\Http\Controllers\NewController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','role'])
->prefix('admin')
->name('admin.')
->group(function(){
    Route::resource('categories', CategoryController::class);
});
Route::middleware(['auth','role'])
->prefix('admin')
->name('admin.')
->group(function(){
    Route::resource('products', ProductController::class);
});
require __DIR__.'/auth.php';
