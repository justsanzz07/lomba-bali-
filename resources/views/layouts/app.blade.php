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
<body class="min-h-screen flex flex-col antialiased selection:bg-[#C6A15B] selection:text-white">
    <!-- Top Announcement Bar -->
    <div class="bg-[#174D3B] text-[#F8F6EF] px-4 py-2 text-xs md:text-sm font-medium border-b border-[#C6A15B]/30">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="inline-block w-2 h-2 rounded-full bg-[#C6A15B] animate-pulse"></span>
                <span>Santi AI Cultural Guardian • Menjaga Keharmonisan Dresta & Kesucian Budaya Bali</span>
            </div>
            <div class="hidden sm:flex items-center space-x-4 text-xs text-[#C6A15B]">
                <span>Om Swastiastu</span>
                <span>•</span>
                <span>Database-Backed Verification</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-[#FFFFFF]/90 backdrop-blur-md border-b border-[#174D3B]/10 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#174D3B] via-[#21845B] to-[#C6A15B] flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-200">
                        <!-- Balinese Candi/Lotus Icon -->
                        <svg class="w-7 h-7 text-[#F8F6EF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="font-serif-bali text-2xl font-bold tracking-wider text-[#174D3B]">SANTI</span>
                            <span class="text-[10px] uppercase font-bold tracking-widest px-2 py-0.5 rounded-full bg-[#C6A15B]/20 text-[#174D3B] border border-[#C6A15B]/40">AI Guardian</span>
                        </div>
                        <p class="text-xs text-[#5A6961] font-medium hidden sm:block">Cultural Etiquette & Sacred Area Assistant</p>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('landing') }}" class="text-sm font-semibold {{ request()->routeIs('landing') ? 'text-[#174D3B] border-b-2 border-[#174D3B] pb-1' : 'text-[#5A6961] hover:text-[#174D3B]' }} transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('locations.index') }}" class="text-sm font-semibold {{ request()->routeIs('locations.index') ? 'text-[#174D3B] border-b-2 border-[#174D3B] pb-1' : 'text-[#5A6961] hover:text-[#174D3B]' }} transition-colors">
                        Pilihan Lokasi Pura
                    </a>
                    <a href="{{ route('landing') }}#how-it-works" class="text-sm font-semibold text-[#5A6961] hover:text-[#174D3B] transition-colors">
                        Cara Kerja
                    </a>
                    <a href="{{ route('landing') }}#benefits" class="text-sm font-semibold text-[#5A6961] hover:text-[#174D3B] transition-colors">
                        Manfaat Budaya
                    </a>
                </nav>

                <!-- Action Button -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#174D3B] to-[#21845B] text-white text-sm font-semibold shadow-sm hover:shadow-md hover:from-[#21845B] hover:to-[#174D3B] transition-all duration-200">
                        <svg class="w-4 h-4 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
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

    <!-- Footer -->
    <footer class="bg-[#174D3B] text-[#F8F6EF] border-t-4 border-[#C6A15B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Column 1: Brand -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-[#C6A15B] flex items-center justify-center text-[#174D3B] font-bold">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                            </svg>
                        </div>
                        <span class="font-serif-bali text-2xl font-bold tracking-wider text-white">SANTI</span>
                    </div>
                    <p class="text-sm text-[#F8F6EF]/80 leading-relaxed max-w-md">
                        Santi adalah asisten kecerdasan buatan penjaga kesucian dan etika kebudayaan Bali. Membantu wisatawan domestik dan mancanegara memahami tata krama adat, busana persembahyangan, dan batasan sakral pura dengan rujukan aturan adat terverifikasi.
                    </p>
                    <div class="pt-2 text-xs text-[#C6A15B] flex items-center space-x-2">
                        <span>✦ Tri Hita Karana</span>
                        <span>•</span>
                        <span>Desa Kala Patra</span>
                        <span>•</span>
                        <span>Menjaga Taksu Bali</span>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#C6A15B] mb-4">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm text-[#F8F6EF]/80">
                        <li><a href="{{ route('landing') }}" class="hover:text-white transition-colors">Halaman Utama</a></li>
                        <li><a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">Pilihan Lokasi Pura</a></li>
                        <li><a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition-colors">Cara Kerja Sistem</a></li>
                        <li><a href="{{ route('landing') }}#benefits" class="hover:text-white transition-colors">Manfaat Wisatawan</a></li>
                    </ul>
                </div>

                <!-- Column 3: Transparency Note -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#C6A15B] mb-4">Integritas Budaya</h3>
                    <p class="text-xs text-[#F8F6EF]/70 leading-relaxed">
                        Santi tidak mengarang aturan adat. Santi mengutamakan database pedoman yang telah terkurasi dan terverifikasi dari sumber berwenang (PHDI, Pemerintah Provinsi Bali, serta Pengelola Adat setempat).
                    </p>
                    <div class="mt-4 p-3 rounded-lg bg-black/20 border border-[#C6A15B]/30 text-[11px] text-[#C6A15B]">
                        Didukung oleh Google Gemini Generative AI & Laravel Architecture.
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-[#F8F6EF]/10 flex flex-col sm:flex-row items-center justify-between text-xs text-[#F8F6EF]/60">
                <p>&copy; {{ date('Y') }} SANTI — AI Cultural Guardian Bali. Minimum Viable Product untuk Kompetisi Inovasi AI.</p>
                <p class="mt-2 sm:mt-0">Dirancang dengan komitmen pelestarian budaya Bali.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
