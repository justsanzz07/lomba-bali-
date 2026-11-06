@extends('layouts.app')

@section('title', 'SANTI — AI Cultural Guardian Bali | ' . __('messages.hero_title_1') . ' ' . __('messages.hero_title_2'))

@push('styles')
    <link rel="preload" as="image" href="{{ asset('images/hero-light.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('images/hero-dark.jpg') }}">
@endpush

@section('content')
    <!-- ==================== 1. HERO SECTION ==================== -->
    <section id="hero" class="relative min-h-[92vh] lg:min-h-screen flex items-center justify-center text-white overflow-hidden">
        <!-- Light Mode Background (Garuda Wisnu Kencana Siang Hari) -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-700 ease-in-out opacity-100 dark:opacity-0"
             style="background-image: url('{{ asset('images/hero-light.jpg') }}');"></div>

        <!-- Dark Mode Background (Garuda Wisnu Kencana Malam Hari & Bulan Purnama) -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-700 ease-in-out opacity-0 dark:opacity-100"
             style="background-image: url('{{ asset('images/hero-dark.jpg') }}');"></div>

        <!-- Atmospheric Overlays for Optimal Text Readability & Contrast -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/75 dark:hidden transition-opacity duration-500"></div>
        <div class="absolute inset-0 hidden dark:block bg-gradient-to-b from-[#0B1E17]/70 via-black/40 to-[#0E231B] transition-opacity duration-500"></div>
        <div class="absolute inset-0 bg-black/15 pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-28 pb-20 text-center flex flex-col items-center justify-center space-y-4 sm:space-y-5">
            <!-- Main Headline -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white leading-tight max-w-2xl drop-shadow-md">
                {{ __('messages.hero_title_1') }}<br>
                {{ __('messages.hero_title_2') }}
            </h1>

            <!-- Subtitle -->
            <p class="text-xs sm:text-sm md:text-base text-white/90 leading-relaxed font-normal max-w-lg mx-auto drop-shadow-sm">
                {{ __('messages.hero_subtitle') }}
            </p>

            <!-- Centered Action Buttons -->
            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3 w-full sm:w-auto">
                <a href="{{ route('santi.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-6 py-2.5 sm:py-3 rounded-full bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-bold text-xs sm:text-sm shadow-lg hover:shadow-xl transition-all duration-200">
                    <span>{{ __('messages.hero_cta_primary') }}</span>
                    <svg class="w-4 h-4 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

                <a href="#services"
                   class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-6 py-2.5 sm:py-3 rounded-full bg-white/15 hover:bg-white/25 text-white font-semibold text-xs sm:text-sm backdrop-blur-md border border-white/30 transition-all duration-200">
                    <span>{{ __('messages.hero_cta_secondary') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ==================== 2. ABOUT SECTION ==================== -->
    <section id="about" class="py-20 bg-[#F8F6EF] dark:bg-[#0E231B] transition-colors duration-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                <!-- Left Side: Text Content -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-block px-3 py-1 rounded-full bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold tracking-wider uppercase">
                        {{ __('messages.about_label') }}
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight leading-tight">
                        {{ __('messages.about_heading') }}
                    </h2>

                    <div class="space-y-3.5 text-sm sm:text-base text-[#202A25]/80 dark:text-[#C1D1C7] leading-relaxed font-normal">
                        <p>
                            {{ __('messages.about_p1') }}
                        </p>
                        <p>
                            {{ __('messages.about_p2') }}
                        </p>
                    </div>

                    <!-- Factual Cultural Alignment Point -->
                    <div class="pt-1 text-xs font-semibold text-[#174D3B] dark:text-[#A7D9B8] flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-[#21845B]"></span>
                        <span>{{ __('messages.about_highlight') }}</span>
                    </div>

                    <!-- CTA Button -->
                    <div class="pt-3">
                        <a href="#services"
                           class="inline-flex items-center space-x-2 px-5.5 py-2.5 rounded-full bg-[#DDF2DF] hover:bg-[#c9e8cd] dark:bg-[#21845B] dark:hover:bg-[#1a6e4b] text-[#174D3B] dark:text-white text-xs font-bold transition-colors">
                            <span>{{ __('messages.about_cta') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Compact Sized Image with Overlapping Floating Cards -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <div class="relative w-full max-w-[340px] sm:max-w-[390px]">
                        <!-- Main Photograph (Compact & Balanced) -->
                        <div class="rounded-3xl overflow-hidden shadow-xl border-4 border-white dark:border-[#16352A] aspect-[4/4] bg-gray-200 transition-colors">
                            <img src="{{ asset('images/about-bali-guide.jpg') }}"
                                 alt="Balinese Cultural Heritage Guide"
                                 class="w-full h-full object-cover"
                                 onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                        </div>

                        <!-- Floating Information Card 1 (Top Right) -->
                        <div class="absolute -top-4 -right-2 sm:-right-4 bg-white dark:bg-[#16352A] p-3.5 rounded-2xl shadow-lg border border-gray-100 dark:border-white/10 max-w-[190px] space-y-1 transition-colors">
                            <div class="flex items-center space-x-1.5">
                                <span class="text-lg font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.about_badge_247') }}</span>
                                <span class="text-[9px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#A7D9B8]">{{ __('messages.about_badge_assistance') }}</span>
                            </div>
                            <p class="text-[10px] text-[#737B75] dark:text-[#A7B9AF] leading-tight">
                                {{ __('messages.about_badge_desc1') }}
                            </p>
                        </div>

                        <!-- Floating Information Card 2 (Bottom Left) -->
                        <div class="absolute -bottom-4 -left-2 sm:-left-4 bg-white dark:bg-[#16352A] p-3.5 rounded-2xl shadow-lg border border-gray-100 dark:border-white/10 max-w-[205px] space-y-1 transition-colors">
                            <div class="flex items-center space-x-1.5">
                                <div class="w-2 h-2 rounded-full bg-[#21845B]"></div>
                                <h4 class="font-bold text-xs text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.about_badge_multilingual') }}</h4>
                            </div>
                            <p class="text-[10px] text-[#737B75] dark:text-[#A7B9AF] leading-tight">
                                {{ __('messages.about_badge_desc2') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 3. CULTURAL SERVICES SECTION (ASYMMETRICAL HUB) ==================== -->
    <section id="services" class="py-20 bg-white dark:bg-[#0B1E17] border-t border-[#174D3B]/10 dark:border-white/10 relative overflow-hidden transition-colors duration-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Row: Label & Main Heading on Left, Description on Right -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div class="max-w-xl">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold tracking-wider uppercase mb-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#21845B]"></span>
                        <span>{{ __('messages.services_label') }}</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight leading-tight">
                        {{ __('messages.services_heading') }}
                    </h2>
                </div>
                <div class="max-w-md">
                    <p class="text-xs sm:text-sm text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                        {{ __('messages.services_desc') }}
                    </p>
                </div>
            </div>

            <!-- Asymmetrical Service Architecture: Flagship Interactive Hub (7 col) + Stacked Feature Tiles (5 col) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- ==================== FLAGSHIP HERO CARD: SANTI AI CULTURAL ASSISTANT (Span 7) ==================== -->
                <div class="lg:col-span-7 bg-[#174D3B] dark:bg-[#133E2F] text-white rounded-3xl p-7 sm:p-9 lg:p-10 shadow-xl border border-[#21845B]/40 relative overflow-hidden flex flex-col justify-between">
                    <!-- Subtle ambient texture overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-[#103327]/90 via-[#174D3B]/95 to-[#174D3B] pointer-events-none"></div>
                    <img src="{{ asset('images/service-ai-chat.jpg') }}"
                         alt="Santi AI Chat"
                         class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-25 pointer-events-none"
                         onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">

                    <div class="relative z-10 space-y-6">
                        <!-- Top Metadata & Pill -->
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-[#21845B] text-white text-[11px] font-extrabold tracking-wider uppercase border border-white/20 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#C6A15B]"></span>
                                <span>{{ __('messages.services_badge_interactive') }}</span>
                            </span>
                            <span class="text-[11px] text-[#DDF2DF]/80 font-mono">Google Gemini AI • Awig-Awig RAG</span>
                        </div>

                        <!-- Card Heading & Value Proposition -->
                        <div class="space-y-3">
                            <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                                {{ __('messages.services_card1_title') }}
                            </h3>
                            <p class="text-xs sm:text-sm text-white/85 leading-relaxed">
                                {{ __('messages.services_card1_desc') }}
                            </p>
                        </div>

                        <!-- Interactive Sample Inquiry Pills -->
                        <div class="space-y-3 pt-2">
                            <div class="text-[11px] font-bold text-[#DDF2DF] uppercase tracking-wider flex items-center space-x-1.5">
                                <svg class="w-3.5 h-3.5 text-[#C6A15B]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Coba Tanya Simulasi Cepat:</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                        class="service-prompt-btn px-3 py-1.5 rounded-xl bg-white/15 hover:bg-white/25 border border-white/20 text-xs font-semibold text-white transition-all text-left"
                                        data-q="Apakah wajib memakai kain kamen dan selendang senteng saat ke pura?"
                                        data-a="Ya, seluruh pengunjung wajib mengenakan kamen menutup hingga bawah lutut dan mengikatkan senteng di pinggang sebagai simbol kendali hawa nafsu."
                                        data-src="Awig-Awig Pura Besakih & SE No. 4/2023">
                                    Aturan Busana Pura
                                </button>
                                <button type="button"
                                        class="service-prompt-btn px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/25 border border-white/15 text-xs font-semibold text-white/90 transition-all text-left"
                                        data-q="Bolehkah masuk ke pura saat sedang menstruasi atau masa duka?"
                                        data-a="Dilarang keras. Berdasarkan dresta adat Bali, orang yang berada dalam masa cuntaka (menstruasi/duka) harus menjaga kesucian kawasan pura."
                                        data-src="Pedoman PHDI Bali & Awig-Awig Adat">
                                    Etika Cuntaka
                                </button>
                                <button type="button"
                                        class="service-prompt-btn px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/25 border border-white/15 text-xs font-semibold text-white/90 transition-all text-left"
                                        data-q="Bolehkah menerbangkan drone di atas area upacara persembahyangan?"
                                        data-a="Dilarang keras menerbangkan drone di atas area upacara ibadah tanpa izin resmi tertulis dari Badan Pengelola Kawasan Adat."
                                        data-src="Surat Edaran Gubernur Bali No. 4/2023">
                                    Larangan Drone & Foto
                                </button>
                            </div>

                            <!-- Live Simulated Response Bubble -->
                            <div class="p-4 rounded-2xl bg-[#103327] border border-[#21845B]/60 space-y-2 text-xs shadow-inner">
                                <div class="text-white/70 italic" id="service-sample-question">
                                    "Apakah wajib memakai kain kamen dan selendang senteng saat ke pura?"
                                </div>
                                <div class="text-[#DDF2DF] flex items-start space-x-2 pt-1 border-t border-white/10">
                                    <strong class="text-[#C6A15B] flex-shrink-0">Santi:</strong>
                                    <span id="service-sample-answer">Ya, seluruh pengunjung wajib mengenakan kamen menutup hingga bawah lutut dan mengikatkan senteng di pinggang sebagai simbol kendali hawa nafsu.</span>
                                </div>
                                <div class="pt-1.5 flex items-center justify-between text-[10px] text-white/60">
                                    <span id="service-sample-source">Sumber: Awig-Awig Pura Besakih & SE No. 4/2023</span>
                                    <span class="text-[#C6A15B] font-bold">Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom CTA Action -->
                    <div class="relative z-10 pt-6 mt-6 border-t border-white/15 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-xs text-white/75">
                            Konsultasikan pertanyaan etika & panduan destinasi wisata Anda langsung.
                        </span>
                        <a href="{{ route('santi.index') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-6 py-3 rounded-xl bg-[#21845B] hover:bg-[#1a6e4b] text-white font-bold text-xs shadow-md transition-all">
                            <span>{{ __('messages.services_card1_cta') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- ==================== STACKED FEATURE TILES (Span 5) ==================== -->
                <div class="lg:col-span-5 flex flex-col justify-between gap-6">
                    <!-- TILE 1: Cultural Guidelines & SE No. 4/2023 -->
                    <div class="group bg-[#F8F6EF] dark:bg-[#16352A] rounded-3xl p-6 sm:p-7 border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 dark:hover:border-[#21845B]/60 transition-all duration-300 shadow-xs hover:shadow-md flex flex-col justify-between h-full">
                        <div>
                            <!-- Header & Icon -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center flex-shrink-0 shadow-xs">
                                    <svg class="w-6 h-6 text-[#174D3B] dark:text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-md bg-white dark:bg-[#1D4436] border border-[#174D3B]/10 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-bold uppercase tracking-wider">
                                    {{ __('messages.services_badge_etiquette') }}
                                </span>
                            </div>

                            <!-- Content -->
                            <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF] mb-2 group-hover:text-[#21845B] dark:group-hover:text-[#34D399] transition-colors">
                                {{ __('messages.services_card2_title') }}
                            </h3>
                            <p class="text-xs text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed mb-4">
                                {{ __('messages.services_card2_desc') }}
                            </p>

                            <!-- Feature Chips -->
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Kamen & Senteng</span>
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Batas Tri Mandala</span>
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Sanksi Adat</span>
                            </div>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-3 border-t border-gray-200/60 dark:border-white/10 flex items-center justify-between">
                            <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF] group-hover:text-[#21845B] dark:group-hover:text-[#34D399] transition-colors">
                                {{ __('messages.services_card2_cta') }}
                            </a>
                            <a href="{{ route('locations.index') }}" class="w-8 h-8 rounded-full bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center group-hover:bg-[#174D3B] dark:group-hover:bg-[#21845B] group-hover:text-white transition-colors shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- TILE 2: Heritage Destination Directory -->
                    <div class="group bg-[#F8F6EF] dark:bg-[#16352A] rounded-3xl p-6 sm:p-7 border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 dark:hover:border-[#21845B]/60 transition-all duration-300 shadow-xs hover:shadow-md flex flex-col justify-between h-full">
                        <div>
                            <!-- Header & Icon -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center flex-shrink-0 shadow-xs">
                                    <svg class="w-6 h-6 text-[#174D3B] dark:text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-md bg-white dark:bg-[#1D4436] border border-[#174D3B]/10 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-bold uppercase tracking-wider">
                                    {{ __('messages.services_badge_context') }}
                                </span>
                            </div>

                            <!-- Content -->
                            <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF] mb-2 group-hover:text-[#21845B] dark:group-hover:text-[#34D399] transition-colors">
                                {{ __('messages.services_card3_title') }}
                            </h3>
                            <p class="text-xs text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed mb-4">
                                {{ __('messages.services_card3_desc') }}
                            </p>

                            <!-- Destination Chips -->
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Pura Besakih & Uluwatu</span>
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Desa Penglipuran</span>
                                <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] text-[11px] font-semibold border border-gray-100 dark:border-white/10">Subak Jatiluwih (UNESCO)</span>
                            </div>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-3 border-t border-gray-200/60 dark:border-white/10 flex items-center justify-between">
                            <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF] group-hover:text-[#21845B] dark:group-hover:text-[#34D399] transition-colors">
                                {{ __('messages.services_card3_cta') }}
                            </a>
                            <a href="{{ route('locations.index') }}" class="w-8 h-8 rounded-full bg-white dark:bg-[#1D4436] text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center group-hover:bg-[#174D3B] dark:group-hover:bg-[#21845B] group-hover:text-white transition-colors shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered Button Below the Showcase -->
            <div class="text-center mt-12">
                <a href="{{ route('locations.index') }}"
                   class="inline-flex items-center space-x-2.5 px-8 py-3.5 rounded-full bg-[#174D3B] hover:bg-[#21845B] dark:bg-[#21845B] dark:hover:bg-[#1a6e4b] text-white text-xs font-bold tracking-wider uppercase transition-all shadow-sm hover:shadow-md">
                    <span>{{ __('messages.services_explore_all') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ==================== 4. HOW IT WORKS SECTION (MINIMALIST & COMPACT) ==================== -->
    <section id="how-it-works" class="py-20 bg-[#F8F6EF] dark:bg-[#0E231B] border-t border-[#174D3B]/10 dark:border-white/10 relative overflow-hidden transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div class="max-w-xl">
                    <span class="text-[11px] sm:text-xs font-bold tracking-widest text-[#21845B] dark:text-[#34D399] uppercase block mb-2">
                        {{ __('messages.how_label') }}
                    </span>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight leading-tight">
                        {{ __('messages.how_heading') }}
                    </h2>
                </div>
                <div class="max-w-md">
                    <p class="text-xs sm:text-sm text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                        {{ __('messages.how_desc') }}
                    </p>
                </div>
            </div>

            <!-- Stepped Progressive Cultural Storyboard Cards (Compact & Minimal) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                <!-- ==================== STAGE 1: SEBELUM BERANGKAT ==================== -->
                <div class="group bg-white dark:bg-[#16352A] rounded-3xl overflow-hidden shadow-xs hover:shadow-lg border border-[#174D3B]/10 dark:border-white/10 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Photographic Header (Compact) -->
                        <div class="relative h-36 sm:h-40 bg-gray-900 overflow-hidden">
                            <img src="{{ asset('images/service-guidelines.jpg') }}"
                                 alt="{{ __('messages.how_step1_title') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent"></div>
                            
                            <!-- Stage Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-[#174D3B]/90 backdrop-blur-xs text-white text-[10px] font-bold border border-white/20">
                                    <span>01</span>
                                    <span>•</span>
                                    <span>{{ __('messages.how_step1_badge') }}</span>
                                </span>
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <p class="text-[10px] font-medium text-[#DDF2DF]">Persiapan Dresta & Kunjungan</p>
                                <h3 class="text-base font-bold leading-snug text-white">
                                    {{ __('messages.how_step1_title') }}
                                </h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <p class="text-xs text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                                {{ __('messages.how_step1_desc') }}
                            </p>

                            <!-- Concrete Checklist -->
                            <div class="space-y-1.5 pt-2 border-t border-gray-100 dark:border-white/10 text-xs text-[#202A25] dark:text-[#F8F6EF]">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3.5 h-3.5 text-[#21845B] dark:text-[#34D399] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Ketentuan busana sopan (kamen & senteng)</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3.5 h-3.5 text-[#21845B] dark:text-[#34D399] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Pengecekan batasan masa cuntaka/berhalangan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Tags -->
                    <div class="p-5 sm:p-6 pt-0">
                        <div class="pt-3 border-t border-gray-100 dark:border-white/10 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step1_tag1') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step1_tag2') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step1_tag3') }}</span>
                        </div>
                    </div>
                </div>

                <!-- ==================== STAGE 2: DI DEPAN GERBANG / CANDI BENTAR (FLAGSHIP) ==================== -->
                <div class="group bg-[#174D3B] dark:bg-[#133E2F] text-white rounded-3xl overflow-hidden shadow-xl border border-[#21845B]/60 transform lg:-translate-y-2 hover:lg:-translate-y-4 transition-all duration-300 flex flex-col justify-between relative">
                    <div>
                        <!-- Photographic Header (Compact) -->
                        <div class="relative h-36 sm:h-40 bg-gray-900 overflow-hidden">
                            <img src="{{ asset('images/service-ai-chat.jpg') }}"
                                 alt="{{ __('messages.how_step2_title') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#174D3B] via-black/30 to-transparent"></div>
                            
                            <!-- Stage Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-[#21845B] text-white text-[10px] font-bold shadow-md">
                                    <span>02</span>
                                    <span>•</span>
                                    <span>{{ __('messages.how_step2_badge') }}</span>
                                </span>
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <p class="text-[10px] font-medium text-[#C6A15B]">Konsultasi AI Candi Bentar</p>
                                <h3 class="text-base font-bold leading-snug text-white">
                                    {{ __('messages.how_step2_title') }}
                                </h3>
                            </div>
                        </div>

                        <!-- Card Body with Mini Mock Chat Context -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <p class="text-xs text-white/85 leading-relaxed">
                                {{ __('messages.how_step2_desc') }}
                            </p>

                            <!-- Mini In-Context Dialog Bubble -->
                            <div class="p-3 rounded-2xl bg-white/10 border border-white/10 space-y-1.5 text-xs">
                                <div class="text-[#DDF2DF] font-semibold text-[10px] flex items-center space-x-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#C6A15B]"></span>
                                    <span>Simulasi Pertanyaan di Lokasi:</span>
                                </div>
                                <p class="text-white/90 italic text-[11px]">
                                    "Bolehkah saya mengambil foto saat pemangku memimpin upacara persembahyangan?"
                                </p>
                                <div class="text-[10px] text-[#DDF2DF] pt-1 border-t border-white/10 flex items-center space-x-1">
                                    <strong class="text-white">Santi AI:</strong>
                                    <span>Boleh dari jarak santun tanpa flash/lampu kilat.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Tags -->
                    <div class="p-5 sm:p-6 pt-0">
                        <div class="pt-3 border-t border-white/15 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-lg bg-white/10 text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step2_tag1') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-white/10 text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step2_tag2') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-[#C6A15B] text-[#174D3B] text-[10px] font-bold">{{ __('messages.how_step2_tag3') }}</span>
                        </div>
                    </div>
                </div>

                <!-- ==================== STAGE 3: DI DALAM KAWASAN SUCI ==================== -->
                <div class="group bg-white dark:bg-[#16352A] rounded-3xl overflow-hidden shadow-xs hover:shadow-lg border border-[#174D3B]/10 dark:border-white/10 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Photographic Header (Compact) -->
                        <div class="relative h-36 sm:h-40 bg-gray-900 overflow-hidden">
                            <img src="{{ asset('images/hero-candi-bentar.jpg') }}"
                                 alt="{{ __('messages.how_step3_title') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent"></div>
                            
                            <!-- Stage Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-[#174D3B]/90 backdrop-blur-xs text-white text-[10px] font-bold border border-white/20">
                                    <span>03</span>
                                    <span>•</span>
                                    <span>{{ __('messages.how_step3_badge') }}</span>
                                </span>
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <p class="text-[10px] font-medium text-[#DDF2DF]">Kesadaran Luhur & Harmoni</p>
                                <h3 class="text-base font-bold leading-snug text-white">
                                    {{ __('messages.how_step3_title') }}
                                </h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <p class="text-xs text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                                {{ __('messages.how_step3_desc') }}
                            </p>

                            <!-- Concrete Checklist -->
                            <div class="space-y-1.5 pt-2 border-t border-gray-100 dark:border-white/10 text-xs text-[#202A25] dark:text-[#F8F6EF]">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3.5 h-3.5 text-[#21845B] dark:text-[#34D399] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Tidak menginjak atau melangkahi canang sari</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3.5 h-3.5 text-[#21845B] dark:text-[#34D399] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Menjaga ketaksuan & keharmonisan Tri Hita Karana</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Tags -->
                    <div class="p-5 sm:p-6 pt-0">
                        <div class="pt-3 border-t border-gray-100 dark:border-white/10 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step3_tag1') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step3_tag2') }}</span>
                            <span class="px-2 py-0.5 rounded-lg bg-[#DDF2DF]/70 dark:bg-white/10 text-[#174D3B] dark:text-[#DDF2DF] text-[10px] font-semibold">{{ __('messages.how_step3_tag3') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 5. AI ASSISTANT CTA SECTION (PREMIUM INTERACTIVE REDESIGN) ==================== -->
    <section id="ai-assistant" class="py-16 sm:py-20 bg-[#174D3B] text-white relative overflow-hidden">
        <!-- Ambient lighting elements -->
        <div class="absolute -right-32 -top-32 w-[500px] h-[500px] rounded-full bg-[#21845B]/25 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-32 -bottom-32 w-[500px] h-[500px] rounded-full bg-[#C6A15B]/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
                <!-- Left Column: Value Proposition & Interactive Destination Selectors (Span 5) -->
                <div class="lg:col-span-5 space-y-5">
                    <div>
                        <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 text-[#DDF2DF] text-[11px] font-bold tracking-wider uppercase backdrop-blur-xs mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#21845B]"></span>
                            <span>{{ __('messages.cta_eyebrow') }}</span>
                        </span>
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white tracking-tight leading-tight">
                            {{ __('messages.cta_heading_1') }}<br>
                            <span class="text-[#DDF2DF]">{{ __('messages.cta_heading_2') }}</span>
                        </h2>
                    </div>

                    <p class="text-xs sm:text-sm text-white/80 leading-relaxed">
                        {{ __('messages.cta_desc') }}
                    </p>

                    <!-- Interactive Destination Selector Pills -->
                    <div class="space-y-2.5 pt-1">
                        <p class="text-[11px] font-bold text-[#C6A15B] uppercase tracking-wider">Pilih Simulasi Kasus Destinasi:</p>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" class="cta-tab-btn active p-2.5 rounded-xl bg-[#21845B] text-white text-left transition-all duration-200 border border-white/20 hover:scale-[1.02]" data-tab="besakih">
                                <span class="text-[9px] text-white/70 block uppercase font-mono">Kawasan Suci</span>
                                <span class="text-xs font-bold block truncate">Pura Besakih</span>
                            </button>
                            <button type="button" class="cta-tab-btn p-2.5 rounded-xl bg-white/10 text-white/80 text-left transition-all duration-200 border border-white/10 hover:bg-white/15 hover:scale-[1.02]" data-tab="penglipuran">
                                <span class="text-[9px] text-white/70 block uppercase font-mono">Desa Adat</span>
                                <span class="text-xs font-bold block truncate">Desa Penglipuran</span>
                            </button>
                            <button type="button" class="cta-tab-btn p-2.5 rounded-xl bg-white/10 text-white/80 text-left transition-all duration-200 border border-white/10 hover:bg-white/15 hover:scale-[1.02]" data-tab="jatiluwih">
                                <span class="text-[9px] text-white/70 block uppercase font-mono">UNESCO Subak</span>
                                <span class="text-xs font-bold block truncate">Sawah Jatiluwih</span>
                            </button>
                            <button type="button" class="cta-tab-btn p-2.5 rounded-xl bg-white/10 text-white/80 text-left transition-all duration-200 border border-white/10 hover:bg-white/15 hover:scale-[1.02]" data-tab="uluwatu">
                                <span class="text-[9px] text-white/70 block uppercase font-mono">Tebing & Seni</span>
                                <span class="text-xs font-bold block truncate">Pura Uluwatu</span>
                            </button>
                        </div>
                    </div>

                    <!-- Trust Stats & Direct CTA Button -->
                    <div class="pt-3 space-y-3.5">
                        <div class="flex items-center space-x-4 sm:space-x-6 text-[11px] sm:text-xs text-white/70 pb-3 border-b border-white/10">
                            <div>
                                <span class="font-extrabold text-white text-xs sm:text-sm block">Google Gemini</span>
                                <span class="text-[10px] text-white/60">Flash AI Model</span>
                            </div>
                            <div class="h-5 w-px bg-white/20"></div>
                            <div>
                                <span class="font-extrabold text-white text-xs sm:text-sm block">RAG Grounded</span>
                                <span class="text-[10px] text-white/60">SE Gubernur & Adat</span>
                            </div>
                            <div class="h-5 w-px bg-white/20"></div>
                            <div>
                                <span class="font-extrabold text-white text-xs sm:text-sm block">Multibahasa</span>
                                <span class="text-[10px] text-white/60">ID & English</span>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('santi.index') }}"
                               id="cta-dynamic-chat-btn"
                               class="w-full sm:w-auto inline-flex items-center justify-center space-x-2.5 px-6 py-3 rounded-xl bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-extrabold text-xs sm:text-sm shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300">
                                <span>{{ __('messages.cta_btn') }}</span>
                                <svg class="w-4 h-4 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Smartphone Device Mockup (Span 7) -->
                <div class="lg:col-span-7 flex justify-center lg:justify-end">
                    <div class="w-full max-w-md bg-[#0e2c21] rounded-[2rem] p-3.5 sm:p-4 shadow-xl border-4 border-white/15 relative">
                        <!-- Device Top Island / Speaker -->
                        <div class="flex items-center justify-between px-3 pb-2.5 mb-2.5 border-b border-white/10 text-xs text-white/70">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-[#21845B] flex items-center justify-center text-white font-bold text-[10px]">
                                    S
                                </div>
                                <div>
                                    <span class="font-bold text-white text-[11px] sm:text-xs block leading-tight">Santi Cultural Assistant</span>
                                    <span class="text-[9px] text-[#21845B] font-medium flex items-center space-x-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#21845B]"></span>
                                        <span>Aktif • Terverifikasi Resmi</span>
                                    </span>
                                </div>
                            </div>
                            <span id="cta-device-badge" class="px-2 py-0.5 rounded-full bg-white/10 text-[9px] sm:text-[10px] font-bold text-[#DDF2DF]">
                                📍 Pura Agung Besakih
                            </span>
                        </div>

                        <!-- Chat Simulation Screen Window -->
                        <div class="bg-[#174D3B]/70 rounded-xl p-3 sm:p-4 space-y-3 min-h-[300px] flex flex-col justify-between border border-white/10">
                            <!-- Messages Area -->
                            <div class="space-y-3">
                                <!-- Greeting from Santi -->
                                <div class="flex items-start space-x-2">
                                    <div class="w-5 h-5 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[9px] mt-0.5 shadow-xs">
                                        S
                                    </div>
                                    <div class="bg-white/10 p-2.5 sm:p-3 rounded-xl rounded-tl-xs text-xs text-white/90 leading-relaxed max-w-[88%] border border-white/10">
                                        Om Swastiastu! Selamat datang di Bali. Saya Santi, asisten pemandu budaya virtual Anda. Ada yang ingin ditanyakan sebelum memasuki destinasi?
                                    </div>
                                </div>

                                <!-- Dynamic Tab Panes -->
                                <!-- Pane 1: Besakih -->
                                <div id="cta-pane-besakih" class="cta-pane space-y-3">
                                    <div class="flex items-start justify-end">
                                        <div class="bg-[#21845B] text-white p-2.5 sm:p-3 rounded-xl rounded-tr-xs text-xs leading-relaxed max-w-[85%] shadow-xs">
                                            Bolehkah wisatawan memasuki pelataran Utama Mandala (Jeroan) di Pura Agung Besakih?
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <div class="w-5 h-5 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[9px] mt-0.5 shadow-xs">
                                            S
                                        </div>
                                        <div class="bg-white/10 p-2.5 sm:p-3 rounded-xl rounded-tl-xs text-xs text-white/95 leading-relaxed max-w-[88%] border border-white/10 space-y-1.5">
                                            <p>Area <strong>Utama Mandala (Jeroan)</strong> khusus diperuntukkan bagi umat Hindu yang melaksanakan ibadah persembahyangan suci.</p>
                                            <p class="text-white/80">Wisatawan dipersilakan mengagumi arsitektur pura dari batas <em>Jaba Tengah</em> didampingi pemandu berlisensi dan mengenakan kamen serta senteng rapi.</p>
                                            <div class="pt-1.5 border-t border-white/10 text-[9px] sm:text-[10px] text-[#DDF2DF] flex items-center justify-between">
                                                <span>Sumber: Awig-Awig Desa Adat Besakih</span>
                                                <span class="text-[#C6A15B]">✓ Terverifikasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pane 2: Penglipuran -->
                                <div id="cta-pane-penglipuran" class="cta-pane hidden space-y-3">
                                    <div class="flex items-start justify-end">
                                        <div class="bg-[#21845B] text-white p-2.5 sm:p-3 rounded-xl rounded-tr-xs text-xs leading-relaxed max-w-[85%] shadow-xs">
                                            Bagaimana etika saat saya ingin memotret dan masuk ke pekarangan rumah warga di Penglipuran?
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <div class="w-5 h-5 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[9px] mt-0.5 shadow-xs">
                                            S
                                        </div>
                                        <div class="bg-white/10 p-2.5 sm:p-3 rounded-xl rounded-tl-xs text-xs text-white/95 leading-relaxed max-w-[88%] border border-white/10 space-y-1.5">
                                            <p>Saat melintasi gerbang <strong>angkul-angkul</strong> ke pekarangan warga, ucapkan salam <em>"Om Swastiastu"</em> dengan ramah dan mintalah izin santun sebelum memotret.</p>
                                            <p class="text-white/80">Pakaian wajib sopan menutup bahu dan paha. Dilarang merokok di jalur desa dan dilarang memasuki area suci sanggah (pura keluarga) tanpa seizin pemilik rumah.</p>
                                            <div class="pt-1.5 border-t border-white/10 text-[9px] sm:text-[10px] text-[#DDF2DF] flex items-center justify-between">
                                                <span>Sumber: Awig-Awig Adat Penglipuran</span>
                                                <span class="text-[#C6A15B]">✓ Terverifikasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pane 3: Jatiluwih -->
                                <div id="cta-pane-jatiluwih" class="cta-pane hidden space-y-3">
                                    <div class="flex items-start justify-end">
                                        <div class="bg-[#21845B] text-white p-2.5 sm:p-3 rounded-xl rounded-tr-xs text-xs leading-relaxed max-w-[85%] shadow-xs">
                                            Apakah ada aturan khusus saat melintasi pematang sawah dan saluran air di Jatiluwih?
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <div class="w-5 h-5 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[9px] mt-0.5 shadow-xs">
                                            S
                                        </div>
                                        <div class="bg-white/10 p-2.5 sm:p-3 rounded-xl rounded-tl-xs text-xs text-white/95 leading-relaxed max-w-[88%] border border-white/10 space-y-1.5">
                                            <p>Sistem <strong>Subak Jatiluwih (UNESCO)</strong> disucikan berdasarkan filosofi <em>Tri Hita Karana</em>. Harap berjalan hanya di jalur setapak trekking resmi dan tidak menginjak tanaman padi.</p>
                                            <p class="text-white/80">Dilarang memanjat pelinggih Pura Bedugul di petak sawah dan wajib membawa kembali sampah anorganik masing-masing (kawasan bebas sampah plastik).</p>
                                            <div class="pt-1.5 border-t border-white/10 text-[9px] sm:text-[10px] text-[#DDF2DF] flex items-center justify-between">
                                                <span>Sumber: Badan Pengelola UNESCO Jatiluwih</span>
                                                <span class="text-[#C6A15B]">✓ Terverifikasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pane 4: Uluwatu -->
                                <div id="cta-pane-uluwatu" class="cta-pane hidden space-y-3">
                                    <div class="flex items-start justify-end">
                                        <div class="bg-[#21845B] text-white p-2.5 sm:p-3 rounded-xl rounded-tr-xs text-xs leading-relaxed max-w-[85%] shadow-xs">
                                            Bagaimana etika dokumentasi dan fotografi saat pementasan Tari Kecak di tebing Uluwatu?
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <div class="w-5 h-5 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[9px] mt-0.5 shadow-xs">
                                            S
                                        </div>
                                        <div class="bg-white/10 p-2.5 sm:p-3 rounded-xl rounded-tl-xs text-xs text-white/95 leading-relaxed max-w-[88%] border border-white/10 space-y-1.5">
                                            <p>Fotografi diperbolehkan dari area tribun penonton tanpa menyalakan lampu kilat (flash) langsung ke mata penari.</p>
                                            <p class="text-white/80">Pengoperasian drone di atas area pementasan dan tebing pura dilarang keras tanpa izin tertulis dari Badan Pengelola Kawasan Luar Pura Uluwatu.</p>
                                            <div class="pt-1.5 border-t border-white/10 text-[9px] sm:text-[10px] text-[#DDF2DF] flex items-center justify-between">
                                                <span>Sumber: Regulasi Pengelola Pura Uluwatu</span>
                                                <span class="text-[#C6A15B]">✓ Terverifikasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Input Simulation Bar -->
                            <div class="pt-2.5 border-t border-white/10">
                                <a href="{{ route('santi.index') }}" id="cta-input-link" class="flex items-center justify-between px-3 py-2 rounded-lg bg-white/10 hover:bg-white/15 border border-white/15 text-[11px] sm:text-xs text-white/70 transition-colors">
                                    <span>Tanya Santi seputar adat di destinasi ini...</span>
                                    <div class="w-5 h-5 rounded-md bg-[#21845B] flex items-center justify-center text-white">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ==================== SECTION 3: PROMPT PILLS INTERACTION ====================
        const servicePromptBtns = document.querySelectorAll('.service-prompt-btn');
        const serviceSampleQ = document.getElementById('service-sample-question');
        const serviceSampleA = document.getElementById('service-sample-answer');
        const serviceSampleSrc = document.getElementById('service-sample-source');

        servicePromptBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const q = btn.getAttribute('data-q');
                const a = btn.getAttribute('data-a');
                const src = btn.getAttribute('data-src');

                // Update active pill styling
                servicePromptBtns.forEach(b => {
                    b.classList.remove('bg-white/25', 'text-white', 'border-white/30');
                    b.classList.add('bg-white/10', 'text-white/90', 'border-white/15');
                });
                btn.classList.add('bg-white/25', 'text-white', 'border-white/30');
                btn.classList.remove('bg-white/10', 'text-white/90', 'border-white/15');

                // Update simulated text
                if (serviceSampleQ) serviceSampleQ.textContent = `"${q}"`;
                if (serviceSampleA) serviceSampleA.textContent = a;
                if (serviceSampleSrc) serviceSampleSrc.textContent = `Sumber: ${src}`;
            });
        });

        // ==================== SECTION 5: AI ASSISTANT DESTINATION TABS ====================
        const tabBtns = document.querySelectorAll('.cta-tab-btn');
        const panes = document.querySelectorAll('.cta-pane');
        const chatBtn = document.getElementById('cta-dynamic-chat-btn');
        const inputLink = document.getElementById('cta-input-link');
        const deviceBadge = document.getElementById('cta-device-badge');

        const tabData = {
            'besakih': {
                'slug': 'pura-besakih',
                'badge': 'Pura Agung Besakih'
            },
            'penglipuran': {
                'slug': 'desa-penglipuran',
                'badge': 'Desa Wisata Penglipuran'
            },
            'jatiluwih': {
                'slug': 'jatiluwih-rice-terraces',
                'badge': 'Subak Jatiluwih (UNESCO)'
            },
            'uluwatu': {
                'slug': 'pura-uluwatu',
                'badge': 'Pura Luhur Uluwatu'
            }
        };

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');

                // Update active tab buttons styling
                tabBtns.forEach(b => {
                    b.classList.remove('bg-[#21845B]', 'text-white', 'border-white/20');
                    b.classList.add('bg-white/10', 'text-white/80', 'border-white/10');
                });
                btn.classList.add('bg-[#21845B]', 'text-white', 'border-white/20');
                btn.classList.remove('bg-white/10', 'text-white/80', 'border-white/10');

                // Update dynamic panes
                panes.forEach(p => p.classList.add('hidden'));
                const activePane = document.getElementById(`cta-pane-${targetTab}`);
                if (activePane) {
                    activePane.classList.remove('hidden');
                }

                // Update CTA button URL & Device Badge
                if (tabData[targetTab]) {
                    const targetSlug = tabData[targetTab].slug;
                    if (chatBtn) chatBtn.href = `/santi/${targetSlug}`;
                    if (inputLink) inputLink.href = `/santi/${targetSlug}`;
                    if (deviceBadge) deviceBadge.textContent = tabData[targetTab].badge;
                }
            });
        });
    });
</script>
@endpush
@endsection
