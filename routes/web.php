<?php

use App\Http\Controllers\MemorialPageController;
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
});

require __DIR__.'/auth.php';
