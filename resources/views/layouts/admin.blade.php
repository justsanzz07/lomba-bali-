<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel — SANTI AI Cultural Guardian')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Immediate Initialization -->
    <script>
        (function() {
            const stored = localStorage.getItem('santi_theme');
            if (stored === 'dark' || (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#F8F6EF] dark:bg-[#0B1E17] text-[#202A25] dark:text-[#F8F6EF] antialiased flex transition-colors duration-200">

    <!-- Sidebar Desktop -->
    <aside class="hidden lg:flex lg:flex-col w-64 bg-[#0C241B] text-white border-r border-white/10 shrink-0 select-none">
        <!-- Brand -->
        <div class="h-20 flex items-center px-6 border-b border-white/10 space-x-3">
            <div class="w-9 h-9 rounded-full bg-[#21845B] border border-white/20 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                <svg class="w-4.5 h-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                    <circle cx="12" cy="12" r="2.5"/>
                </svg>
            </div>
            <div>
                <span class="font-extrabold text-base tracking-tight text-white block leading-tight">SANTI ADMIN</span>
                <span class="text-[9px] uppercase tracking-widest text-[#A7D9B8] font-semibold">Cultural Guardian</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1.5 text-xs font-semibold">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#21845B] text-white font-bold shadow-xs' : 'text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard Ringkasan</span>
            </a>

            <a href="{{ route('admin.locations.index') }}"
               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.locations.*') ? 'bg-[#21845B] text-white font-bold shadow-xs' : 'text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Destinasi & Kawasan</span>
            </a>

            <a href="{{ route('admin.cultural-rules.index') }}"
               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.cultural-rules.*') ? 'bg-[#21845B] text-white font-bold shadow-xs' : 'text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Aturan & Etika Adat</span>
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#21845B] text-white font-bold shadow-xs' : 'text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Halaman Depan</span>
            </a>

            <div class="pt-4 pb-2">
                <span class="px-3.5 text-[10px] uppercase tracking-wider text-[#A7D9B8]/60 font-bold block">Tautan Cepat</span>
            </div>

            <a href="{{ route('landing') }}" target="_blank"
               class="flex items-center justify-between px-3.5 py-2 rounded-xl text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white transition-colors">
                <span class="flex items-center space-x-2.5">
                    <svg class="w-4 h-4 shrink-0 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Buka Web Publik</span>
                </span>
                <span class="text-[10px] text-[#A7D9B8]">↗</span>
            </a>

            <a href="{{ route('santi.index') }}" target="_blank"
               class="flex items-center justify-between px-3.5 py-2 rounded-xl text-[#F8F6EF]/75 hover:bg-white/10 hover:text-white transition-colors">
                <span class="flex items-center space-x-2.5">
                    <svg class="w-4 h-4 shrink-0 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Uji Coba AI Santi</span>
                </span>
                <span class="text-[10px] text-[#A7D9B8]">↗</span>
            </a>
        </nav>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-white/10 bg-black/20">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-full bg-[#21845B] text-white flex items-center justify-center font-bold text-xs shrink-0">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <span class="text-xs font-bold text-white block truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="text-[10px] text-[#A7D9B8] block truncate">{{ auth()->user()->email ?? '' }}</span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Keluar dari Panel" class="p-1.5 rounded-lg text-red-300 hover:bg-red-950/50 hover:text-red-200 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-20 bg-white dark:bg-[#132B22] border-b border-[#174D3B]/10 dark:border-white/10 px-4 sm:px-6 flex items-center justify-between shrink-0 transition-colors">
            <div class="flex items-center space-x-3">
                <!-- Mobile Drawer Toggle -->
                <button type="button" id="admin-mobile-btn" class="lg:hidden p-2 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] cursor-pointer" aria-label="Toggle Navigation">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h2 class="text-base sm:text-lg font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight truncate">
                    @yield('header_title', 'Admin Dashboard')
                </h2>
            </div>

            <!-- Right Controls: Theme Toggle & User Info -->
            <div class="flex items-center space-x-3">
                <button type="button" id="admin-theme-btn" class="p-2 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-[#DDF2DF] text-[#174D3B] dark:text-[#DDF2DF] transition-colors cursor-pointer" title="Ganti Tema">
                    <svg id="admin-theme-sun" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg id="admin-theme-moon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>

                <div class="hidden sm:flex items-center space-x-2 text-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[#5A6961] dark:text-[#A7B9AF]">Sistem Online</span>
                </div>
            </div>
        </header>

        <!-- Mobile Drawer Overlay -->
        <div id="admin-mobile-drawer" class="lg:hidden fixed inset-0 z-50 bg-black/60 hidden">
            <div class="w-64 h-full bg-[#0C241B] text-white flex flex-col justify-between p-5 space-y-4">
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-white/10">
                        <span class="font-extrabold text-white text-base">Menu Admin</span>
                        <button type="button" id="admin-mobile-close" class="text-white/70 hover:text-white p-1 text-lg">&times;</button>
                    </div>
                    <nav class="space-y-1.5 text-xs font-semibold">
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-[#21845B] text-white' : 'text-white/80 hover:bg-white/10' }}">Dashboard</a>
                        <a href="{{ route('admin.locations.index') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('admin.locations.*') ? 'bg-[#21845B] text-white' : 'text-white/80 hover:bg-white/10' }}">Destinasi Budaya</a>
                        <a href="{{ route('admin.cultural-rules.index') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('admin.cultural-rules.*') ? 'bg-[#21845B] text-white' : 'text-white/80 hover:bg-white/10' }}">Aturan & Etika Adat</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('admin.settings.*') ? 'bg-[#21845B] text-white' : 'text-white/80 hover:bg-white/10' }}">Edit Halaman Depan</a>
                        <div class="pt-3 border-t border-white/10">
                            <a href="{{ route('landing') }}" target="_blank" class="block px-3 py-2 rounded-xl text-[#C6A15B] hover:bg-white/10">Buka Web Publik ↗</a>
                        </div>
                    </nav>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs">Keluar</button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-6">
            <!-- Flash Notification -->
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs sm:text-sm text-emerald-800 dark:text-emerald-300 flex items-center justify-between shadow-xs">
                    <div class="flex items-center space-x-2.5">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs sm:text-sm text-red-800 dark:text-red-300 flex items-center justify-between shadow-xs">
                    <div class="flex items-center space-x-2.5">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Theme Controller Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeBtn = document.getElementById('admin-theme-btn');
            const sunIcon = document.getElementById('admin-theme-sun');
            const moonIcon = document.getElementById('admin-theme-moon');

            function updateUI() {
                const isDark = document.documentElement.classList.contains('dark');
                if (sunIcon) isDark ? sunIcon.classList.remove('hidden') : sunIcon.classList.add('hidden');
                if (moonIcon) isDark ? moonIcon.classList.add('hidden') : moonIcon.classList.remove('hidden');
            }

            if (themeBtn) {
                themeBtn.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.toggle('dark');
                    localStorage.setItem('santi_theme', isDark ? 'dark' : 'light');
                    updateUI();
                });
            }

            updateUI();

            // Mobile Drawer
            const mobileBtn = document.getElementById('admin-mobile-btn');
            const mobileDrawer = document.getElementById('admin-mobile-drawer');
            const mobileClose = document.getElementById('admin-mobile-close');

            if (mobileBtn && mobileDrawer) {
                mobileBtn.addEventListener('click', () => mobileDrawer.classList.remove('hidden'));
            }
            if (mobileClose && mobileDrawer) {
                mobileClose.addEventListener('click', () => mobileDrawer.classList.add('hidden'));
            }
        });
    </script>
</body>
</html>
