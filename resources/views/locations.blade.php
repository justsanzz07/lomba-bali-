@extends('layouts.app')

@section('title', __('messages.loc_page_title') . ' — SANTI')

@section('content')
<div class="pt-28 pb-20 bg-[#F8F6EF] dark:bg-[#0B1E17] min-h-screen transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="max-w-3xl mb-12">
            <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-[#174D3B] dark:text-[#A7D9B8] hover:text-[#21845B] mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>{{ __('messages.loc_back_home') }}</span>
            </a>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">
                {{ __('messages.loc_page_title') }}
            </h1>
            <p class="mt-3 text-sm text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed">
                {{ __('messages.loc_page_subtitle') }}
            </p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="mb-10 space-y-4">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <div class="relative max-w-md w-full">
                    <input type="text" id="location-search" placeholder="{{ __('messages.loc_search_placeholder') }}"
                        class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white dark:bg-[#16352A] border border-[#174D3B]/20 dark:border-white/10 text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B] focus:border-transparent shadow-xs">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Quick Category Filter Pills -->
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" class="loc-filter-btn active px-4 py-2 rounded-xl text-xs font-bold bg-[#174D3B] dark:bg-[#21845B] text-white transition-colors" data-category="all">
                        {{ __('messages.loc_filter_all') }}
                    </button>
                    <button type="button" class="loc-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-[#16352A] border border-[#174D3B]/15 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] dark:hover:bg-[#1D4436] transition-colors" data-category="temple">
                        {{ __('messages.loc_filter_temples') }}
                    </button>
                    <button type="button" class="loc-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-[#16352A] border border-[#174D3B]/15 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] dark:hover:bg-[#1D4436] transition-colors" data-category="beach">
                        {{ __('messages.loc_filter_beaches') }}
                    </button>
                    <button type="button" class="loc-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-[#16352A] border border-[#174D3B]/15 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] dark:hover:bg-[#1D4436] transition-colors" data-category="village">
                        {{ __('messages.loc_filter_villages') }}
                    </button>
                    <button type="button" class="loc-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-[#16352A] border border-[#174D3B]/15 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] dark:hover:bg-[#1D4436] transition-colors" data-category="nature">
                        {{ __('messages.loc_filter_nature') }}
                    </button>
                    <button type="button" class="loc-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-white dark:bg-[#16352A] border border-[#174D3B]/15 dark:border-white/10 text-[#174D3B] dark:text-[#DDF2DF] hover:bg-[#DDF2DF] dark:hover:bg-[#1D4436] transition-colors" data-category="culture">
                        {{ __('messages.loc_filter_culture') }}
                    </button>
                </div>
            </div>
        </div>

        @php
            $locImages = [
                'seluruh-bali' => 'images/hero-candi-bentar.jpg',
                'pura-besakih' => 'images/hero-candi-bentar.jpg',
                'pura-ulun-danu-beratan' => 'images/hero-bali.jpg',
                'pura-uluwatu' => 'images/service-location.jpg',
                'pura-tirta-empul' => 'images/service-guidelines.jpg',
                'pura-tanah-lot' => 'images/hero-candi-bentar.jpg',
                'desa-penglipuran' => 'images/about-bali-guide.jpg',
                'jatiluwih-rice-terraces' => 'images/service-location.jpg',
                'pantai-kuta' => 'images/service-guidelines.jpg',
                'gwk-cultural-park' => 'images/service-ai-chat.jpg',
                'ubud-monkey-forest' => 'images/service-location.jpg',
                'gunung-batur-kintamani' => 'images/hero-bali.jpg',
                'pura-desa-simulasi' => 'images/about-bali-guide.jpg',
            ];
        @endphp

        <!-- Locations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="locations-container">
            @foreach($locations as $loc)
                @php
                    $categoryTag = 'temple';
                    $categoryLabel = 'Kawasan Pura Suci';
                    if ($loc->slug === 'seluruh-bali') {
                        $categoryTag = 'all';
                        $categoryLabel = 'Seluruh Kawasan Bali';
                    } elseif (str_contains($loc->slug, 'kuta') || str_contains($loc->slug, 'pantai')) {
                        $categoryTag = 'beach';
                        $categoryLabel = 'Pesisir & Pantai Wisata';
                    } elseif (str_contains($loc->slug, 'penglipuran')) {
                        $categoryTag = 'village';
                        $categoryLabel = 'Desa Wisata Adat';
                    } elseif (str_contains($loc->slug, 'gwk')) {
                        $categoryTag = 'culture';
                        $categoryLabel = 'Taman Budaya & Seni';
                    } elseif (str_contains($loc->slug, 'jatiluwih')) {
                        $categoryTag = 'nature';
                        $categoryLabel = 'Ekowisata & Subak UNESCO';
                    } elseif (str_contains($loc->slug, 'monkey') || str_contains($loc->slug, 'batur')) {
                        $categoryTag = 'nature';
                        $categoryLabel = 'Kawasan Alam & Geopark';
                    } elseif (str_contains($loc->slug, 'simulasi')) {
                        $categoryTag = 'simulation';
                        $categoryLabel = 'Uji Coba Sistem';
                    }
                    $cardImg = $locImages[$loc->slug] ?? 'images/hero-candi-bentar.jpg';
                @endphp
                <div class="location-card bg-white dark:bg-[#16352A] rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-[#174D3B]/10 dark:border-white/10 transition-all duration-300 flex flex-col justify-between"
                    data-name="{{ strtolower($loc->name) }}"
                    data-address="{{ strtolower($loc->address ?? '') }}"
                    data-category="{{ $categoryTag }}">
                    
                    <!-- Top Thumbnail Image -->
                    <div class="relative h-48 bg-gray-900 overflow-hidden">
                        <img src="{{ asset($cardImg) }}"
                             alt="{{ $loc->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#174D3B]/90 text-white backdrop-blur-xs">
                                {{ $categoryLabel }}
                            </span>
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-white">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $loc->verifiedCulturalRules->count() > 0 ? 'bg-[#21845B] text-white' : 'bg-amber-500 text-white' }}">
                                {{ $loc->verifiedCulturalRules->count() > 0 ? $loc->verifiedCulturalRules->count() . ' ' . __('messages.loc_verified_badge') : __('messages.loc_unverified_badge') }}
                            </span>
                            <span class="text-[10px] font-mono text-white/80">/panduan/{{ $loc->slug }}</span>
                        </div>
                    </div>

                    <div class="p-6 space-y-4 flex-grow flex flex-col justify-between">
                        <div class="space-y-2.5">
                            <h2 class="text-xl font-bold text-[#174D3B] dark:text-[#DDF2DF] line-clamp-1">
                                {{ $loc->name }}
                            </h2>

                            <p class="text-xs text-[#5A6961] dark:text-[#C1D1C7] leading-relaxed line-clamp-2">
                                {{ $loc->description }}
                            </p>

                            @if($loc->address)
                                <div class="flex items-start space-x-2 text-xs text-[#5A6961] dark:text-[#A7B9AF] pt-2 border-t border-gray-100 dark:border-white/10">
                                    <svg class="w-4 h-4 text-[#21845B] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $loc->address }}</span>
                                </div>
                            @endif

                            <!-- Sample rules preview -->
                            @if($loc->verifiedCulturalRules->count() > 0)
                                <div class="pt-2 border-t border-gray-100 dark:border-white/10">
                                    <p class="text-[11px] font-semibold text-[#174D3B] dark:text-[#DDF2DF] mb-1">Pedoman Unggulan:</p>
                                    <ul class="space-y-1 text-[11px] text-[#5A6961] dark:text-[#C1D1C7]">
                                        @foreach($loc->verifiedCulturalRules->take(2) as $rule)
                                            <li class="flex items-center space-x-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#21845B] flex-shrink-0"></span>
                                                <span class="truncate">{{ $rule->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="pt-5 mt-4 border-t border-gray-100 dark:border-white/10 flex flex-col sm:flex-row items-center gap-2">
                            <a href="{{ $loc->slug === 'seluruh-bali' ? route('santi.index') : route('santi.show', $loc->slug) }}" class="w-full sm:flex-1 inline-flex items-center justify-center space-x-1.5 px-3 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] dark:hover:bg-[#1a6e4b] text-white font-bold text-xs shadow-xs transition-colors">
                                <span>{{ __('messages.nav_ask_santi') }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('guidelines.show', $loc->slug) }}" class="w-full sm:flex-1 inline-flex items-center justify-center space-x-1.5 px-3 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-[#DDF2DF] dark:hover:bg-[#21845B]/30 text-[#174D3B] dark:text-[#DDF2DF] font-semibold text-xs border border-[#174D3B]/15 dark:border-white/10 shadow-xs transition-colors">
                                <span>{{ __('messages.loc_view_guidelines') }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="no-results" class="hidden text-center py-16">
            <p class="text-sm text-[#5A6961]">{{ __('messages.loc_no_results') }}</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('location-search');
        const filterBtns = document.querySelectorAll('.loc-filter-btn');
        const cards = document.querySelectorAll('.location-card');
        const noResults = document.getElementById('no-results');

        let activeCategory = 'all';
        let searchQuery = '';

        function filterCards() {
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const address = card.getAttribute('data-address');
                const category = card.getAttribute('data-category');

                const matchesQuery = !searchQuery || name.includes(searchQuery) || address.includes(searchQuery);
                const matchesCategory = activeCategory === 'all' || category === activeCategory;

                if (matchesQuery && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            filterCards();
        });

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-[#174D3B]', 'dark:bg-[#21845B]', 'text-white', 'font-bold');
                    b.classList.add('bg-white', 'dark:bg-[#16352A]', 'text-[#174D3B]', 'dark:text-[#DDF2DF]', 'font-semibold');
                });
                btn.classList.add('bg-[#174D3B]', 'dark:bg-[#21845B]', 'text-white', 'font-bold');
                btn.classList.remove('bg-white', 'dark:bg-[#16352A]', 'text-[#174D3B]', 'dark:text-[#DDF2DF]');

                activeCategory = btn.getAttribute('data-category');
                filterCards();
            });
        });
    });
</script>
@endpush
@endsection
