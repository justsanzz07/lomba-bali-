<?php

use App\Http\Controllers\SantiChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SantiChatController::class, 'index'])->name('landing');
Route::get('/locations', [SantiChatController::class, 'locations'])->name('locations.index');
Route::get('/santi/{location:slug}', [SantiChatController::class, 'show'])->name('santi.show');

Route::post('/chat', [SantiChatController::class, 'chat'])
    ->middleware('throttle:25,1')
    ->name('santi.chat');
