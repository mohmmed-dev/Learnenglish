<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;

Route::get('/', function () {
    return view('home');
});

// ── Social Auth ───────────────────────────────────────────────────────────────
Route::get('auth/{provider}/redirect', [ProviderController::class, 'providerRedirect'])
    ->name('provider.redirect');
Route::get('auth/{provider}/callback', [ProviderController::class, 'providerCallback']);
