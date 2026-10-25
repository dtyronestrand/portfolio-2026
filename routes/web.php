<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/work', [ProjectController::class, 'index'])->name('work');
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
Route::get('/skills', [SkillController::class, 'index'])->name('skills');
Route::get('/contact', function () {
    return inertia('Contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/work/{project}', [ProjectController::class, 'show'])->name('work.show');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::redirect('/', '/admin/dashboard', 301);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/work', [ProjectController::class, 'admin'])->name('admin.work');
    Route::get('/skills', [SkillController::class, 'admin'])->name('admin.skills');
    Route::post('/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/resume', [ResumeController::class, 'admin'])->name('admin.resume');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('admin.experiences.store');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('admin.experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experiences.destroy');
    Route::post('/education', [EducationController::class, 'store'])->name('admin.education.store');
    Route::put('/education/{education}', [EducationController::class, 'update'])->name('admin.education.update');
    Route::delete('/education/{education}', [EducationController::class, 'destroy'])->name('admin.education.destroy');
    Route::post('/publications', [PublicationController::class, 'store'])->name('admin.publications.store');
    Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('admin.publications.update');
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('admin.publications.destroy');
    Route::post('/resume', [ResumeController::class, 'update'])->name('admin.resume.update');
});

require __DIR__.'/settings.php';
