@extends('layouts.app')

@section('title', $location->name . ' — ' . __('messages.guide_page_title') . ' — SANTI')
@section('meta_description', 'Panduan adat resmi, etika berpakaian, zona suci, dan peraturan berkunjung di ' . $location->name . '. Dapatkan wawasan budaya terverifikasi sebelum berkunjung.')

@section('content')
<div class="pt-28 pb-20 bg-[#F8F6EF] dark:bg-[#0B1E17] min-h-screen text-[#202A25] dark:text-[#F8F6EF] transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Breadcrumb & Back Link -->
        <div class="mb-8">
            <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-[#174D3B] dark:text-[#A7D9B8] hover:text-[#21845B] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>{{ __('messages.guide_back_locations') }}</span>
            </a>
        </div>

        <!-- ==================== LOCATION HERO BANNER ==================== -->
        <div class="bg-white dark:bg-[#16352A] rounded-3xl shadow-sm border border-[#174D3B]/10 dark:border-white/10 overflow-hidden mb-12 transition-colors">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                <!-- Location Image (Left Column on Desktop) -->
                <div class="lg:col-span-5 relative min-h-[300px] lg:min-h-[420px] bg-gray-900">
                    <img src="{{ asset($locationImage) }}"
                         alt="{{ $location->name }}"
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent lg:hidden"></div>
                    <div class="absolute top-4 left-4 z-10">
                        @if($location->culturalRules->where('is_verified', true)->count() > 0)
                            <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-[#21845B] text-white shadow-md">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>{{ $location->culturalRules->where('is_verified', true)->count() }} {{ __('messages.guide_verified_official') }}</span>
                            </span>
                        @else
                            <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-500 text-white shadow-md">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span>{{ __('messages.guide_unverified_simulation') }}</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Location Details (Right Column on Desktop) -->
                <div class="lg:col-span-7 p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="text-[11px] font-mono uppercase tracking-wider text-[#21845B] bg-[#DDF2DF] dark:bg-[#21845B]/30 px-2.5 py-1 rounded-md font-bold">
                                {{ __('messages.guide_location_info') }}
                            </span>
                            <span class="text-[11px] font-mono text-gray-400 dark:text-gray-400">
                                /panduan/{{ $location->slug }}
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight mb-4">
                            {{ $location->name }}
                        </h1>

                        <p class="text-sm sm:text-base text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed mb-6">
                            {{ $location->description }}
                        </p>

                        @if($location->address)
                            <div class="flex items-start space-x-3 p-4 rounded-2xl bg-[#F8F6EF] dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] mb-6 transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-[#21845B]/10 dark:bg-[#21845B]/30 flex items-center justify-center flex-shrink-0 text-[#21845B] dark:text-[#34D399] mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-[11px] uppercase tracking-wider mb-0.5">{{ __('messages.guide_address') }}</div>
                                    <div class="text-[#5A6961] dark:text-[#C1D1C7]">{{ $location->address }}</div>
                                </div>
                            </div>
                        @endif

                        @if($location->culturalRules->where('is_verified', false)->count() > 0 && $location->culturalRules->where('is_verified', true)->count() == 0)
                            <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 text-amber-800 dark:text-amber-200 text-xs mb-6 flex items-start space-x-2.5">
                                <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p>{{ __('messages.guide_unverified_notice') }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Summary Metrics -->
                    <div class="pt-6 border-t border-gray-100 dark:border-white/10 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-6 text-xs text-[#5A6961] dark:text-[#C1D1C7]">
                            <div>
                                <span class="font-extrabold text-lg text-[#174D3B] dark:text-[#DDF2DF]">{{ $location->culturalRules->count() }}</span>
                                <span class="block text-[11px] text-gray-500 dark:text-gray-400">{{ __('messages.guide_rules_count') }}</span>
                            </div>
                            <div class="h-8 w-px bg-gray-200 dark:bg-white/10"></div>
                            <div>
                                <span class="font-extrabold text-lg text-[#21845B] dark:text-[#34D399]">{{ $location->culturalRules->where('is_verified', true)->count() }}</span>
                                <span class="block text-[11px] text-gray-500 dark:text-gray-400">{{ __('messages.guide_verified_tag') }}</span>
                            </div>
                        </div>

                        <!-- Direct anchor link to bottom AI assistant CTA -->
                        <a href="#tanya-santi-ai" class="inline-flex items-center space-x-2 text-xs font-bold text-[#21845B] dark:text-[#34D399] hover:text-[#174D3B] transition-colors">
                            <span>{{ __('messages.guide_cta_question') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== CATEGORIZED GUIDELINES & REGULATIONS ==================== -->
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="inline-block px-3 py-1 rounded-full bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold tracking-wider uppercase mb-2">
                    {{ __('messages.services_label') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">
                    {{ __('messages.guide_page_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-[#5A6961] dark:text-[#C1D1C7] mt-2">
                    {{ __('messages.hero_subtitle') }}
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="space-y-8">
                <!-- 1. ATURAN BERPAKAIAN (DRESS CODE) -->
                @if($rulesByCategory['dress_code']->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-6 sm:p-8 shadow-sm border border-[#174D3B]/10 dark:border-white/10 transition-colors">
                        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-100 dark:border-white/10">
                            <div class="w-10 h-10 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center font-bold">
                                👗
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                                    {{ __('messages.cat_dress_code') }}
                                </h3>
                                <p class="text-xs text-[#737B75] dark:text-[#A7B9AF]">{{ __('messages.services_card2_desc') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($rulesByCategory['dress_code'] as $rule)
                                <div class="p-5 rounded-2xl bg-[#F8F6EF]/70 dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 transition-colors flex flex-col justify-between">
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2 py-0.5 rounded-md {{ $rule->is_verified ? 'bg-[#21845B]/15 text-[#21845B] dark:bg-[#21845B]/30 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF]">
                                            {{ $rule->title }}
                                        </h4>

                                        <p class="text-xs text-[#202A25] dark:text-[#E2EBE5] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>
                                    </div>

                                    @if($rule->source_name)
                                        <div class="pt-4 mt-3 border-t border-gray-200/60 dark:border-white/10 text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                            <span class="truncate pr-2">
                                                <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                            </span>
                                            @if($rule->source_url)
                                                <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 2. KAWASAN SUCI & BATASAN MANDALA (SACRED AREA) -->
                @if($rulesByCategory['sacred_area']->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-6 sm:p-8 shadow-sm border border-[#174D3B]/10 dark:border-white/10 transition-colors">
                        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-100 dark:border-white/10">
                            <div class="w-10 h-10 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center font-bold">
                                ⛩️
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                                    {{ __('messages.cat_sacred_area') }}
                                </h3>
                                <p class="text-xs text-[#737B75] dark:text-[#A7B9AF]">{{ __('messages.hero_card2_desc') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($rulesByCategory['sacred_area'] as $rule)
                                <div class="p-5 rounded-2xl bg-[#F8F6EF]/70 dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 transition-colors flex flex-col justify-between">
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2 py-0.5 rounded-md {{ $rule->is_verified ? 'bg-[#21845B]/15 text-[#21845B] dark:bg-[#21845B]/30 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF]">
                                            {{ $rule->title }}
                                        </h4>

                                        <p class="text-xs text-[#202A25] dark:text-[#E2EBE5] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>
                                    </div>

                                    @if($rule->source_name)
                                        <div class="pt-4 mt-3 border-t border-gray-200/60 dark:border-white/10 text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                            <span class="truncate pr-2">
                                                <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                            </span>
                                            @if($rule->source_url)
                                                <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 3. TATA KRAMA, PERILAKU & LARANGAN ADAT (BEHAVIOR & PROHIBITIONS) -->
                @if($rulesByCategory['behavior']->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-6 sm:p-8 shadow-sm border border-[#174D3B]/10 dark:border-white/10 transition-colors">
                        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-100 dark:border-white/10">
                            <div class="w-10 h-10 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center font-bold">
                                ✋
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                                    {{ __('messages.cat_behavior') }}
                                </h3>
                                <p class="text-xs text-[#737B75] dark:text-[#A7B9AF]">{{ __('messages.about_p2') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($rulesByCategory['behavior'] as $rule)
                                <div class="p-5 rounded-2xl bg-[#F8F6EF]/70 dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 transition-colors flex flex-col justify-between">
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2 py-0.5 rounded-md {{ $rule->is_verified ? 'bg-[#21845B]/15 text-[#21845B] dark:bg-[#21845B]/30 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF]">
                                            {{ $rule->title }}
                                        </h4>

                                        <p class="text-xs text-[#202A25] dark:text-[#E2EBE5] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>
                                    </div>

                                    @if($rule->source_name)
                                        <div class="pt-4 mt-3 border-t border-gray-200/60 dark:border-white/10 text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                            <span class="truncate pr-2">
                                                <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                            </span>
                                            @if($rule->source_url)
                                                <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. ETIKA FOTOGRAFI & DRONE (PHOTOGRAPHY) -->
                @if($rulesByCategory['photography']->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-6 sm:p-8 shadow-sm border border-[#174D3B]/10 dark:border-white/10 transition-colors">
                        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-100 dark:border-white/10">
                            <div class="w-10 h-10 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center font-bold">
                                📸
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                                    {{ __('messages.cat_photography') }}
                                </h3>
                                <p class="text-xs text-[#737B75] dark:text-[#A7B9AF]">{{ __('messages.services_card1_desc') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($rulesByCategory['photography'] as $rule)
                                <div class="p-5 rounded-2xl bg-[#F8F6EF]/70 dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 transition-colors flex flex-col justify-between">
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2 py-0.5 rounded-md {{ $rule->is_verified ? 'bg-[#21845B]/15 text-[#21845B] dark:bg-[#21845B]/30 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF]">
                                            {{ $rule->title }}
                                        </h4>

                                        <p class="text-xs text-[#202A25] dark:text-[#E2EBE5] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>
                                    </div>

                                    @if($rule->source_name)
                                        <div class="pt-4 mt-3 border-t border-gray-200/60 dark:border-white/10 text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                            <span class="truncate pr-2">
                                                <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                            </span>
                                            @if($rule->source_url)
                                                <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 5. KETENTUAN UMUM LAINNYA (GENERAL) -->
                @if($rulesByCategory['general']->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-6 sm:p-8 shadow-sm border border-[#174D3B]/10 dark:border-white/10 transition-colors">
                        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-100 dark:border-white/10">
                            <div class="w-10 h-10 rounded-2xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center font-bold">
                                📋
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                                    {{ __('messages.cat_general') }}
                                </h3>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($rulesByCategory['general'] as $rule)
                                <div class="p-5 rounded-2xl bg-[#F8F6EF]/70 dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/40 transition-colors flex flex-col justify-between">
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2 py-0.5 rounded-md {{ $rule->is_verified ? 'bg-[#21845B]/15 text-[#21845B] dark:bg-[#21845B]/30 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF]">
                                            {{ $rule->title }}
                                        </h4>

                                        <p class="text-xs text-[#202A25] dark:text-[#E2EBE5] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>
                                    </div>

                                    @if($rule->source_name)
                                        <div class="pt-4 mt-3 border-t border-gray-200/60 dark:border-white/10 text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                            <span class="truncate pr-2">
                                                <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                            </span>
                                            @if($rule->source_url)
                                                <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- ==================== 6 & 7. BOTTOM CTA: MASIH ADA PERTANYAAN? TANYA SANTI AI ==================== -->
        <section id="tanya-santi-ai" class="mb-16">
            <div class="relative rounded-3xl overflow-hidden bg-[#174D3B] text-white p-8 sm:p-12 shadow-xl border border-white/10">
                <!-- Background decorative elements -->
                <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-[#21845B]/30 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-[#C6A15B]/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-3xl mx-auto text-center space-y-6">
                    <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 text-[#DDF2DF] text-xs font-bold tracking-wider uppercase backdrop-blur-xs">
                        <span class="w-2 h-2 rounded-full bg-[#21845B] animate-pulse"></span>
                        <span>{{ __('messages.cta_eyebrow') }}</span>
                    </span>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                        {{ __('messages.guide_cta_question') }}
                    </h2>

                    <p class="text-sm sm:text-base text-[#DDF2DF] leading-relaxed max-w-2xl mx-auto">
                        {{ __('messages.guide_cta_sub') }} <strong class="text-white underline decoration-[#C6A15B]">{{ $location->name }}</strong>.
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('santi.show', $location->slug) }}"
                           id="btn-tanya-santi-ai"
                           class="w-full sm:w-auto inline-flex items-center justify-center space-x-3 px-8 py-4 rounded-2xl bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-extrabold text-sm shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300">
                            <span>{{ __('messages.guide_cta_btn') }}</span>
                            <svg class="w-5 h-5 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('locations.index') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-6 py-4 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm backdrop-blur-xs transition-colors">
                            <span>{{ __('messages.guide_other_temples') }}</span>
                        </a>
                    </div>

                    <div class="text-[11px] text-white/60 pt-2">
                        ✦ AI terhubung otomatis dengan basis data aturan resmi {{ $location->name }}
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== EXPLORE OTHER TEMPLES SECTION ==================== -->
        @if($allLocations->isNotEmpty())
            <div class="pt-8 border-t border-[#174D3B]/10 dark:border-white/10">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                            {{ __('messages.guide_other_temples') }}
                        </h3>
                        <p class="text-xs text-[#5A6961] dark:text-[#A7B9AF]">Pilih destinasi pura suci lainnya untuk melihat pedoman adatnya</p>
                    </div>
                    <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B]">
                        {{ __('messages.services_explore_all') }} →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($allLocations->take(4) as $other)
                        <a href="{{ route('guidelines.show', $other->slug) }}" class="p-4 rounded-2xl bg-white dark:bg-[#16352A] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B] dark:hover:border-[#21845B] hover:shadow-md transition-all duration-200 group flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-semibold text-[#21845B] dark:text-[#A7D9B8] block mb-1">
                                    {{ $other->verified_rules_count }} {{ __('messages.loc_verified_badge') }}
                                </span>
                                <h4 class="font-bold text-xs text-[#174D3B] dark:text-[#DDF2DF] group-hover:text-[#21845B] transition-colors line-clamp-1">
                                    {{ $other->name }}
                                </h4>
                            </div>
                            <div class="pt-3 mt-2 border-t border-gray-100 dark:border-white/10 flex items-center justify-between text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">
                                <span>{{ __('messages.services_card2_cta') }}</span>
                                <svg class="w-3.5 h-3.5 text-[#21845B] transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

