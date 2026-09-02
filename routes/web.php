<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;

Route::inertia('/', 'Welcome')->name('home');
Route::get('/work', [ProjectController::class, 'index'])->name('work');
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
Route::get('/skills', [SkillController::class, 'index'])->name('skills');
Route::get('/contact', function() {
    return inertia('Contact');
})->name('contact');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
