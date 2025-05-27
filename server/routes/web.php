<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify', [App\Http\Controllers\DescopeController::class, 'verify']);

Route::get('/create', [App\Http\Controllers\DescopeController::class, 'create']);

Route::get('/delete', [App\Http\Controllers\DescopeController::class, 'delete']);
