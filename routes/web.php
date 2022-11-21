<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get(
    '/',
    [UserController::class, 'index']
)->name('home');

Route::get(
    'new_user',
    [UserController::class, 'new_user']
)->name('new_user');
