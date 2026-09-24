<?php

use App\Http\Controllers\Api\MemorialPageController;
use Illuminate\Support\Facades\Route;

Route::get('memorial-pages', [MemorialPageController::class, 'index'])->name('api.memorial-pages.index');
Route::get('memorial-pages/{memorialPage}', [MemorialPageController::class, 'show'])->name('api.memorial-pages.show');
Route::get('memorial-pages/{memorialPage}/memories', [MemorialPageController::class, 'memories'])->name('api.memorial-pages.memories');
