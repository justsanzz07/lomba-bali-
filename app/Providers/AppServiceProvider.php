<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Self-heal administrator if users table exists and admin account is missing
        try {
            if (Schema::hasTable('users') && !User::where('email', 'admin@santi.bali')->exists()) {
                User::create([
                    'name' => 'Administrator Santi',
                    'email' => 'admin@santi.bali',
                    'password' => Hash::make('SantiBali2026!'),
                    'email_verified_at' => now(),
                ]);
            }
        } catch (\Throwable $e) {
            // Silently pass during early setup or migrations
        }
    }
}
