<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashController;

Route::get('/', [FlashController::class, 'index']);

Route::get('/success', [FlashController::class, 'success']);
Route::get('/error', [FlashController::class, 'error']);
Route::get('/warning', [FlashController::class, 'warning']);
Route::get('/info', [FlashController::class, 'info']);
