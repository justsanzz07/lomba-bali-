<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Santi — AI Cultural Guardian Bali')</title>
    <meta name="description" content="@yield('meta_description', 'Santi adalah asisten pemandu budaya virtual berbasis AI untuk wisatawan di Bali. Menjaga kesucian dan menghormati tradisi adat Bali.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-bali {
            font-family: 'Cinzel', serif, Georgia;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8F6EF;
            color: #202A25;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#4ea8de] selection:text-white">
    <!-- Main Navigation Header (Overlays hero on landing page, solid on inner pages) -->
    <header id="main-header" class="{{ request()->routeIs('landing') ? 'fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-black/20 backdrop-blur-xs' : 'sticky top-0 z-50 bg-[#174D3B] text-white shadow-md' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand / Logo (matching reference style: clean white typography) -->
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                    <span class="text-xl sm:text-2xl font-bold tracking-tight text-white group-hover:text-white/90 transition-colors">
                        Santi Cultural Guardian
                    </span>
                </a>

                <!-- Desktop Nav Links (matching reference screenshot layout) -->
                <nav class="hidden lg:flex items-center space-x-7 text-sm font-medium text-white/90">
                    <a href="{{ route('landing') }}" class="hover:text-white transition-colors {{ request()->routeIs('landing') ? 'text-white font-semibold' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('locations.index') }}" class="hover:text-white transition-colors {{ request()->routeIs('locations.index') ? 'text-white font-semibold' : '' }}">
                        Lokasi Pura
                    </a>
                    <a href="{{ route('landing') }}#guidelines" class="hover:text-white transition-colors">
                        Aturan Adat
                    </a>
                    <a href="{{ route('landing') }}#etiquette" class="hover:text-white transition-colors">
                        Etika Busana
                    </a>
                    <a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition-colors">
                        Cara Kerja
                    </a>
                    <a href="{{ route('landing') }}#about" class="hover:text-white transition-colors">
                        Tentang Santi
                    </a>

                    <!-- Language Dropdown in Nav -->
                    <div class="relative group">
                        <button type="button" class="inline-flex items-center space-x-1 hover:text-white py-1">
                            <span>🇮🇩 Indonesia</span>
                            <svg class="w-3.5 h-3.5 ml-0.5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-36 rounded-xl bg-white shadow-lg py-2 text-xs font-semibold text-[#202A25] hidden group-hover:block border border-gray-100">
                            <a href="?lang=id" class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-50 text-[#174D3B]">
                                <span>🇮🇩 Indonesia</span>
                            </a>
                            <a href="?lang=en" class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-50 text-[#5A6961]">
                                <span>🇺🇸 English</span>
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Action Button: Sky-Blue "Ask Santi" (Matching "Book Now" button in screenshot) -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-[#4ea8de] hover:bg-[#38bdf8] text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <!-- Calendar / Message Icon -->
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Tanya Santi AI</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp / Quick Assistance Button (matching screenshot bottom right) -->
    <aside aria-label="Bantuan Cepat">
        <a href="{{ route('santi.show', 'pura-ulun-danu-beratan') }}"
           title="Tanya Santi AI (Asisten Budaya Virtual)"
           class="fixed bottom-6 right-6 z-50 w-13 h-13 rounded-full bg-[#25D366] hover:bg-[#20ba59] text-white shadow-xl flex items-center justify-center hover:scale-110 transition-transform duration-200 focus:outline-none focus:ring-4 focus:ring-green-300">
            <!-- WhatsApp / Chat Icon -->
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c.969.582 1.774.887 2.806.887 3.181 0 5.767-2.586 5.767-5.766.001-3.182-2.585-5.77-5.767-5.77zm3.393 8.163c-.144.405-.837.774-1.17.822-.312.043-.679.071-2.138-.533-1.631-.676-2.679-2.336-2.76-2.444-.081-.108-.66-8.79-.66-1.677 0-.798.419-1.19.568-1.341.149-.151.326-.189.435-.189.109 0 .218.001.312.006.1.005.234-.038.366.279.144.347.491 1.199.534 1.286.043.087.072.189.014.304-.058.116-.087.189-.174.289-.087.101-.183.226-.261.304-.087.087-.178.181-.077.355.101.174.449.741.963 1.2 1.054.94 1.942 1.232 2.217 1.368.275.136.435.116.594-.067.159-.183.681-.795.862-1.07.181-.275.362-.232.608-.145.246.087 1.565.738 1.833.872.268.134.449.203.514.318.065.116.065.672-.079 1.077z"/>
                <path d="M12 2C6.477 2 2 6.477 2 12c0 1.821.487 3.53 1.338 5.003L2 22l5.127-1.314A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.2c-1.628 0-3.15-.467-4.444-1.274l-.319-.199-3.303.847.88-3.219-.211-.336A8.163 8.163 0 013.8 12c0-4.521 3.679-8.2 8.2-8.2s8.2 3.679 8.2 8.2-3.679 8.2-8.2 8.2z"/>
            </svg>
        </a>
    </aside>

    <!-- Footer -->
    <footer class="bg-[#174D3B] text-[#F8F6EF] border-t-4 border-[#4ea8de]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Column 1: Brand -->
                <div class="md:col-span-2 space-y-4">
                    <span class="text-2xl font-bold tracking-tight text-white block">
                        Santi Cultural Guardian Bali
                    </span>
                    <p class="text-sm text-[#F8F6EF]/80 leading-relaxed max-w-md">
                        Asisten pemandu budaya virtual berbasis AI untuk wisatawan di Bali. Mengedukasi tata krama adat, busana persembahyangan (kamen & senteng), dan batasan kesucian mandala pura berdasarkan data resmi yang terverifikasi.
                    </p>
                    <div class="pt-2 text-xs text-[#4ea8de] flex items-center space-x-2 font-medium">
                        <span>✦ Tri Hita Karana</span>
                        <span>•</span>
                        <span>Desa Kala Patra</span>
                        <span>•</span>
                        <span>Menjaga Taksu Bali</span>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#4ea8de] mb-4">Navigasi Pura</h3>
                    <ul class="space-y-2.5 text-sm text-[#F8F6EF]/80">
                        <li><a href="{{ route('landing') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">Pilihan Kawasan Pura</a></li>
                        <li><a href="{{ route('santi.show', 'pura-ulun-danu-beratan') }}" class="hover:text-white transition-colors">Pura Ulun Danu Beratan</a></li>
                        <li><a href="{{ route('santi.show', 'pura-besakih') }}" class="hover:text-white transition-colors">Pura Agung Besakih</a></li>
                    </ul>
                </div>

                <!-- Column 3: Verification Note -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#4ea8de] mb-4">Prinsip Integritas</h3>
                    <p class="text-xs text-[#F8F6EF]/70 leading-relaxed">
                        Santi tidak mengarang aturan adat. Setiap panduan terikat pada basis data terverifikasi (PHDI, Pemprov Bali, dan Pengelola Desa Adat).
                    </p>
                    <div class="mt-4 p-3 rounded-lg bg-black/20 border border-white/10 text-[11px] text-[#4ea8de]">
                        Didukung oleh Google Gemini AI & Database-Backed Context Retrieval.
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-[#F8F6EF]/10 flex flex-col sm:flex-row items-center justify-between text-xs text-[#F8F6EF]/60">
                <p>&copy; {{ date('Y') }} SANTI — AI Cultural Guardian Bali. Minimum Viable Product.</p>
                <p class="mt-2 sm:mt-0">Dirancang dengan komitmen pelestarian budaya dan kesucian pura Bali.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // Header scroll effect on landing page
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('main-header');
            if (header && window.location.pathname === '/') {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        header.classList.add('bg-[#174D3B]/95', 'backdrop-blur-md', 'shadow-md');
                        header.classList.remove('bg-black/20', 'backdrop-blur-xs');
                    } else {
                        header.classList.remove('bg-[#174D3B]/95', 'backdrop-blur-md', 'shadow-md');
                        header.classList.add('bg-black/20', 'backdrop-blur-xs');
                    }
                });
            }
        });
    </script>
</body>
</html>
