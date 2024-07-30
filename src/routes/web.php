<?php

use Illuminate\Support\Facades\Route;
use Aptika\SsoGorontalo\Controllers\AuthController;

Route::middleware(['web'])->group(function () {
    // Your routes
    Route::get('login/sso-gorontalo', [AuthController::class, 'sso'])->name('aptika.sso.login');
    Route::get('callback', [AuthController::class, 'callback'])->name('aptika.sso.callback');
});
