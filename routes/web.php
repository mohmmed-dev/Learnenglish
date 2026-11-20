<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;


// ── Language switching ────────────────────────────────────────────────────────
Route::get('set-locale/{locale}', LanguageController::class)->name('set.locale');

Route::get('/', function () {
    return redirect()->to(app()->getLocale());
});


// ── Social Auth ───────────────────────────────────────────────────────────────
Route::get('auth/{provider}/redirect', [ProviderController::class, 'providerRedirect'])
    ->name('provider.redirect');
Route::get('auth/{provider}/callback', [ProviderController::class, 'providerCallback']);


Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', HomeController::class)->name('home');
});
