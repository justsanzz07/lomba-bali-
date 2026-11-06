<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Santi — AI Cultural Guardian Bali')</title>
    <meta name="description" content="@yield('meta_description', 'Santi is an AI-powered cultural guardian helping domestic and international tourists understand Balinese traditions, sacred temple etiquette, and local customs.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Immediate Theme Initialization (Prevents FOUT on Page Load) -->
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .dark body {
            background-color: #0B1E17;
            color: #F8F6EF;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#21845B] selection:text-white bg-[#F8F6EF] dark:bg-[#0B1E17] text-[#202A25] dark:text-[#F8F6EF] transition-colors duration-200">
    <!-- Header / Navigation Bar (Transparent over Hero on Landing, Sticky Frosted Glass on Scroll) -->
    <header id="main-header"
            data-is-landing="{{ request()->routeIs('landing') ? '1' : '0' }}"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 text-white {{ request()->routeIs('landing') ? 'glass-header-transparent' : 'glass-header-scrolled' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Left: Brand Logo -->
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-[#21845B] border border-white/20 flex items-center justify-center text-white font-bold text-sm shadow-sm group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                            <circle cx="12" cy="12" r="2.5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-lg sm:text-xl tracking-tight text-white leading-none">
                            SANTI
                        </div>
                        <div class="text-[9px] uppercase tracking-widest text-[#DDF2DF] font-semibold mt-0.5">
                            {{ __('messages.brand_subtitle') }}
                        </div>
                    </div>
                </a>

                <!-- Center Navigation (Desktop: Clean, Non-Redundant, Purposeful) -->
                <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium text-white/90">
                    <a href="{{ route('landing') }}#hero" class="hover:text-white transition-colors">{{ __('messages.nav_home') }}</a>
                    <a href="{{ route('landing') }}#about" class="hover:text-white transition-colors">{{ __('messages.nav_about') }}</a>
                    <a href="{{ route('landing') }}#services" class="hover:text-white transition-colors">{{ __('messages.nav_guide') }}</a>
                    <a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition-colors">{{ __('messages.nav_how') }}</a>
                    <a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">{{ __('messages.nav_locations') }}</a>
                </nav>

                <!-- Right-side Action Buttons (Desktop) -->
                <div class="hidden lg:flex items-center space-x-4">
                    @php
                        $currentLocale = app()->getLocale();
                        $languages = [
                            'id' => ['flag' => '🇮🇩', 'code' => 'ID', 'name' => 'Bahasa Indonesia'],
                            'en' => ['flag' => '🇬🇧', 'code' => 'EN', 'name' => 'English'],
                            'zh' => ['flag' => '🇨🇳', 'code' => 'ZH', 'name' => '中文 (Mandarin)'],
                            'ja' => ['flag' => '🇯🇵', 'code' => 'JA', 'name' => '日本語 (Japanese)'],
                            'ru' => ['flag' => '🇷🇺', 'code' => 'RU', 'name' => 'Русский (Russian)'],
                            'fr' => ['flag' => '🇫🇷', 'code' => 'FR', 'name' => 'Français (French)'],
                            'de' => ['flag' => '🇩🇪', 'code' => 'DE', 'name' => 'Deutsch (German)'],
                        ];
                        $activeLang = $languages[$currentLocale] ?? $languages['id'];
                    @endphp

                    <!-- Language Switcher Dropdown (Multi-Language International Tourists Support) -->
                    <div class="relative group">
                        <button type="button" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-xs font-semibold text-white transition-all shadow-xs">
                            <span class="inline-flex items-center space-x-1">
                                <span>{{ $activeLang['flag'] }}</span>
                                <span>{{ $activeLang['code'] }}</span>
                            </span>
                            <svg class="w-3.5 h-3.5 text-white/80 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-[#16352A] shadow-2xl py-2 text-xs font-semibold text-[#202A25] dark:text-[#F8F6EF] hidden group-hover:block border border-gray-100 dark:border-white/10 z-50">
                            @foreach($languages as $code => $data)
                                <a href="{{ route('lang.switch', $code) }}" class="flex items-center justify-between px-3.5 py-2 hover:bg-[#DDF2DF]/40 dark:hover:bg-white/10 transition-colors {{ $currentLocale === $code ? 'text-[#174D3B] dark:text-[#DDF2DF] font-bold bg-[#DDF2DF]/30 dark:bg-white/10' : 'text-[#737B75] dark:text-[#A7B9AF]' }}">
                                    <span class="flex items-center space-x-2">
                                        <span>{{ $data['flag'] }}</span>
                                        <span>{{ $data['name'] }}</span>
                                    </span>
                                    @if($currentLocale === $code)
                                        <svg class="w-3.5 h-3.5 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Theme Toggle Button (Desktop: Light / Dark Mode) -->
                    <button type="button"
                            id="theme-toggle-btn"
                            aria-label="Ganti Tema (Dark / Light Mode)"
                            title="Ganti Tema (Dark / Light Mode)"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white transition-all shadow-xs cursor-pointer">
                        <svg id="theme-icon-sun" class="w-4 h-4 hidden text-[#F5E7A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="theme-icon-moon" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <a href="{{ route('santi.index') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-full bg-white hover:bg-[#DDF2DF] text-[#174D3B] text-xs font-bold shadow-md hover:shadow-lg transition-all duration-200">
                        <span>{{ __('messages.nav_ask_santi') }}</span>
                        <svg class="w-3.5 h-3.5 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Header Right (Theme + Lang switcher + Hamburger) -->
                <div class="flex items-center space-x-2 lg:hidden">
                    <button type="button" id="mobile-theme-btn" aria-label="Ganti Mode Gelap/Terang" title="Ganti Mode Gelap/Terang"
                            class="w-8 h-8 rounded-full bg-white/15 border border-white/25 text-white flex items-center justify-center cursor-pointer">
                        <svg id="mobile-theme-icon-sun" class="w-3.5 h-3.5 hidden text-[#F5E7A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="mobile-theme-icon-moon" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                    <button type="button" id="mobile-lang-btn"
                            class="px-2.5 py-1 rounded-full bg-white/15 border border-white/25 text-[11px] font-bold text-white flex items-center space-x-1">
                        <span>{{ $activeLang['flag'] }}</span>
                        <span>{{ $activeLang['code'] }}</span>
                    </button>
                    <button type="button" id="mobile-menu-btn" class="p-2 rounded-xl text-white hover:bg-white/10 focus:outline-none" aria-label="Toggle navigation menu">
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-[#0E2C21]/95 backdrop-blur-xl border-t border-white/10 px-4 pt-4 pb-6 space-y-3 shadow-2xl">
            <!-- Quick Dark Mode Toggle in Mobile Drawer -->
            <div class="p-3 bg-white/10 rounded-2xl flex items-center justify-between mb-2">
                <span class="text-xs text-white font-medium">Mode Tampilan / Theme:</span>
                <button type="button" id="drawer-theme-btn" class="px-3 py-1.5 rounded-lg bg-white/15 border border-white/20 text-xs font-bold text-white flex items-center space-x-1.5 cursor-pointer">
                    <span id="drawer-theme-text">Dark Mode 🌙</span>
                </button>
            </div>
            <!-- Language selector for mobile (7 languages) -->
            <div class="p-3 bg-white/10 rounded-2xl mb-3 space-y-2">
                <span class="text-xs text-[#DDF2DF] font-bold block uppercase tracking-wider">Pilih Bahasa / Language:</span>
                <div class="grid grid-cols-2 gap-1.5">
                    @foreach($languages as $code => $data)
                        <a href="{{ route('lang.switch', $code) }}" class="flex items-center space-x-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold transition-colors {{ $currentLocale === $code ? 'bg-white text-[#174D3B]' : 'text-white/80 hover:bg-white/10' }}">
                            <span>{{ $data['flag'] }}</span>
                            <span class="truncate">{{ $data['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('landing') }}#hero" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">{{ __('messages.nav_home') }}</a>
            <a href="{{ route('landing') }}#about" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">{{ __('messages.nav_about') }}</a>
            <a href="{{ route('landing') }}#services" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">{{ __('messages.nav_guide') }}</a>
            <a href="{{ route('landing') }}#how-it-works" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">{{ __('messages.nav_how') }}</a>
            <a href="{{ route('locations.index') }}" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">{{ __('messages.nav_locations') }}</a>
            <div class="pt-4 border-t border-white/10 flex flex-col space-y-2">
                <a href="{{ route('santi.index') }}" class="w-full text-center py-3 rounded-full bg-white text-[#174D3B] font-bold text-xs shadow-md">
                    {{ __('messages.nav_ask_santi') }}
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ==================== PREMIUM MODERN MINIMALIST FOOTER ==================== -->
    <footer id="footer" class="{{ request()->routeIs('santi.*') ? 'hidden md:block' : '' }} bg-[#0C241B] text-[#F8F6EF] border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-9">
            <!-- Main Content: Refined 3-Column Proportional Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-7 lg:gap-8 items-start">
                <!-- Col 1: Identity & Regulatory Grounding (Span 5) -->
                <div class="lg:col-span-5 space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-[#21845B] border border-white/20 flex items-center justify-center text-white font-bold text-xs shadow-xs shrink-0">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-extrabold text-lg tracking-tight text-white block leading-tight">SANTI</span>
                            <span class="text-[9px] uppercase tracking-widest text-[#DDF2DF] font-semibold">{{ __('messages.brand_subtitle') }}</span>
                        </div>
                    </div>

                    <p class="text-xs text-[#F8F6EF]/70 leading-relaxed max-w-sm line-clamp-3">
                        {{ __('messages.footer_desc') }}
                    </p>

                    <div class="space-y-1 pt-0.5 text-[11px] text-[#F8F6EF]/60">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5 text-[#C6A15B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ __('messages.footer_address') }}</span>
                        </div>
                        <a href="javascript:void(0)" onclick="document.getElementById('ethics-modal').classList.remove('hidden')" class="inline-flex items-center space-x-1.5 text-[#A7D9B8] hover:text-[#DDF2DF] transition-colors group">
                            <svg class="w-3.5 h-3.5 text-[#C6A15B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="group-hover:underline underline-offset-2">Rujukan Resmi: SE Gubernur Bali No. 4/2023</span>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Cagar Budaya & Destinasi Sakral (Span 4) -->
                <div class="lg:col-span-4">
                    <h3 class="text-[11px] uppercase tracking-wider font-bold text-[#DDF2DF] mb-2.5">{{ __('messages.footer_temple_links') }}</h3>
                    <ul class="space-y-1.5 text-xs">
                        <li>
                            <a href="{{ route('guidelines.show', 'pura-besakih') }}" class="group flex items-center justify-between text-[#F8F6EF]/75 hover:text-white transition-colors py-0.5">
                                <span class="group-hover:translate-x-1 transition-transform">Pura Agung Besakih</span>
                                <span class="text-[10px] text-[#A7D9B8]/70">Ibu Pura</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guidelines.show', 'pura-uluwatu') }}" class="group flex items-center justify-between text-[#F8F6EF]/75 hover:text-white transition-colors py-0.5">
                                <span class="group-hover:translate-x-1 transition-transform">Pura Luhur Uluwatu</span>
                                <span class="text-[10px] text-[#A7D9B8]/70">Sad Kahyangan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guidelines.show', 'desa-penglipuran') }}" class="group flex items-center justify-between text-[#F8F6EF]/75 hover:text-white transition-colors py-0.5">
                                <span class="group-hover:translate-x-1 transition-transform">Desa Adat Penglipuran</span>
                                <span class="text-[10px] text-[#A7D9B8]/70">Desa Tradisional</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guidelines.show', 'jatiluwih-rice-terraces') }}" class="group flex items-center justify-between text-[#F8F6EF]/75 hover:text-white transition-colors py-0.5">
                                <span class="group-hover:translate-x-1 transition-transform">Subak Jatiluwih</span>
                                <span class="text-[10px] text-[#A7D9B8]/70">UNESCO Subak</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guidelines.show', 'pura-ulun-danu-beratan') }}" class="group flex items-center justify-between text-[#F8F6EF]/75 hover:text-white transition-colors py-0.5">
                                <span class="group-hover:translate-x-1 transition-transform">Pura Ulun Danu Beratan</span>
                                <span class="text-[10px] text-[#A7D9B8]/70">Danau Bedugul</span>
                            </a>
                        </li>
                        <li class="pt-1">
                            <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-1 text-[11px] font-semibold text-[#A7D9B8] hover:text-white transition-colors group">
                                <span>Lihat Semua Destinasi & Panduan Adat</span>
                                <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Pusat Bantuan & Kontak Darurat (Span 3) -->
                <div class="lg:col-span-3 space-y-3">
                    <div>
                        <h3 class="text-[11px] uppercase tracking-wider font-bold text-[#DDF2DF] mb-1">{{ __('messages.footer_emergency_title') }}</h3>
                        <p class="text-[11px] text-[#F8F6EF]/65 leading-snug">
                            {{ __('messages.footer_emergency_desc') }}
                        </p>
                    </div>

                    <!-- Compact Emergency List -->
                    <div class="space-y-1.5 text-xs">
                        <a href="tel:112" class="flex items-center justify-between py-1 text-[#F8F6EF]/80 hover:text-white group transition-colors">
                            <div class="flex items-center space-x-2">
                                <svg class="w-3.5 h-3.5 text-[#C6A15B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-[11px]">{{ __('messages.footer_emergency_call_center') }}</span>
                            </div>
                            <span class="text-[11px] font-bold text-[#DDF2DF] group-hover:text-white">112</span>
                        </a>

                        <div class="flex items-center justify-between py-1 text-[#F8F6EF]/80">
                            <div class="flex items-center space-x-2">
                                <svg class="w-3.5 h-3.5 text-[#21845B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="text-[11px]">{{ __('messages.footer_emergency_police') }}</span>
                            </div>
                            <span class="text-[10px] text-[#A7D9B8]/70">24 Jam</span>
                        </div>
                    </div>

                    <!-- Compact Ask Santi Button -->
                    <div class="pt-0.5">
                        <a href="{{ route('santi.index') }}" class="inline-flex items-center justify-center space-x-2 px-3 py-1.5 rounded-lg bg-[#21845B] hover:bg-[#1E734F] text-white font-semibold text-xs shadow-xs transition-colors">
                            <span>{{ __('messages.footer_ask_santi_btn') }}</span>
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Horizontal Strip: Filosofi Tri Hita Karana & Regulasi Terverifikasi -->
            <div class="mt-7 pt-3.5 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 text-xs">
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] text-[#F8F6EF]/75">
                    <span class="font-bold text-white tracking-wide">Tri Hita Karana:</span>
                    <span class="text-[#C6A15B] font-medium">Parahyangan</span>
                    <span class="text-white/20">•</span>
                    <span class="text-[#C6A15B] font-medium">Pawongan</span>
                    <span class="text-white/20">•</span>
                    <span class="text-[#C6A15B] font-medium">Palemahan</span>
                    <span class="hidden md:inline text-[#F8F6EF]/50 ml-1">({{ __('messages.footer_tri_hita_karana') }})</span>
                </div>
                <div class="flex items-center shrink-0">
                    <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-white/5 border border-white/10 text-[10px] sm:text-[11px] text-[#A7D9B8] font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#21845B]"></span>
                        <span>{{ __('messages.footer_verified_badge') }}</span>
                    </span>
                </div>
            </div>

            <!-- Horizontal Row: Pilihan Bahasa (ID, EN, ZH, JA, RU, FR, DE) -->
            <div class="mt-3.5 pt-3 border-t border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="text-[10px] sm:text-[11px] text-[#DDF2DF]/70 font-medium shrink-0">
                    Bahasa Wisatawan:
                </div>
                <div class="flex items-center gap-1 overflow-x-auto max-w-full pb-1 sm:pb-0 scrollbar-none">
                    @foreach($languages as $code => $data)
                        <a href="{{ route('lang.switch', $code) }}" class="inline-flex items-center space-x-1 px-2 py-0.5 rounded text-[11px] font-semibold transition-all shrink-0 {{ $currentLocale === $code ? 'bg-[#21845B] text-white shadow-2xs' : 'bg-white/5 text-white/70 hover:bg-white/15 hover:text-white' }}" title="{{ $data['name'] }}">
                            <span>{{ $data['flag'] }}</span>
                            <span>{{ $data['code'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Bottom Row: Copyright & Legal Policy Modal Triggers -->
            <div class="mt-3.5 pt-3 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-[11px] text-[#F8F6EF]/55 gap-2.5">
                <p>&copy; {{ date('Y') }} SANTI — AI Cultural Guardian Bali. {{ __('messages.footer_rights') }}</p>
                <div class="flex items-center space-x-5 text-[11px]">
                    <button type="button" onclick="document.getElementById('ethics-modal').classList.remove('hidden')" class="hover:text-white transition-colors cursor-pointer">
                        {{ __('messages.footer_ethics_btn') }}
                    </button>
                    <span class="text-white/20">•</span>
                    <button type="button" onclick="document.getElementById('privacy-modal').classList.remove('hidden')" class="hover:text-white transition-colors cursor-pointer">
                        {{ __('messages.footer_privacy_btn') }}
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal: Pedoman Etika Wisatawan Bali (SE Gubernur Bali No. 4/2023) -->
    <div id="ethics-modal" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-xs flex items-center justify-center p-4 hidden" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-[#132B22] text-[#202A25] dark:text-[#F8F6EF] max-w-lg w-full rounded-3xl p-6 sm:p-8 shadow-2xl space-y-4 border border-gray-100 dark:border-white/10 transition-colors">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-white/10">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-[#DDF2DF] dark:bg-[#21845B]/30 flex items-center justify-center text-[#174D3B] dark:text-[#DDF2DF]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#174D3B] dark:text-[#DDF2DF]">Pedoman Etika Wisatawan Bali</h3>
                </div>
                <button type="button" onclick="document.getElementById('ethics-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 dark:hover:text-white font-bold text-lg p-1 cursor-pointer" aria-label="Tutup modal">&times;</button>
            </div>
            <div class="text-xs space-y-3.5 leading-relaxed text-[#5A6961] dark:text-[#C1D1C7] max-h-80 overflow-y-auto pr-2">
                <div class="p-3 rounded-xl bg-[#F8F6EF] dark:bg-[#16352A] border border-[#21845B]/15 dark:border-white/10">
                    <p class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-[11px] mb-1">Surat Edaran Gubernur Bali No. 4 Tahun 2023</p>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Tentang Tatanan Baru bagi Wisatawan Mancanegara dan Domestik selama berada di Bali demi menjaga kesucian dan keharmonisan alam, budaya, dan masyarakat.</p>
                </div>
                <p><strong class="text-[#202A25] dark:text-white">1. Penghormatan Kawasan Sakral:</strong> Pura dan situs suci di Bali adalah tempat peribadatan aktif umat Hindu Dharma. Wisatawan wajib mengenakan busana adat yang sopan (kamen dan selendang/senteng terikat rapi di pinggang). Dilarang memasuki area Jeroan (Utama Mandala) kecuali untuk persembahyangan suci.</p>
                <p><strong class="text-[#202A25] dark:text-white">2. Larangan Masuk saat Cuntaka:</strong> Wisatawan yang sedang dalam masa cuntaka (berhalangan haid/menstruasi, masa nifas, atau masa berkabung sanak keluarga terdekat) dilarang memasuki kawasan suci pura demi menjaga kesucian linggih Ida Sang Hyang Widhi Wasa.</p>
                <p><strong class="text-[#202A25] dark:text-white">3. Etika Dokumentasi & Drone:</strong> Dilarang menerbangkan drone di atas area sakral pura tanpa izin tertulis dari Prajuru Desa Adat. Menghindari melintas tepat di depan Pemangku/Pedanda yang sedang memimpin upacara persembahyangan.</p>
                <p><strong class="text-[#202A25] dark:text-white">4. Pelestarian Alam & Lingkungan:</strong> Tidak membuang sampah sembarangan di danau, pantai, sawah subak, atau jalur desa adat. Mendukung pengurangan sampah plastik sekali pakai.</p>
            </div>
            <div class="pt-2 text-right">
                <button type="button" onclick="document.getElementById('ethics-modal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] text-white text-xs font-semibold hover:bg-[#21845B] cursor-pointer">
                    {{ __('messages.footer_modal_close') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Modal: Kebijakan & Privasi AI (Grounding Tanpa Halusinasi) -->
    <div id="privacy-modal" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-xs flex items-center justify-center p-4 hidden" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-[#132B22] text-[#202A25] dark:text-[#F8F6EF] max-w-lg w-full rounded-3xl p-6 sm:p-8 shadow-2xl space-y-4 border border-gray-100 dark:border-white/10 transition-colors">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-white/10">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-[#DDF2DF] dark:bg-[#21845B]/30 flex items-center justify-center text-[#174D3B] dark:text-[#DDF2DF]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#174D3B] dark:text-[#DDF2DF]">Prinsip AI Grounding & Privasi Data</h3>
                </div>
                <button type="button" onclick="document.getElementById('privacy-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 dark:hover:text-white font-bold text-lg p-1 cursor-pointer" aria-label="Tutup modal">&times;</button>
            </div>
            <div class="text-xs space-y-3.5 leading-relaxed text-[#5A6961] dark:text-[#C1D1C7]">
                <div class="p-3 rounded-xl bg-[#F8F6EF] dark:bg-[#16352A] border border-[#21845B]/15 dark:border-white/10">
                    <p class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-[11px] mb-1">Komitmen Anti-Halusinasi Budaya</p>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Seluruh jawaban panduan adat Santi AI selalu di-grounding secara ketat pada regulasi resmi pemerintah dan Awig-Awig desa adat yang terverifikasi.</p>
                </div>
                <p><strong class="text-[#202A25] dark:text-white">Privasi Tanpa Pelacakan:</strong> Santi AI tidak mengumpulkan data sensitif, nomor paspor, atau rekam jejak pribadi wisatawan. Riwayat percakapan tidak dijual kepada pihak ketiga dan hanya diproses untuk menjawab pertanyaan budaya.</p>
                <p><strong class="text-[#202A25] dark:text-white">Keakuratan Pedoman:</strong> Jika suatu pura atau lokasi belum memiliki basis data aturan terverifikasi di sistem, Santi secara jujur akan menyatakan status belum terverifikasi demi menghindari misinformasi adat.</p>
            </div>
            <div class="pt-2 text-right">
                <button type="button" onclick="document.getElementById('privacy-modal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] text-white text-xs font-semibold hover:bg-[#21845B] cursor-pointer">
                    {{ __('messages.footer_modal_close') }}
                </button>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script>
        // Sticky Header on Scroll & Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('main-header');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            // Scroll Handler with Frosted Glass Blur Effect
            const isLanding = header && header.dataset.isLanding === '1';

            const updateHeaderOnScroll = () => {
                if (!header) return;
                if (isLanding) {
                    if (window.scrollY > 20) {
                        header.classList.add('glass-header-scrolled');
                        header.classList.remove('glass-header-transparent');
                    } else {
                        header.classList.remove('glass-header-scrolled');
                        header.classList.add('glass-header-transparent');
                    }
                } else {
                    header.classList.add('glass-header-scrolled');
                    header.classList.remove('glass-header-transparent');
                }
            };

            window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
            updateHeaderOnScroll();

            // Mobile Menu Toggle
            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    const isOpen = !mobileMenu.classList.contains('hidden');
                    if (isOpen) {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    } else {
                        mobileMenu.classList.remove('hidden');
                        hamburgerIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                    }
                });

                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    });
                });
            }

            // Dark Mode Theme Controller
            function updateThemeUI() {
                const isDark = document.documentElement.classList.contains('dark');
                ['theme-icon-sun', 'mobile-theme-icon-sun'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) isDark ? el.classList.remove('hidden') : el.classList.add('hidden');
                });
                ['theme-icon-moon', 'mobile-theme-icon-moon'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) isDark ? el.classList.add('hidden') : el.classList.remove('hidden');
                });
                const drawerText = document.getElementById('drawer-theme-text');
                if (drawerText) {
                    drawerText.textContent = isDark ? 'Light Mode ☀️' : 'Dark Mode 🌙';
                }
            }

            function toggleTheme() {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('santi_theme', isDark ? 'dark' : 'light');
                updateThemeUI();
            }

            const themeBtn = document.getElementById('theme-toggle-btn');
            const mobileThemeBtn = document.getElementById('mobile-theme-btn');
            const drawerThemeBtn = document.getElementById('drawer-theme-btn');
            if (themeBtn) themeBtn.addEventListener('click', toggleTheme);
            if (mobileThemeBtn) mobileThemeBtn.addEventListener('click', toggleTheme);
            if (drawerThemeBtn) drawerThemeBtn.addEventListener('click', toggleTheme);

            updateThemeUI();

            // Modal Dismissal on Outside Click & Escape Key
            ['ethics-modal', 'privacy-modal'].forEach(id => {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const ethicsModal = document.getElementById('ethics-modal');
                    const privacyModal = document.getElementById('privacy-modal');
                    if (ethicsModal) ethicsModal.classList.add('hidden');
                    if (privacyModal) privacyModal.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
