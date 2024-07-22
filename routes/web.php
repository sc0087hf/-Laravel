<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::resource('post', PostController::class);

Route::prefix('post')
    ->controller(PostController::class)
    ->group(function() {
        Route::get('/', 'index');
        Route::get('{post}', 'show')->whereNumber('post');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/{post}/edit', 'edit');
        Route::put('/{book}', 'update')->whereNumber('post');
        Route::delete('{post}', 'destroy')->whereNumber('post');
    });

Route::get('/', function() {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
