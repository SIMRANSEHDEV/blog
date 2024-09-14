<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/index', [App\Http\Controllers\PageController::class, 'index'])->name('posts.welcome');
Route::get('/create', [App\Http\Controllers\PageController::class, 'create'])->name('posts.create');
Route::post('/posts', [App\Http\Controllers\PageController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [App\Http\Controllers\PageController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [App\Http\Controllers\PageController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [App\Http\Controllers\PageController::class, 'destroy'])->name('posts.destroy');