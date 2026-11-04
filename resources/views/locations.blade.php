@extends('layouts.app')

@section('title', 'Pilihan Lokasi Pura — Santi AI Cultural Guardian')

@section('content')
<div class="py-12 lg:py-16 bg-[#F8F6EF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="max-w-3xl mb-12">
            <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-[#174D3B] hover:text-[#21845B] mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            <h1 class="font-serif-bali text-3xl sm:text-4xl font-extrabold text-[#174D3B]">
                Pilih Kawasan Pura atau Situs Suci
            </h1>
            <p class="mt-3 text-sm text-[#5A6961] leading-relaxed">
                Pilih lokasi yang sedang atau akan Anda kunjungi. Santi AI akan memberikan panduan etika, busana, dan batasan sakral yang disesuaikan secara khusus dengan dresta lokasi tersebut.
            </p>
        </div>

        <!-- Search / Filter Bar -->
        <div class="mb-8">
            <div class="relative max-w-md">
                <input type="text" id="location-search" placeholder="Cari nama pura atau kabupaten..."
                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white border border-[#174D3B]/20 text-sm focus:outline-none focus:ring-2 focus:ring-[#174D3B] focus:border-transparent shadow-xs">
                <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Locations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="locations-container">
            @foreach($locations as $loc)
                <div class="location-card bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl border border-[#174D3B]/10 transition-all duration-300 flex flex-col justify-between"
                    data-name="{{ strtolower($loc->name) }}" data-address="{{ strtolower($loc->address ?? '') }}">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $loc->verifiedCulturalRules->count() > 0 ? 'bg-[#21845B]/10 text-[#21845B] border border-[#21845B]/20' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                {{ $loc->verifiedCulturalRules->count() > 0 ? $loc->verifiedCulturalRules->count() . ' Panduan Terverifikasi' : 'Uji Coba Sistem (Unverified)' }}
                            </span>
                            <span class="text-[11px] font-mono text-gray-400">/santi/{{ $loc->slug }}</span>
                        </div>

                        <h2 class="font-serif-bali text-xl font-bold text-[#174D3B]">
                            {{ $loc->name }}
                        </h2>

                        <p class="text-xs text-[#5A6961] leading-relaxed">
                            {{ $loc->description }}
                        </p>

                        @if($loc->address)
                            <div class="flex items-start space-x-2 text-xs text-[#5A6961] pt-2 border-t border-gray-100">
                                <svg class="w-4 h-4 text-[#C6A15B] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $loc->address }}</span>
                            </div>
                        @endif

                        <!-- Sample rules preview -->
                        @if($loc->verifiedCulturalRules->count() > 0)
                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-[11px] font-semibold text-[#174D3B] mb-1.5">Contoh Panduan Tersedia:</p>
                                <ul class="space-y-1 text-[11px] text-[#5A6961]">
                                    @foreach($loc->verifiedCulturalRules->take(2) as $rule)
                                        <li class="flex items-center space-x-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#C6A15B]"></span>
                                            <span class="truncate">{{ $rule->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="pt-6 mt-4 border-t border-gray-100">
                        <a href="{{ route('santi.show', $loc->slug) }}" class="w-full inline-flex items-center justify-center space-x-2 px-5 py-3 rounded-xl bg-gradient-to-r from-[#174D3B] to-[#21845B] hover:from-[#21845B] hover:to-[#174D3B] text-white font-semibold text-xs shadow-xs hover:shadow-md transition-all duration-200">
                            <span>Mulai Tanya Santi AI</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="no-results" class="hidden text-center py-16">
            <p class="text-sm text-[#5A6961]">Tidak ada lokasi yang cocok dengan kata kunci pencarian Anda.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('location-search');
        const cards = document.querySelectorAll('.location-card');
        const noResults = document.getElementById('no-results');

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const address = card.getAttribute('data-address');
                if (name.includes(query) || address.includes(query)) {
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
        });
    });
</script>
@endpush
@endsection
