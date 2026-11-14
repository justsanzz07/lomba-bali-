<?php

use App\Models\User;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            User::updateOrCreate(
                ['email' => 'admin@santi.bali'],
                [
                    'name' => 'Administrator Santi',
                    'password' => Hash::make('SantiBali2026!'),
                    'email_verified_at' => now(),
                ]
            );
        }

        if (Schema::hasTable('site_settings')) {
            (new SiteSettingSeeder())->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data kept intact
    }
};
