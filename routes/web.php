<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/work', [ProjectController::class, 'index'])->name('work');
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
Route::get('/skills', [SkillController::class, 'index'])->name('skills');
Route::get('/contact', function () {
    return inertia('Contact');
})->name('contact');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::prefix('admin')->group(function() {
Route::redirect('/', '/dashboard', 301);
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/work', [ProjectController::class, 'admin'])->name('admin.work');
Route::get('/skills', [SkillController::class, 'admin'])->name('admin.skills');
Route::post('/skills', [SkillController::class, 'store'])->name('admin.skills.store');
Route::post('/work', [ProjectController::class, 'store'])->name('admin.projects.store');
});

Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
require __DIR__.'/settings.php';
    