<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProviderController;
use App\Livewire\Admin\ManageCategories;
use App\Livewire\Admin\ManageLessons;
use App\Livewire\Admin\ManagePlaylists;
use App\Livewire\Admin\ManageTags;
use App\Livewire\Admin\ManageUsers;
use Illuminate\Support\Facades\Route;

// ── Language switching ────────────────────────────────────────────────────────
Route::get('set-locale/{locale}', LanguageController::class)->name('set.locale');

Route::get('/', function () {
    return redirect()->to(app()->getLocale());
});

// ── Social Auth ───────────────────────────────────────────────────────────────
Route::get('auth/{provider}/redirect', [ProviderController::class, 'providerRedirect'])
    ->name('provider.redirect');
Route::get('auth/{provider}/callback', [ProviderController::class, 'providerCallback']);

// ── Admin Panel ───────────────────────────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['web'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.lessons');
        })->name('index');

        Route::get('/lessons', ManageLessons::class)->name('lessons');
        Route::get('/categories', ManageCategories::class)->name('categories');
        Route::get('/playlists', ManagePlaylists::class)->name('playlists');
        Route::get('/tags', ManageTags::class)->name('tags');
        Route::get('/users', ManageUsers::class)->name('users');
    });

// ── App Frontend Routes ───────────────────────────────────────────────────────
Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', HomeController::class)->name('home');

    // Lessons
    Route::get('lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('lesson/{slug}', [LessonController::class, 'show'])->name('lessons.show');
    Route::get('lesson-alias/{slug}', [LessonController::class, 'show'])->name('lesson.show');

    // Playlists
    Route::get('playlists', [PlaylistController::class, 'index'])->name('playlists.index');
    Route::get('playlist/{slug}', [PlaylistController::class, 'show'])->name('playlists.show');
    Route::get('playlist-alias/{slug}', [PlaylistController::class, 'show'])->name('playlist.show');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('category/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('category-alias/{slug}', [CategoryController::class, 'show'])->name('category.show');
});
