@extends('layouts.app')

@section('title', $location->name . ' — ' . __('messages.guide_page_title') . ' — SANTI')
@section('meta_description', 'Panduan adat resmi, etika berpakaian, zona suci, dan peraturan berkunjung di ' . $location->name . '. Dapatkan wawasan budaya terverifikasi sebelum berkunjung.')

@section('content')
<div class="pt-28 pb-20 bg-[#F8F6EF] dark:bg-[#0B1E17] min-h-screen text-[#202A25] dark:text-[#F8F6EF] transition-colors duration-200">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Breadcrumb & Navigation -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-[#174D3B] dark:text-[#A7D9B8] hover:text-[#21845B] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>{{ __('messages.guide_back_locations') }}</span>
            </a>

            <a href="{{ route('santi.show', $location->slug) }}" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-xl bg-[#174D3B] hover:bg-[#21845B] text-white text-xs font-bold transition-all shadow-2xs">
                <span>Tanya Santi AI</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        <!-- ==================== COMPACT LOCATION HEADER ==================== -->
        <div class="bg-white dark:bg-[#16352A] rounded-3xl p-5 sm:p-6 shadow-xs border border-[#174D3B]/10 dark:border-white/10 mb-10 transition-colors">
            <div class="flex flex-col sm:flex-row gap-5 sm:gap-6 items-start">
                <!-- Location Thumbnail -->
                <div class="relative w-full sm:w-56 h-44 sm:h-48 rounded-2xl overflow-hidden bg-gray-900 shrink-0 shadow-xs">
                    <img src="{{ asset($locationImage) }}"
                         alt="{{ $location->name }}"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-2.5 left-2.5">
                        <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-[#21845B] text-white shadow-xs">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ $location->culturalRules->where('is_verified', true)->count() }} {{ __('messages.guide_verified_official') }}</span>
                        </span>
                    </div>
                </div>

                <!-- Location Details & Quick Facts -->
                <div class="flex-grow flex flex-col justify-between space-y-3">
                    <div>
                        <div class="flex items-center space-x-2 text-[11px] font-medium text-[#21845B] dark:text-[#A7D9B8] mb-1">
                            <span>Destinasi Wisata & Budaya</span>
                            <span>•</span>
                            <span>/panduan/{{ $location->slug }}</span>
                        </div>

                        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight">
                            {{ $location->name }}
                        </h1>

                        <p class="text-xs sm:text-sm text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed mt-2">
                            {{ $location->description }}
                        </p>
                    </div>

                    @if($location->address)
                        <div class="flex items-center space-x-2 text-xs text-[#5A6961] dark:text-[#A7B9AF] pt-2 border-t border-gray-100 dark:border-white/10">
                            <svg class="w-4 h-4 text-[#21845B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="truncate">{{ $location->address }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ==================== 2x2 GRID: ATURAN ADAT ==================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 mb-16 items-stretch">
            @php
                $categoryConfig = [
                    'dress_code' => ['icon' => '👗', 'title' => __('messages.cat_dress_code')],
                    'sacred_area' => ['icon' => '⛩️', 'title' => __('messages.cat_sacred_area')],
                    'behavior' => ['icon' => '✋', 'title' => __('messages.cat_behavior')],
                    'photography' => ['icon' => '📸', 'title' => __('messages.cat_photography')],
                    'general' => ['icon' => '📋', 'title' => __('messages.cat_general')],
                ];
            @endphp

            @foreach($categoryConfig as $catKey => $config)
                @if(isset($rulesByCategory[$catKey]) && $rulesByCategory[$catKey]->isNotEmpty())
                    <div class="bg-white dark:bg-[#16352A] rounded-3xl p-5 sm:p-6 shadow-xs border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B]/30 hover:shadow-md transition-all flex flex-col justify-between h-full">
                        <div>
                            <!-- Minimalist Category Header on Card -->
                            <div class="flex items-center space-x-3 pb-3 mb-4 border-b border-[#174D3B]/10 dark:border-white/10">
                                <span class="w-8 h-8 rounded-xl bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#A7D9B8] flex items-center justify-center text-sm font-bold shadow-2xs shrink-0">
                                    {{ $config['icon'] }}
                                </span>
                                <h2 class="text-base sm:text-lg font-bold text-[#174D3B] dark:text-[#DDF2DF] leading-tight">
                                    {{ $config['title'] }}
                                </h2>
                            </div>

                            <!-- Rules List inside Category Card -->
                            <div class="space-y-4">
                                @foreach($rulesByCategory[$catKey] as $rule)
                                    <div class="space-y-2 pb-3 last:pb-0 border-b border-gray-100 dark:border-white/5 last:border-b-0">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center space-x-1 text-[10px] font-bold px-2.5 py-0.5 rounded-full {{ $rule->is_verified ? 'bg-[#21845B]/10 text-[#21845B] dark:bg-[#21845B]/25 dark:text-[#A7D9B8]' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }}">
                                                @if($rule->is_verified)
                                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>{{ __('messages.guide_verified_tag') }}</span>
                                                @else
                                                    <span>Simulasi</span>
                                                @endif
                                            </span>
                                        </div>

                                        <h3 class="font-bold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF] leading-snug">
                                            {{ $rule->title }}
                                        </h3>

                                        <p class="text-xs sm:text-[13px] text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                                            {{ $rule->content }}
                                        </p>

                                        @if($rule->source_name)
                                            <div class="pt-2 text-[10px] sm:text-[11px] text-[#5A6961] dark:text-[#A7B9AF] flex items-center justify-between">
                                                <span class="truncate pr-2">
                                                    <strong class="font-semibold text-[#174D3B] dark:text-[#DDF2DF]">{{ __('messages.guide_source_official') }}:</strong> {{ $rule->source_name }}
                                                </span>
                                                @if($rule->source_url)
                                                    <a href="{{ $rule->source_url }}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B] flex-shrink-0" title="Kunjungi Sumber Resmi">
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
                    </div>
                @endif
            @endforeach
        </div>

        <!-- ==================== MINIMALIST CTA: TANYA SANTI AI ==================== -->
        <section id="tanya-santi-ai" class="mb-12">
            <div class="rounded-3xl bg-[#174D3B] text-white p-6 sm:p-8 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-1.5 text-center sm:text-left">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#DDF2DF] block">
                        KONSULTASI INTERAKTIF
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-white">
                        {{ __('messages.guide_cta_question') }}
                    </h2>
                    <p class="text-xs text-[#DDF2DF]/80 max-w-lg">
                        {{ __('messages.guide_cta_sub') }} <strong class="text-white">{{ $location->name }}</strong>.
                    </p>
                </div>

                <div class="flex items-center space-x-3 shrink-0">
                    <a href="{{ route('santi.show', $location->slug) }}"
                       class="px-6 py-3 rounded-xl bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-extrabold text-xs sm:text-sm shadow-md hover:scale-105 active:scale-95 transition-all">
                        {{ __('messages.guide_cta_btn') }} →
                    </a>
                </div>
            </div>
        </section>

        <!-- ==================== EXPLORE OTHER TEMPLES SECTION ==================== -->
        @if($allLocations->isNotEmpty())
            <div class="pt-8 border-t border-[#174D3B]/10 dark:border-white/10">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-[#174D3B] dark:text-[#DDF2DF]">
                            {{ __('messages.guide_other_temples') }}
                        </h3>
                    </div>
                    <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#21845B] dark:text-[#A7D9B8] hover:text-[#174D3B]">
                        {{ __('messages.services_explore_all') }} →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    @foreach($allLocations->take(4) as $other)
                        <a href="{{ route('guidelines.show', $other->slug) }}" class="p-3.5 rounded-2xl bg-white dark:bg-[#16352A] border border-[#174D3B]/10 dark:border-white/10 hover:border-[#21845B] hover:shadow-xs transition-all duration-200 group flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-semibold text-[#21845B] dark:text-[#A7D9B8] block mb-0.5">
                                    {{ $other->verified_rules_count }} {{ __('messages.loc_verified_badge') }}
                                </span>
                                <h4 class="font-bold text-xs text-[#174D3B] dark:text-[#DDF2DF] group-hover:text-[#21845B] transition-colors truncate">
                                    {{ $other->name }}
                                </h4>
                            </div>
                            <div class="pt-2 mt-2 border-t border-gray-100 dark:border-white/10 flex items-center justify-between text-[10px] text-[#5A6961] dark:text-[#A7B9AF]">
                                <span>Lihat Aturan</span>
                                <svg class="w-3 h-3 text-[#21845B] transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
