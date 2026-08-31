<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::inertia('/', 'Welcome')->name('home');
Route::get('/work', [ProjectController::class, 'index'])->name('work');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
