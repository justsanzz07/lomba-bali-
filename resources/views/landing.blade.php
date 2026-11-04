@extends('layouts.app')

@section('title', 'SANTI — AI Cultural Guardian Bali | ' . __('messages.hero_title_1') . ' ' . __('messages.hero_title_2'))

@section('content')
    <!-- ==================== 1. HERO SECTION ==================== -->
    <section id="hero" class="relative min-h-[92vh] lg:min-h-screen flex items-center justify-center text-white overflow-hidden bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('images/hero-candi-bentar.jpg') }}'), url('{{ asset('images/hero-bali.jpg') }}');">
        <!-- Dark Transparent Atmospheric Overlay for Readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/45 to-[#174D3B]/90"></div>
        <div class="absolute inset-0 bg-black/25"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-32 pb-24 text-center flex flex-col items-center justify-center space-y-6">
            <!-- Top Tag / Eyebrow Badge -->
            <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-md">
                <span class="text-xs uppercase tracking-widest font-semibold text-[#DDF2DF]">{{ __('messages.hero_eyebrow') }}</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-white leading-tight max-w-4xl drop-shadow-sm">
                {{ __('messages.hero_title_1') }}<br>
                {{ __('messages.hero_title_2') }}
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-white/90 leading-relaxed font-normal max-w-2xl mx-auto drop-shadow-xs">
                {{ __('messages.hero_subtitle') }}
            </p>

            <!-- Centered Action Buttons -->
            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
                <a href="{{ route('santi.show', 'pura-besakih') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-8 py-3.5 rounded-full bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-bold text-sm shadow-lg hover:shadow-xl transition-all duration-200">
                    <span>{{ __('messages.hero_cta_primary') }}</span>
                    <svg class="w-4 h-4 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

                <a href="#services"
                   class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-7 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-medium text-sm backdrop-blur-md border border-white/25 transition-all duration-200">
                    <span>{{ __('messages.hero_cta_secondary') }}</span>
                </a>
            </div>

            <!-- Two Floating Information Cards Near Bottom of Hero -->
            <div class="pt-12 w-full max-w-3xl grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <!-- Floating Card 1 -->
                <div class="glass-card-dark p-4 sm:p-5 rounded-2xl flex items-start space-x-3.5 hover:border-white/30 transition-colors shadow-lg">
                    <div class="w-10 h-10 rounded-xl bg-[#21845B]/60 text-white flex-shrink-0 flex items-center justify-center mt-0.5 border border-white/10">
                        <svg class="w-5 h-5 text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-white">{{ __('messages.hero_card1_title') }}</h4>
                            <svg class="w-3.5 h-3.5 text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-[#DDF2DF]/80 mt-1 leading-relaxed">
                            {{ __('messages.hero_card1_desc') }}
                        </p>
                    </div>
                </div>

                <!-- Floating Card 2 -->
                <div class="glass-card-dark p-4 sm:p-5 rounded-2xl flex items-start space-x-3.5 hover:border-white/30 transition-colors shadow-lg">
                    <div class="w-10 h-10 rounded-xl bg-[#21845B]/60 text-white flex-shrink-0 flex items-center justify-center mt-0.5 border border-white/10">
                        <svg class="w-5 h-5 text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-white">{{ __('messages.hero_card2_title') }}</h4>
                            <svg class="w-3.5 h-3.5 text-[#DDF2DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-[#DDF2DF]/80 mt-1 leading-relaxed">
                            {{ __('messages.hero_card2_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 2. ABOUT SECTION ==================== -->
    <section id="about" class="py-24 bg-[#F8F6EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Side: Text Content -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-block px-3 py-1 rounded-full bg-[#DDF2DF] text-[#174D3B] text-xs font-bold tracking-wider uppercase">
                        {{ __('messages.about_label') }}
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#174D3B] tracking-tight leading-tight">
                        {{ __('messages.about_heading') }}
                    </h2>

                    <div class="space-y-4 text-sm sm:text-base text-[#202A25]/80 leading-relaxed font-normal">
                        <p>
                            {{ __('messages.about_p1') }}
                        </p>
                        <p>
                            {{ __('messages.about_p2') }}
                        </p>
                    </div>

                    <!-- Factual Cultural Alignment Point -->
                    <div class="pt-2 text-xs font-semibold text-[#174D3B] flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-[#21845B]"></span>
                        <span>{{ __('messages.about_highlight') }}</span>
                    </div>

                    <!-- CTA Button -->
                    <div class="pt-4">
                        <a href="#services"
                           class="inline-flex items-center space-x-2 px-6 py-3 rounded-full bg-[#DDF2DF] hover:bg-[#c9e8cd] text-[#174D3B] text-xs font-bold transition-colors">
                            <span>{{ __('messages.about_cta') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Large Image with Overlapping Floating Cards -->
                <div class="lg:col-span-6 relative">
                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                        <!-- Main Photograph -->
                        <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-[4/4.5] bg-gray-200">
                            <img src="{{ asset('images/about-bali-guide.jpg') }}"
                                 alt="Balinese Cultural Heritage Guide"
                                 class="w-full h-full object-cover"
                                 onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                        </div>

                        <!-- Floating Information Card 1 (Top Right) -->
                        <div class="absolute -top-6 -right-2 sm:-right-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 max-w-[210px] space-y-1">
                            <div class="flex items-center space-x-1.5">
                                <span class="text-xl font-extrabold text-[#174D3B]">{{ __('messages.about_badge_247') }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded bg-[#DDF2DF] text-[#174D3B]">{{ __('messages.about_badge_assistance') }}</span>
                            </div>
                            <p class="text-[11px] text-[#737B75] leading-tight">
                                {{ __('messages.about_badge_desc1') }}
                            </p>
                        </div>

                        <!-- Floating Information Card 2 (Bottom Left / Bottom Right) -->
                        <div class="absolute -bottom-6 -left-2 sm:-left-6 bg-white p-4 sm:p-5 rounded-2xl shadow-xl border border-gray-100 max-w-[230px] space-y-1.5">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 rounded-full bg-[#21845B]"></div>
                                <h4 class="font-bold text-xs text-[#174D3B]">{{ __('messages.about_badge_multilingual') }}</h4>
                            </div>
                            <p class="text-[11px] text-[#737B75] leading-tight">
                                {{ __('messages.about_badge_desc2') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 3. CULTURAL SERVICES SECTION ==================== -->
    <section id="services" class="py-24 bg-white border-t border-[#174D3B]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Row: Label & Main Heading on Left, Description on Right -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <span class="inline-block px-3 py-1 rounded-full bg-[#DDF2DF] text-[#174D3B] text-xs font-bold tracking-wider uppercase mb-3">
                        {{ __('messages.services_label') }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#174D3B] tracking-tight">
                        {{ __('messages.services_heading') }}
                    </h2>
                </div>
                <div class="max-w-md">
                    <p class="text-sm text-[#737B75] leading-relaxed">
                        {{ __('messages.services_desc') }}
                    </p>
                </div>
            </div>

            <!-- Three Large Image Cards with Consistent Height & Rounded Corners -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- CARD 1: AI Cultural Assistant -->
                <div class="group relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-end min-h-[420px] bg-gray-900 border border-gray-100">
                    <img src="{{ asset('images/service-ai-chat.jpg') }}"
                         alt="{{ __('messages.services_card1_title') }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/45 to-transparent"></div>

                    <div class="relative p-6 sm:p-7 text-white space-y-2 z-10 flex flex-col justify-between h-full">
                        <div class="flex justify-end">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md bg-white/20 backdrop-blur-md">{{ __('messages.services_badge_interactive') }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1.5 group-hover:text-[#DDF2DF] transition-colors">
                                {{ __('messages.services_card1_title') }}
                            </h3>
                            <p class="text-xs text-white/80 leading-relaxed mb-4">
                                {{ __('messages.services_card1_desc') }}
                            </p>
                            <div class="flex items-center justify-between pt-2 border-t border-white/20">
                                <a href="{{ route('santi.show', 'pura-besakih') }}" class="text-xs font-bold text-white hover:text-[#DDF2DF] transition-colors">
                                    {{ __('messages.services_card1_cta') }}
                                </a>
                                <a href="{{ route('santi.show', 'pura-besakih') }}" class="w-8 h-8 rounded-full bg-white text-[#174D3B] flex items-center justify-center group-hover:bg-[#DDF2DF] transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Cultural Guidelines -->
                <div class="group relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-end min-h-[420px] bg-gray-900 border border-gray-100">
                    <img src="{{ asset('images/service-guidelines.jpg') }}"
                         alt="{{ __('messages.services_card2_title') }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/45 to-transparent"></div>

                    <div class="relative p-6 sm:p-7 text-white space-y-2 z-10 flex flex-col justify-between h-full">
                        <div class="flex justify-end">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md bg-white/20 backdrop-blur-md">{{ __('messages.services_badge_etiquette') }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1.5 group-hover:text-[#DDF2DF] transition-colors">
                                {{ __('messages.services_card2_title') }}
                            </h3>
                            <p class="text-xs text-white/80 leading-relaxed mb-4">
                                {{ __('messages.services_card2_desc') }}
                            </p>
                            <div class="flex items-center justify-between pt-2 border-t border-white/20">
                                <a href="{{ route('locations.index') }}" class="text-xs font-bold text-white hover:text-[#DDF2DF] transition-colors">
                                    {{ __('messages.services_card2_cta') }}
                                </a>
                                <a href="{{ route('locations.index') }}" class="w-8 h-8 rounded-full bg-white text-[#174D3B] flex items-center justify-center group-hover:bg-[#DDF2DF] transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Location-Based Guidance -->
                <div class="group relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-end min-h-[420px] bg-gray-900 border border-gray-100">
                    <img src="{{ asset('images/service-location.jpg') }}"
                         alt="{{ __('messages.services_card3_title') }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/hero-bali.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/45 to-transparent"></div>

                    <div class="relative p-6 sm:p-7 text-white space-y-2 z-10 flex flex-col justify-between h-full">
                        <div class="flex justify-end">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md bg-white/20 backdrop-blur-md">{{ __('messages.services_badge_context') }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1.5 group-hover:text-[#DDF2DF] transition-colors">
                                {{ __('messages.services_card3_title') }}
                            </h3>
                            <p class="text-xs text-white/80 leading-relaxed mb-4">
                                {{ __('messages.services_card3_desc') }}
                            </p>
                            <div class="flex items-center justify-between pt-2 border-t border-white/20">
                                <a href="{{ route('locations.index') }}" class="text-xs font-bold text-white hover:text-[#DDF2DF] transition-colors">
                                    {{ __('messages.services_card3_cta') }}
                                </a>
                                <a href="{{ route('locations.index') }}" class="w-8 h-8 rounded-full bg-white text-[#174D3B] flex items-center justify-center group-hover:bg-[#DDF2DF] transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered Button Below the Cards -->
            <div class="text-center mt-12">
                <a href="{{ route('locations.index') }}"
                   class="inline-flex items-center space-x-2 px-8 py-3.5 rounded-full bg-[#DDF2DF] hover:bg-[#c9e8cd] text-[#174D3B] text-xs font-bold tracking-wider uppercase transition-colors shadow-sm">
                    <span>{{ __('messages.services_explore_all') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ==================== 4. HOW IT WORKS SECTION ==================== -->
    <section id="how-it-works" class="py-24 bg-[#F8F6EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="inline-block px-3 py-1 rounded-full bg-[#DDF2DF] text-[#174D3B] text-xs font-bold tracking-wider uppercase">
                    {{ __('messages.how_label') }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#174D3B] tracking-tight">
                    {{ __('messages.how_heading') }}
                </h2>
                <p class="text-sm text-[#737B75] leading-relaxed">
                    {{ __('messages.how_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 01 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#DDF2DF] text-[#174D3B] font-extrabold text-sm flex items-center justify-center mb-6">
                            01
                        </div>
                        <h3 class="font-bold text-base text-[#174D3B] mb-2.5">{{ __('messages.how_step1_title') }}</h3>
                        <p class="text-xs text-[#737B75] leading-relaxed">
                            {{ __('messages.how_step1_desc') }}
                        </p>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#174D3B] text-white font-extrabold text-sm flex items-center justify-center mb-6">
                            02
                        </div>
                        <h3 class="font-bold text-base text-[#174D3B] mb-2.5">{{ __('messages.how_step2_title') }}</h3>
                        <p class="text-xs text-[#737B75] leading-relaxed">
                            {{ __('messages.how_step2_desc') }}
                        </p>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#21845B] text-white font-extrabold text-sm flex items-center justify-center mb-6">
                            03
                        </div>
                        <h3 class="font-bold text-base text-[#174D3B] mb-2.5">{{ __('messages.how_step3_title') }}</h3>
                        <p class="text-xs text-[#737B75] leading-relaxed">
                            {{ __('messages.how_step3_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 5. AI ASSISTANT CTA SECTION ==================== -->
    <section id="ai-assistant" class="py-24 bg-[#174D3B] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-white/10 text-[#DDF2DF] text-xs font-semibold tracking-wider">
                {{ __('messages.cta_eyebrow') }}
            </span>

            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                {{ __('messages.cta_heading_1') }}<br>
                {{ __('messages.cta_heading_2') }}
            </h2>

            <p class="text-sm sm:text-base text-white/85 max-w-xl mx-auto leading-relaxed">
                {{ __('messages.cta_desc') }}
            </p>

            <div>
                <a href="{{ route('santi.show', 'pura-besakih') }}"
                   class="inline-flex items-center space-x-2 px-8 py-4 rounded-full bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-bold text-sm shadow-xl hover:shadow-2xl transition-all duration-200">
                    <span>{{ __('messages.cta_btn') }}</span>
                    <svg class="w-4 h-4 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Interactive Live Chat Simulation Card (Matching Screenshot Preview) -->
            <div class="pt-8 max-w-2xl mx-auto text-left">
                <div class="p-5 sm:p-6 rounded-2xl bg-[#103327] border border-[#21845B]/60 shadow-2xl space-y-4">
                    <div class="flex items-center space-x-2 text-[11px] text-[#DDF2DF] font-semibold pb-2 border-b border-white/10">
                        <span class="w-2 h-2 rounded-full bg-[#21845B] animate-pulse"></span>
                        <span>{{ __('messages.cta_preview_badge') }}</span>
                    </div>

                    <!-- Santi Message -->
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#21845B] text-white flex-shrink-0 flex items-center justify-center font-bold text-[10px]">
                            S
                        </div>
                        <div class="bg-white/10 p-3.5 rounded-2xl rounded-tl-xs text-xs text-white/90 leading-relaxed max-w-[85%]">
                            {{ __('messages.cta_chat_greeting') }}
                        </div>
                    </div>

                    <!-- User Question -->
                    <div class="flex items-start justify-end space-x-3">
                        <div class="bg-[#21845B] text-white p-3 rounded-2xl rounded-tr-xs text-xs leading-relaxed max-w-[80%]">
                            {{ __('messages.cta_chat_user') }}
                        </div>
                    </div>

                    <!-- Santi Answer -->
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#21845B] text-white flex-shrink-0 flex items-center justify-center font-bold text-[10px]">
                            S
                        </div>
                        <div class="bg-white/10 p-3.5 rounded-2xl rounded-tl-xs text-xs text-white/90 leading-relaxed max-w-[85%]">
                            {{ __('messages.cta_chat_answer') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
