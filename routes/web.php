<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MemorialPageController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\QrCodeController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('logout', function (Logout $logout) {
    $logout();

    return redirect('/');
})->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('memorial-pages/create', [MemorialPageController::class, 'create'])->name('memorial-pages.create');
    Route::post('memorial-pages', [MemorialPageController::class, 'store'])->name('memorial-pages.store');
    Route::get('memorial-pages/{memorialPage}', [MemorialPageController::class, 'show'])->name('memorial-pages.show');

    Route::post('memorial-pages/{memorialPage}/memories', [MemoryController::class, 'store'])->name('memorial-pages.memories.store');
    Route::get('memorial-pages/{memorialPage}/memories/{memory}', [MemoryController::class, 'show'])->name('memorial-pages.memories.show')->scopeBindings();

    Route::post('memories/{memory}/comments', [CommentController::class, 'store'])->name('memories.comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('memorial-pages/{memorialPage}/photos', [PhotoController::class, 'store'])->name('memorial-pages.photos.store');
    Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    Route::get('memorial-pages/{memorialPage}/qr', [QrCodeController::class, 'show'])->name('memorial-pages.qr.show');
    Route::get('memorial-pages/{memorialPage}/qr.svg', [QrCodeController::class, 'svg'])->name('memorial-pages.qr.svg');
    Route::get('memorial-pages/{memorialPage}/qr.png', [QrCodeController::class, 'png'])->name('memorial-pages.qr.png');
});

require __DIR__.'/auth.php';
