<?php

use App\Http\Controllers\SantiChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SantiChatController::class, 'index'])->name('landing');
Route::get('/locations', [SantiChatController::class, 'locations'])->name('locations.index');
Route::get('/santi/{location:slug}', [SantiChatController::class, 'show'])->name('santi.show');

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');

Route::post('/chat', [SantiChatController::class, 'chat'])
    ->middleware('throttle:25,1')
    ->name('santi.chat');
