<?php

use Illuminate\Support\Facades\Route;
use VAptika\SsoGorontalo\Controllers\AuthController;

Route::get('login/sso', [AuthController::class, 'sso'])->name('login.sso');
Route::get('callback', [AuthController::class, 'callback'])->name('callback.sso');
