@extends('layouts.app')

@section('title', 'Santi — AI Cultural Guardian Bali | Discover the Magic of Bali')

@section('content')
    <!-- Hero Section (Matching Exact Visual of User Reference Image) -->
    <section class="relative min-h-[90vh] lg:min-h-screen flex items-center justify-start text-white overflow-hidden bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('images/hero-bali.jpg') }}');">
        <!-- Atmospheric Dim Overlay for WCAG Contrast & Photography Depth -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/35 to-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/30 pointer-events-none"></div>

        <!-- Hero Content (Center-Left Aligned as in Reference Image) -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-32 lg:py-40">
            <div class="max-w-2xl space-y-6">
                <!-- Large White Bold Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight drop-shadow-md">
                    Discover the Magic of Bali
                </h1>

                <!-- Clear, Atmospheric Subtitle -->
                <p class="text-base sm:text-lg text-white/90 leading-relaxed font-normal max-w-xl drop-shadow-sm">
                    Pahami etika sakral, ketentuan busana pura (kamen & senteng), dan kearifan dresta Bali bersama asisten AI kebudayaan terpercaya.
                </p>

                <!-- Primary CTA Button (Sky-Blue matching "Explore Tours ->" in Reference Screenshot) -->
                <div class="pt-2 flex flex-col sm:flex-row items-start gap-4">
                    <a href="{{ route('locations.index') }}"
                       class="inline-flex items-center space-x-2.5 px-7 py-3.5 rounded-xl bg-[#4ea8de] hover:bg-[#38bdf8] text-white font-semibold text-base shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <span>Explore Guidelines</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                    <a href="{{ route('santi.show', 'pura-ulun-danu-beratan') }}"
                       class="inline-flex items-center space-x-2 px-6 py-3.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-medium text-base backdrop-blur-md border border-white/25 transition-all duration-200">
                        <span>Tanya Pura Ulun Danu</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Carousel Indicator Dots (Matching Screenshot at Bottom Center) -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center space-x-2 z-20" aria-label="Slide Indicator">
            <span class="w-8 h-2.5 rounded-full bg-white shadow-sm transition-all"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/50 hover:bg-white/80 transition-all cursor-pointer"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/50 hover:bg-white/80 transition-all cursor-pointer"></span>
        </div>
    </section>

    <!-- Location Selection Section (Anchored as #locations) -->
    <section id="locations" class="py-20 bg-[#F8F6EF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs uppercase tracking-widest font-bold text-[#174D3B]">
                        Kawasan Budaya Terverifikasi
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#174D3B] mt-1">
                        Pilih Kawasan Pura Kunjungan Anda
                    </h2>
                    <p class="text-sm text-[#5A6961] mt-2 max-w-2xl leading-relaxed">
                        Setiap pura memiliki aturan dresta dan zona kesucian mandala tersendiri. Pilih lokasi untuk mendapatkan panduan akurat dari Santi AI.
                    </p>
                </div>
                <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-1 text-sm font-bold text-[#174D3B] hover:text-[#4ea8de] transition-colors whitespace-nowrap">
                    <span>Lihat Semua Pura ({{ $locations->count() }})</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Locations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($locations->take(6) as $loc)
                    <div class="bg-white rounded-2xl p-6 shadow-xs hover:shadow-lg border border-[#174D3B]/10 transition-all duration-200 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <!-- Location Badge & QR Link -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $loc->verified_rules_count > 0 ? 'bg-[#21845B]/10 text-[#21845B]' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $loc->verified_rules_count > 0 ? $loc->verified_rules_count . ' Aturan Terverifikasi' : 'Uji Coba Unverified' }}
                                </span>
                                <span class="text-[11px] font-mono text-gray-400">/santi/{{ $loc->slug }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-[#174D3B] group-hover:text-[#4ea8de] transition-colors">
                                {{ $loc->name }}
                            </h3>

                            <!-- Description -->
                            <p class="text-xs text-[#5A6961] line-clamp-3 leading-relaxed">
                                {{ $loc->description }}
                            </p>

                            <!-- Address -->
                            @if($loc->address)
                                <div class="flex items-start space-x-2 text-xs text-[#5A6961] pt-2 border-t border-gray-100">
                                    <svg class="w-4 h-4 text-[#4ea8de] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $loc->address }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Action Button -->
                        <div class="pt-6 mt-4 border-t border-gray-100">
                            <a href="{{ route('santi.show', $loc->slug) }}"
                               class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-[#F8F6EF] hover:bg-[#4ea8de] text-[#174D3B] hover:text-white font-semibold text-xs transition-colors">
                                <span>Tanya Aturan Pura Ini</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- QR Code Section -->
            <div class="mt-12 p-6 rounded-2xl bg-white border border-[#174D3B]/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-[#4ea8de]/10 text-[#4ea8de] flex items-center justify-center font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-[#174D3B]">Akses Langsung Melalui Papan QR Code di Pintu Masuk</h4>
                        <p class="text-xs text-[#5A6961]">Wisatawan dapat langsung membuka panduan pura spesifik tanpa registrasi atau unduh aplikasi.</p>
                    </div>
                </div>
                <a href="{{ route('locations.index') }}" class="text-xs font-bold text-[#4ea8de] hover:underline whitespace-nowrap">
                    Buka Direktori Lengkap &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Cultural Guidelines Summary (#guidelines & #etiquette) -->
    <section id="guidelines" class="py-20 bg-white border-t border-[#174D3B]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-xs uppercase tracking-widest font-bold text-[#4ea8de]">
                        Etika Dasar Kawasan Suci
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#174D3B] leading-tight">
                        Menghormati Kesucian Adat dan Tradisi Luhur Bali
                    </h2>
                    <p class="text-sm text-[#5A6961] leading-relaxed">
                        Kawasan pura di Bali dibagi menjadi tiga zona sakral (Tri Mandala). Memahami batasan dan busana yang pantas adalah bentuk penghormatan tertinggi kepada masyarakat dan leluhur Bali.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="p-4 rounded-xl bg-[#F8F6EF] border border-[#174D3B]/10">
                            <h4 class="font-bold text-sm text-[#174D3B] mb-1">1. Busana Kamen & Senteng</h4>
                            <p class="text-xs text-[#5A6961] leading-relaxed">Wajib mengenakan kain penutup (kamen/sarung) hingga bawah lutut dan selendang (senteng) yang diikatkan di pinggang sebagai simbol pengendalian diri.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#F8F6EF] border border-[#174D3B]/10">
                            <h4 class="font-bold text-sm text-[#174D3B] mb-1">2. Batas Utama Mandala (Jeroan)</h4>
                            <p class="text-xs text-[#5A6961] leading-relaxed">Area pelataran dalam pura hanya diperuntukkan bagi umat yang bersembahyang secara khusyuk. Wisatawan umum dipandu berada di zona Jaba Tengah.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#F8F6EF] border border-[#174D3B]/10">
                            <h4 class="font-bold text-sm text-[#174D3B] mb-1">3. Menjaga Kesucian Diri (Cuntaka)</h4>
                            <p class="text-xs text-[#5A6961] leading-relaxed">Pengunjung wanita yang sedang datang bulan (menstruasi) atau yang sedang dalam masa duka diimbau secara adat untuk tidak memasuki area suci pura.</p>
                        </div>
                    </div>
                </div>

                <!-- Visual Card with Authentic Guidelines Info -->
                <div class="rounded-3xl bg-[#174D3B] p-8 text-white relative shadow-xl">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <span class="text-xs uppercase tracking-wider font-semibold text-[#4ea8de]">Filosofi Dresta Bali</span>
                            <span class="text-xs bg-white/15 px-3 py-1 rounded-full text-white/90">Santi Verified AI</span>
                        </div>

                        <blockquote class="text-lg font-light italic leading-relaxed text-[#F8F6EF]">
                            "Di mana bumi dipijak, di sana langit dijunjung. Tri Hita Karana mengajarkan keharmonisan manusia dengan Tuhan, sesama manusia, dan alam semesta."
                        </blockquote>

                        <div class="pt-4 border-t border-white/10 text-xs text-white/80 space-y-2">
                            <p class="font-semibold text-white">Etika Praktis di Lokasi Pura:</p>
                            <p>• Jangan melangkah atau menduduki pelinggih/candi pemujaan.</p>
                            <p>• Dilarang memotret langsung tepat di hadapan Pemangku yang sedang memimpin ritual.</p>
                            <p>• Dilarang menerbangkan drone di atas mandala pura tanpa izin resmi.</p>
                            <p>• Selalu jaga tutur kata dan ketertiban di lingkungan pura.</p>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('locations.index') }}"
                               class="w-full inline-flex items-center justify-center space-x-2 py-3 px-4 rounded-xl bg-[#4ea8de] hover:bg-[#38bdf8] text-white font-semibold text-xs transition-colors">
                                <span>Pilih Pura & Tanya Santi AI</span>
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

    <!-- How It Works Section (#how-it-works) -->
    <section id="how-it-works" class="py-20 bg-[#F8F6EF] border-t border-[#174D3B]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs uppercase tracking-widest font-bold text-[#174D3B]">
                    Alur Penggunaan
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-[#174D3B]">
                    Cara Menggunakan Santi
                </h2>
                <p class="text-sm text-[#5A6961]">
                    Tiga langkah sederhana bagi wisatawan untuk mendapatkan panduan budaya yang akurat dan terverifikasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl border border-[#174D3B]/10 hover:border-[#4ea8de] transition-colors">
                    <div class="w-12 h-12 rounded-xl bg-[#174D3B] text-white font-bold text-lg flex items-center justify-center mb-6">
                        01
                    </div>
                    <h3 class="font-bold text-base text-[#174D3B] mb-2">Pilih atau Pindai Lokasi Pura</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Pilih pura dari direktori atau pindai kode QR yang terpasang di papan informasi gerbang masuk objek wisata.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-[#174D3B]/10 hover:border-[#4ea8de] transition-colors">
                    <div class="w-12 h-12 rounded-xl bg-[#4ea8de] text-white font-bold text-lg flex items-center justify-center mb-6">
                        02
                    </div>
                    <h3 class="font-bold text-base text-[#174D3B] mb-2">Ajukan Pertanyaan</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Ketik pertanyaan bebas dalam Bahasa Indonesia atau English mengenai pakaian, batasan suci, foto, atau larangan adat.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-[#174D3B]/10 hover:border-[#4ea8de] transition-colors">
                    <div class="w-12 h-12 rounded-xl bg-[#21845B] text-white font-bold text-lg flex items-center justify-center mb-6">
                        03
                    </div>
                    <h3 class="font-bold text-base text-[#174D3B] mb-2">Dapatkan Jawaban Terverifikasi</h3>
                    <p class="text-xs text-[#5A6961] leading-relaxed">
                        Santi memberikan jawaban terstruktur berdasarkan basis data terverifikasi resmi, lengkap dengan rujukan sumbernya.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
