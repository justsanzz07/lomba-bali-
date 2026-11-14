<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CulturalRule;
use App\Models\Location;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Show the main admin dashboard overview.
     */
    public function index(): View
    {
        $totalLocations = Location::count();
        $activeLocations = Location::where('is_active', true)->count();
        $totalRules = CulturalRule::count();
        $verifiedRules = CulturalRule::where('is_verified', true)->count();
        $totalSettings = SiteSetting::count();
        $totalUsers = User::count();

        $recentLocations = Location::withCount('culturalRules')
            ->latest('updated_at')
            ->take(5)
            ->get();

        $recentRules = CulturalRule::with('location')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLocations',
            'activeLocations',
            'totalRules',
            'verifiedRules',
            'totalSettings',
            'totalUsers',
            'recentLocations',
            'recentRules'
        ));
    }
}
