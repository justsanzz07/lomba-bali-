<?php

use App\Http\Controllers\Admin\AdminCulturalRuleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Auth\LoginController;
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

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Admin Panel Routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Destinations (Locations) Management
    Route::post('/locations/{location}/toggle', [AdminLocationController::class, 'toggle'])->name('locations.toggle');
    Route::resource('locations', AdminLocationController::class);

    // Cultural Rules Management
    Route::post('/cultural-rules/{culturalRule}/toggle-verify', [AdminCulturalRuleController::class, 'toggleVerify'])->name('cultural-rules.toggle-verify');
    Route::resource('cultural-rules', AdminCulturalRuleController::class);

    // Front-Page (Landing Page) Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
