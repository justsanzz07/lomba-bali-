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

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8F6EF;
            color: #202A25;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#21845B] selection:text-white">
    <!-- Header / Navigation Bar (Transparent over Hero on Landing, Sticky with Blur) -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 {{ request()->routeIs('landing') ? 'bg-transparent text-white' : 'bg-[#174D3B] text-white shadow-md' }}">
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
                            AI Cultural Guardian
                        </div>
                    </div>
                </a>

                <!-- Center Navigation (Desktop) -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-white/90">
                    <a href="{{ route('landing') }}#hero" class="hover:text-white transition-colors">Home</a>
                    <a href="{{ route('landing') }}#about" class="hover:text-white transition-colors">About</a>
                    <a href="{{ route('landing') }}#services" class="hover:text-white transition-colors">Cultural Guide</a>
                    <a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition-colors">How It Works</a>
                    <a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">Locations</a>
                    <a href="{{ route('landing') }}#ai-assistant" class="hover:text-white transition-colors">AI Assistant</a>
                </nav>

                <!-- Right-side Action Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('landing') }}#footer" class="px-4 py-2 rounded-full text-xs font-semibold text-white/90 hover:text-white border border-white/20 hover:border-white/40 transition-colors">
                        Contact Us
                    </a>
                    <a href="{{ route('santi.show', 'pura-ulun-danu-beratan') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-full bg-white hover:bg-[#DDF2DF] text-[#174D3B] text-xs font-bold shadow-md hover:shadow-lg transition-all duration-200">
                        <span>Ask Santi AI</span>
                        <svg class="w-3.5 h-3.5 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center md:hidden">
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
        <div id="mobile-menu" class="hidden md:hidden bg-[#174D3B] border-t border-white/10 px-4 pt-4 pb-6 space-y-3 shadow-xl">
            <a href="{{ route('landing') }}#hero" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">Home</a>
            <a href="{{ route('landing') }}#about" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">About</a>
            <a href="{{ route('landing') }}#services" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">Cultural Guide</a>
            <a href="{{ route('landing') }}#how-it-works" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">How It Works</a>
            <a href="{{ route('locations.index') }}" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">Locations Directory</a>
            <a href="{{ route('landing') }}#ai-assistant" class="mobile-link block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">AI Assistant</a>
            <div class="pt-4 border-t border-white/10 flex flex-col space-y-2">
                <a href="{{ route('santi.show', 'pura-ulun-danu-beratan') }}" class="w-full text-center py-3 rounded-full bg-white text-[#174D3B] font-bold text-xs shadow-md">
                    Ask Santi AI
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer" class="bg-[#103327] text-[#F8F6EF] border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-12">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-[#21845B] flex items-center justify-center text-white font-bold text-xs">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28L21 12l-5.8-1.9a2 2 0 0 1-1.28-1.28Z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-xl tracking-tight text-white block">SANTI</span>
                            <span class="text-[9px] uppercase tracking-widest text-[#DDF2DF]">AI Cultural Guardian</span>
                        </div>
                    </div>
                    <p class="text-xs text-[#F8F6EF]/75 leading-relaxed max-w-sm">
                        Empowering respectful tourism in Bali through artificial intelligence, preserving sacred traditions, and ensuring cultural reverence for the island of the Gods.
                    </p>
                    <div class="text-[11px] text-[#DDF2DF]/80 pt-1">
                        Powered by Gemini Generative AI & Database-Backed Context Retrieval.
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#DDF2DF] mb-4">Quick Links</h3>
                    <ul class="space-y-2.5 text-xs text-[#F8F6EF]/80">
                        <li><a href="{{ route('landing') }}#hero" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('landing') }}#about" class="hover:text-white transition-colors">About Santi</a></li>
                        <li><a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">Cultural Locations</a></li>
                        <li><a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition-colors">How It Works</a></li>
                    </ul>
                </div>

                <!-- Col 3: AI Features -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#DDF2DF] mb-4">AI Features</h3>
                    <ul class="space-y-2.5 text-xs text-[#F8F6EF]/80">
                        <li><a href="{{ route('santi.show', 'pura-besakih') }}" class="hover:text-white transition-colors">AI Cultural Assistant</a></li>
                        <li><a href="{{ route('landing') }}#services" class="hover:text-white transition-colors">Cultural Guidelines</a></li>
                        <li><a href="{{ route('locations.index') }}" class="hover:text-white transition-colors">Location-Smart Guidance</a></li>
                        <li><a href="{{ route('landing') }}#services" class="hover:text-white transition-colors">Sacred Area Etiquette</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Support -->
                <div>
                    <h3 class="text-xs uppercase tracking-wider font-bold text-[#DDF2DF] mb-4">Contact & Support</h3>
                    <div class="space-y-2 text-xs text-[#F8F6EF]/80">
                        <p class="font-medium text-white">Bali Cultural Heritage Initiative</p>
                        <p class="text-[11px] text-[#F8F6EF]/70">Denpasar, Bali, Indonesia</p>
                        <div class="pt-2">
                            <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-1 px-3.5 py-1.5 rounded-full bg-[#21845B] hover:bg-[#174D3B] text-white text-[11px] font-semibold transition-colors">
                                <span>Launch AI Assistant</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-[11px] text-[#F8F6EF]/60">
                <p>&copy; {{ date('Y') }} SANTI — AI Cultural Guardian. All rights reserved.</p>
                <div class="flex items-center space-x-6 mt-3 sm:mt-0">
                    <span class="hover:text-white cursor-pointer transition-colors">Privacy Policy</span>
                    <span class="hover:text-white cursor-pointer transition-colors">Terms of Cultural Reverence</span>
                    <span class="hover:text-white cursor-pointer transition-colors">Community Guidelines</span>
                </div>
            </div>
        </div>
    </footer>

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

            // Scroll Handler
            window.addEventListener('scroll', () => {
                if (window.scrollY > 40) {
                    header.classList.add('bg-[#174D3B]/95', 'backdrop-blur-md', 'shadow-md');
                    header.classList.remove('bg-transparent');
                } else {
                    if (window.location.pathname === '/') {
                        header.classList.remove('bg-[#174D3B]/95', 'backdrop-blur-md', 'shadow-md');
                        header.classList.add('bg-transparent');
                    }
                }
            });

            // Mobile Menu
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
        });
    </script>
</body>
</html>
