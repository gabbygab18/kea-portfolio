<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtworkController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\SeoProjectController;
use App\Http\Controllers\Admin\SeoToolController;
use App\Http\Controllers\Admin\SeoSkillController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/artworks', [PageController::class, 'artworks'])->name('artworks');
Route::get('/artworks/{slug}', [PageController::class, 'projectDetail'])->name('project.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/project/{slug}', [PageController::class, 'project'])->name('project.show');
Route::get('/seo', [PageController::class, 'seo'])->name('seo');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('artworks', ArtworkController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('skills', SkillController::class)->except(['show']);
        Route::resource('settings', SettingController::class)->only(['index', 'edit', 'update']);
        Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
        Route::resource('experiences', ExperienceController::class)->except(['show']);
        Route::resource('seo-projects', SeoProjectController::class)->except(['show']);
        Route::resource('seo-tools', SeoToolController::class)->except(['show', 'index']);
        Route::resource('seo-skills', SeoSkillController::class)->except(['show', 'index']);
        Route::post('/settings/bulk-update', [SettingController::class, 'bulkUpdate'])->name('settings.bulk-update');
    });
});
