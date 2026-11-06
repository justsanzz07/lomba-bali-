<?php

use App\Http\Controllers\SantiChatController;
use App\Http\Middleware\SetLocale;
use App\Models\Location;
use Illuminate\Support\Facades\Route;

Route::get('/', [SantiChatController::class, 'index'])->name('landing');
Route::get('/locations', [SantiChatController::class, 'locations'])->name('locations.index');
Route::get('/panduan/{location:slug}', [SantiChatController::class, 'guidelines'])->name('guidelines.show');
Route::get('/locations/{location:slug}', fn (Location $location) => redirect()->route('guidelines.show', $location->slug));
Route::get('/santi', [SantiChatController::class, 'general'])->name('santi.index');
Route::get('/santi/{location:slug}', [SantiChatController::class, 'show'])->name('santi.show');

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, SetLocale::SUPPORTED_LOCALES, true)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');

Route::post('/chat', [SantiChatController::class, 'chat'])
    ->middleware('throttle:25,1')
    ->name('santi.chat');

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'application' => 'Santi AI',
    ], 200);
})->name('health');
