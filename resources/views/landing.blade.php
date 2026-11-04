@extends('layouts.app')

@section('title', 'Santi — AI Cultural Guardian Bali | Discover Bali. Respect Its Culture.')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-[#174D3B] via-[#1A5742] to-[#21845B] text-white py-20 lg:py-28">
        <!-- Background Cultural Balinese Motif Overlay -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="bali-pattern" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M30 0 L60 30 L30 60 L0 30 Z" fill="none" stroke="#C6A15B" stroke-width="1.5" />
                        <circle cx="30" cy="30" r="8" fill="none" stroke="#FFFFFF" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#bali-pattern)" />
            </svg>
        </div>

        <!-- Glowing Ambient Lights -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#C6A15B]/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Column: Copy & CTAs -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-[#C6A15B]/40 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-[#C6A15B]"></span>
                        <span class="text-xs uppercase tracking-widest font-semibold text-[#F8F6EF]">Pemandu Adat Virtual Berbasis Kecerdasan Buatan</span>
                    </div>

                    <h1 class="font-serif-bali text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Discover Bali. <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F8F6EF] via-[#C6A15B] to-[#F8F6EF]">
                            Respect Its Culture.
                        </span>
                    </h1>

                    <p class="text-base sm:text-lg text-[#F8F6EF]/90 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-light">
                        Santi hadir sebagai pendamping cerdas wisatawan untuk memahami tata krama adat, ketentuan busana pura (kamen & senteng), etika persembahyangan, dan batasan sakral pura di Bali melalui verifikasi aturan adat terpercaya.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                        <a href="{{ route('locations.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center space-x-3 px-8 py-4 rounded-xl bg-gradient-to-r from-[#C6A15B] to-[#A98338] text-[#174D3B] font-bold text-base shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 text-[#174D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Ask Santi AI</span>
                        </a>

                        <a href="#locations" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-7 py-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-base border border-white/20 backdrop-blur-md transition-all duration-200">
                            <svg class="w-5 h-5 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Explore Cultural Guidelines</span>
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-white/10 max-w-lg mx-auto lg:mx-0">
                        <div class="text-center lg:text-left">
                            <div class="font-serif-bali text-2xl font-bold text-[#C6A15B]">{{ $locations->count() }}+</div>
                            <div class="text-xs text-[#F8F6EF]/75">Kawasan Pura</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-serif-bali text-2xl font-bold text-[#C6A15B]">100%</div>
                            <div class="text-xs text-[#F8F6EF]/75">Rujukan Terverifikasi</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-serif-bali text-2xl font-bold text-[#C6A15B]">ID / EN</div>
                            <div class="text-xs text-[#F8F6EF]/75">Dukungan Bahasa</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Card Preview -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md rounded-3xl bg-[#FFFFFF] p-6 sm:p-8 text-[#202A25] shadow-2xl border-4 border-[#C6A15B]/30 transform lg:rotate-1 hover:rotate-0 transition-transform duration-300">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#174D3B] to-[#21845B] flex items-center justify-center text-white">
                                    <svg class="w-5 h-5 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-[#174D3B]">Santi AI Simulation</h4>
                                    <p class="text-[11px] text-[#5A6961]">Pura Agung Besakih</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#21845B]/10 text-[#21845B]">
                                Active Location
                            </span>
                        </div>

                        <!-- Chat Simulation Body -->
                        <div class="space-y-3.5 my-4 text-xs">
                            <div class="flex justify-end">
                                <div class="bg-[#174D3B] text-white px-3.5 py-2.5 rounded-2xl rounded-tr-xs max-w-[85%] leading-relaxed shadow-xs">
                                    Bolehkah saya memakai celana pendek saat masuk ke Pura Besakih?
                                </div>
                            </div>

                            <div class="flex justify-start space-x-2">
                                <div class="w-6 h-6 rounded-full bg-[#C6A15B] text-[#174D3B] flex-shrink-0 flex items-center justify-center font-bold text-[10px]">
                                    S
                                </div>
                                <div class="bg-[#F8F6EF] border border-[#C6A15B]/30 px-3.5 py-2.5 rounded-2xl rounded-tl-xs max-w-[90%] leading-relaxed text-[#202A25]">
                                    <p class="font-semibold text-[#174D3B] mb-1">Om Swastiastu 🙏</p>
                                    Tidak diperkenankan. Di Pura Agung Besakih, setiap pengunjung wajib mengenakan <strong>kamen</strong> (kain sarung panjang menutupi hingga bawah lutut) dan <strong>senteng</strong> (selendang pengikat pinggang). Pakaian santai seperti celana pendek atau bahu terbuka tidak diizinkan di kawasan suci.
                                    <div class="mt-2 pt-2 border-t border-gray-200/60 text-[10px] text-[#5A6961] flex items-center space-x-1">
                                        <span class="text-[#21845B] font-bold">✓ Terverifikasi:</span>
                                        <span>SE Gubernur Bali No. 4/2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-2">
                            <a href="{{ route('santi.show', 'pura-besakih') }}" class="w-full flex items-center justify-center space-x-2 py-3 px-4 rounded-xl bg-[#174D3B] hover:bg-[#21845B] text-white font-semibold text-xs transition-colors">
                                <span>Coba Percakapan Langsung di Besakih</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Selection Section (Anchored as #locations) -->
    <section id="locations" class="py-20 bg-[#F8F6EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-[#174D3B]/10 text-[#174D3B] border border-[#174D3B]/20">
                    Pilihan Lokasi Budaya
                </span>
                <h2 class="font-serif-bali text-3xl sm:text-4xl font-extrabold text-[#174D3B]">
                    Pilih Kawasan Pura yang Anda Kunjungi
                </h2>
                <p class="text-sm sm:text-base text-[#5A6961] leading-relaxed">
                    Setiap kawasan suci memiliki karakter dan dresta (adat kebiasaan) tersendiri. Pilih lokasi di bawah ini untuk memulai percakapan cerdas dengan Santi AI sesuai aturan khusus pura tersebut.
                </p>
            </div>

            <!-- Locations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($locations as $loc)
                    <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl border border-[#174D3B]/10 transition-all duration-300 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <!-- Location Badge & QR Link Indicator -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $loc->verified_rules_count > 0 ? 'bg-[#21845B]/10 text-[#21845B] border border-[#21845B]/20' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                    {{ $loc->verified_rules_count > 0 ? $loc->verified_rules_count . ' Aturan Terverifikasi' : 'Uji Coba Unverified' }}
                                </span>
                                <span class="text-[11px] font-mono text-gray-400">/santi/{{ $loc->slug }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="font-serif-bali text-xl font-bold text-[#174D3B] group-hover:text-[#21845B] transition-colors">
                                {{ $loc->name }}
                            </h3>

                            <!-- Description -->
                            <p class="text-xs text-[#5A6961] line-clamp-3 leading-relaxed">
                                {{ $loc->description }}
                            </p>

                            <!-- Address -->
                            @if($loc->address)
                                <div class="flex items-start space-x-2 text-xs text-[#5A6961] pt-2 border-t border-gray-100">
                                    <svg class="w-4 h-4 text-[#C6A15B] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $loc->address }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Action Button -->
                        <div class="pt-6 mt-4 border-t border-gray-100">
                            <a href="{{ route('santi.show', $loc->slug) }}" class="w-full inline-flex items-center justify-center space-x-2 px-4 py-3 rounded-xl bg-[#F8F6EF] hover:bg-[#174D3B] text-[#174D3B] hover:text-white font-semibold text-xs transition-all duration-200 group-hover:bg-[#174D3B] group-hover:text-white">
                                <span>Tanya Panduan Pura Ini</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- QR Code Integration Notice -->
            <div class="mt-12 p-6 rounded-2xl bg-white border border-[#C6A15B]/30 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-[#174D3B]/10 flex items-center justify-center text-[#174D3B]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-[#174D3B]">Siap untuk Papan QR Code di Pintu Masuk Wisata</h4>
                        <p class="text-xs text-[#5A6961]">Wisatawan dapat langsung memindai QR Code di gerbang masuk pura tanpa perlu login atau instal aplikasi tambahan.</p>
                    </div>
                </div>
                <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#174D3B] hover:text-[#21845B] underline whitespace-nowrap">
                    Lihat Seluruh Direktori &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white border-y border-[#174D3B]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-[#C6A15B]/20 text-[#174D3B] border border-[#C6A15B]/40">
                    Alur Sederhana
                </span>
                <h2 class="font-serif-bali text-3xl sm:text-4xl font-extrabold text-[#174D3B]">
                    Bagaimana Santi Bekerja?
                </h2>
                <p class="text-sm sm:text-base text-[#5A6961]">
                    Tiga langkah cepat bagi wisatawan untuk mendapatkan panduan budaya yang akurat dan terverifikasi sebelum melangkah ke area pura.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-[#F8F6EF] p-8 rounded-3xl border border-[#174D3B]/10 relative group hover:border-[#C6A15B] transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#174D3B] text-[#C6A15B] font-serif-bali font-bold text-xl flex items-center justify-center mb-6 shadow-md">
                        01
                    </div>
                    <h3 class="font-bold text-lg text-[#174D3B] mb-2">Pilih atau Pindai Lokasi</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Pilih pura yang sedang Anda kunjungi dari daftar situs atau pindai QR Code yang tertera di papan informasi gerbang pura.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-[#F8F6EF] p-8 rounded-3xl border border-[#174D3B]/10 relative group hover:border-[#C6A15B] transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#21845B] text-white font-serif-bali font-bold text-xl flex items-center justify-center mb-6 shadow-md">
                        02
                    </div>
                    <h3 class="font-bold text-lg text-[#174D3B] mb-2">Tanyakan Pertanyaan Anda</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Ketik pertanyaan apa saja dalam bahasa Indonesia atau Inggris mengenai pakaian, batasan suci, pemotretan, atau etika bersikap.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-[#F8F6EF] p-8 rounded-3xl border border-[#174D3B]/10 relative group hover:border-[#C6A15B] transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#C6A15B] text-[#174D3B] font-serif-bali font-bold text-xl flex items-center justify-center mb-6 shadow-md">
                        03
                    </div>
                    <h3 class="font-bold text-lg text-[#174D3B] mb-2">Dapatkan Panduan Berdasar</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Santi menyaring aturan dari basis data resmi dan menggunakan Gemini AI untuk memberikan rekomendasi praktis dengan rujukan terpercaya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-[#F8F6EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-[#174D3B]/10 text-[#174D3B] border border-[#174D3B]/20">
                        Manfaat & Dampak Nyata
                    </span>
                    <h2 class="font-serif-bali text-3xl sm:text-4xl font-extrabold text-[#174D3B] leading-tight">
                        Menjembatani Wisatawan dan Kesakralan Tradisi Bali
                    </h2>
                    <p class="text-sm text-[#5A6961] leading-relaxed">
                        Bali bukan sekadar destinasi liburan, melainkan ruang sakral dengan filosofi kehidupan Tri Hita Karana. Santi memastikan setiap pengunjung dapat menikmati keindahan budaya dengan rasa hormat dan kesadaran penuh.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-start space-x-3.5">
                            <div class="w-8 h-8 rounded-xl bg-[#21845B]/10 text-[#21845B] flex-shrink-0 flex items-center justify-center mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#174D3B]">Mencegah Pelanggaran Tidak Disengaja</h4>
                                <p class="text-xs text-[#5A6961]">Banyak pelanggaran adat terjadi murni karena ketidaktahuan wisatawan tentang status sakral pura dan perlengkapan adat yang diwajibkan.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3.5">
                            <div class="w-8 h-8 rounded-xl bg-[#21845B]/10 text-[#21845B] flex-shrink-0 flex items-center justify-center mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#174D3B]">Menghilangkan Hambatan Bahasa</h4>
                                <p class="text-xs text-[#5A6961]">Mendukung wisatawan internasional berbahasa Inggris maupun wisatawan domestik dengan penjelasan yang mudah dipahami.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3.5">
                            <div class="w-8 h-8 rounded-xl bg-[#21845B]/10 text-[#21845B] flex-shrink-0 flex items-center justify-center mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#174D3B]">Verifikasi Fakta Anti-Halusinasi AI</h4>
                                <p class="text-xs text-[#5A6961]">Jawaban AI dikunci pada database aturan yang terverifikasi dan tidak mengarang peraturan adat lokal.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Balinese Element Card -->
                <div class="bg-gradient-to-br from-[#174D3B] to-[#21845B] rounded-3xl p-8 text-white relative shadow-2xl border-4 border-[#C6A15B]">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#C6A15B]">Budaya Luhur Bali</span>
                            <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Santi Safeguard</span>
                        </div>
                        <blockquote class="font-serif-bali text-xl font-light italic leading-relaxed text-[#F8F6EF]">
                            "Di mana bumi dipijak, di sana langit dijunjung. Hormati dresta dan tata krama kawasan suci agar kesucian Bali senantiasa terpelihara."
                        </blockquote>
                        <div class="pt-4 border-t border-white/20 text-xs text-[#F8F6EF]/80 space-y-1">
                            <p class="font-semibold text-[#C6A15B]">Etika Dasar Mengunjungi Kawasan Suci Bali:</p>
                            <p>1. Kenakan kain kamen dan senteng di pinggang.</p>
                            <p>2. Jangan melangkah atau menduduki pelinggih suci.</p>
                            <p>3. Hindari memotret langsung di depan pendeta yang sedang memimpin upacara.</p>
                            <p>4. Bagi wanita yang sedang datang bulan (cuntaka), hormati pantangan memasuki pura.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
