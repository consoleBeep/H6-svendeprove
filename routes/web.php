<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MemorialPageController;
use App\Http\Controllers\MemoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('memorial-pages/create', [MemorialPageController::class, 'create'])->name('memorial-pages.create');
    Route::post('memorial-pages', [MemorialPageController::class, 'store'])->name('memorial-pages.store');
    Route::get('memorial-pages/{memorialPage}', [MemorialPageController::class, 'show'])->name('memorial-pages.show');

    Route::post('memorial-pages/{memorialPage}/memories', [MemoryController::class, 'store'])->name('memorial-pages.memories.store');
    Route::get('memorial-pages/{memorialPage}/memories/{memory}', [MemoryController::class, 'show'])->name('memorial-pages.memories.show')->scopeBindings();

    Route::post('memories/{memory}/comments', [CommentController::class, 'store'])->name('memories.comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
