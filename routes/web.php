<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get(
    '/',
    [UserController::class, 'index']
)->name('home');

Route::get(
    'new_user',
    [UserController::class, 'create_new_user']
)->name('new_user');

Route::post(
    'add_new_user',
    [UserController::class, 'new_user']
)->name('add_new_user');

Route::get(
    'edit_user/{id}',
    [UserController::class, 'edit_user']
)->name('edit_user');

Route::post(
    'update_user/{id}',
    [UserController::class, 'update_user']
)->name('update_user');

Route::get(
    'delete_user/{id}',
    [UserController::class, 'delete_user']
)->name('delete_user');
