<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashController;

Route::get('/', [FlashController::class, 'index']);

Route::get('/success', [FlashController::class, 'success']);
Route::get('/error', [FlashController::class, 'error']);
Route::get('/warning', [FlashController::class, 'warning']);
Route::get('/info', [FlashController::class, 'info']);

Route::get('/delete/{id}', [FlashController::class, 'destroy']);
Route::get('/trash', [FlashController::class, 'trash']);
Route::get('/restore/{id}', [FlashController::class, 'restore']);
Route::get('/force-delete/{id}', [FlashController::class, 'forceDelete']);

Route::post('/flash/bulk-delete', [FlashController::class, 'bulkDelete'])->name('flash.bulkDelete');
Route::post('/bulk-restore', [FlashController::class, 'bulkRestore']);
Route::post('/bulk-force-delete', [FlashController::class, 'bulkForceDelete']);