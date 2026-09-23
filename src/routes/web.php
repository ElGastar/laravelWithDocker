<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new', [App\Http\Controllers\NewController::class, 'index']);
Route::get('/post/index', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create']);
Route::get('/post/update', [App\Http\Controllers\PostController::class, 'update']);
Route::get('/post/delete', [App\Http\Controllers\PostController::class, 'destroy']);

Route::get('/greeting/{name}', function ($name) {
    return App\Facades\GreetingFacade::sayHello($name);
});

Route::get('/price/{amount}', function ($amount) {
    return App\Facades\PriceFormatterFacade::formatPrice($amount);
});
Route::get('/check-adult', function () {
    return "добро пожаловать если вам есть 18 лет";
})->middleware('age');
