@extends('layouts.admin')

@section('title', 'Edit Halaman Depan — SANTI Admin')
@section('header_title', 'Kelola Konten & Teks Halaman Depan (Landing Page)')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between text-xs">
        <p class="text-[#5A6961] dark:text-[#A7B9AF]">Ubah teks dan pesan budaya yang langsung tampil di halaman muka publik website Santi AI.</p>
        <a href="{{ route('landing') }}" target="_blank" class="text-[#174D3B] dark:text-[#A7D9B8] hover:underline font-semibold flex items-center space-x-1">
            <span>Buka Halaman Depan Publik</span>
            <span>↗</span>
        </a>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs text-red-800 dark:text-red-300 space-y-1">
            @foreach($errors->all() as $err)
                <div>• {{ $err }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Pengumuman / Announcement Ticker -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100 dark:border-white/10">
                <span class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 flex items-center justify-center font-bold text-sm">📢</span>
                <div>
                    <h3 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF]">Pita Pengumuman Adat Khusus (Announcement Banner)</h3>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Tampil di bagian paling atas beranda (misal peringatan Hari Suci Nyepi, Galungan, atau himbauan darurat).</p>
                </div>
            </div>

            <div class="space-y-1">
                <label for="announcement_banner" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Teks Pengumuman (Kosongkan jika tidak ada pengumuman)</label>
                <textarea id="announcement_banner" name="announcement_banner" rows="2"
                    placeholder="Contoh: Peringatan Hari Suci Nyepi Saka 1948: Seluruh aktivitas luar ruangan ditiadakan selama 24 jam."
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('announcement_banner', $settings['announcement_banner']) }}</textarea>
            </div>
        </div>

        <!-- Card 2: Hero Section (Banner Utama) -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100 dark:border-white/10">
                <span class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-[#21845B]/25 text-[#21845B] flex items-center justify-center font-bold text-sm">🏛️</span>
                <div>
                    <h3 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF]">Bagian Hero (Banner Utama Halaman Muka)</h3>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Judul besar dan sambutan awal yang pertama kali dibaca wisatawan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label for="hero_title_1" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Judul Hero Baris 1 <span class="text-red-500">*</span></label>
                    <input type="text" id="hero_title_1" name="hero_title_1" value="{{ old('hero_title_1', $settings['hero_title_1']) }}" required
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                </div>

                <div class="space-y-1">
                    <label for="hero_title_2" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Judul Hero Baris 2 <span class="text-red-500">*</span></label>
                    <input type="text" id="hero_title_2" name="hero_title_2" value="{{ old('hero_title_2', $settings['hero_title_2']) }}" required
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                </div>
            </div>

            <div class="space-y-1">
                <label for="hero_subtitle" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Subjudul / Deskripsi Sambutan <span class="text-red-500">*</span></label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
            </div>
        </div>

        <!-- Card 3: About Section (Tentang Misi Budaya) -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100 dark:border-white/10">
                <span class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-950/40 text-teal-600 flex items-center justify-center font-bold text-sm">🌺</span>
                <div>
                    <h3 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF]">Bagian Tentang Kami (Filosofi & Regulasi)</h3>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Menjelaskan alasan moral dan dasar hukum perlindungan budaya Bali.</p>
                </div>
            </div>

            <div class="space-y-1">
                <label for="about_heading" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Judul Bagian Tentang Kami <span class="text-red-500">*</span></label>
                <input type="text" id="about_heading" name="about_heading" value="{{ old('about_heading', $settings['about_heading']) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <div class="space-y-1">
                <label for="about_p1" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Paragraf 1 (Filosofi Kesucian Bali) <span class="text-red-500">*</span></label>
                <textarea id="about_p1" name="about_p1" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('about_p1', $settings['about_p1']) }}</textarea>
            </div>

            <div class="space-y-1">
                <label for="about_p2" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Paragraf 2 (Peran Santi AI) <span class="text-red-500">*</span></label>
                <textarea id="about_p2" name="about_p2" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('about_p2', $settings['about_p2']) }}</textarea>
            </div>

            <div class="space-y-1">
                <label for="about_highlight" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Teks Sorotan Titik Hijau</label>
                <input type="text" id="about_highlight" name="about_highlight" value="{{ old('about_highlight', $settings['about_highlight']) }}"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>
        </div>

        <!-- Card 4: Kontak Darurat -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100 dark:border-white/10">
                <span class="w-8 h-8 rounded-xl bg-red-50 dark:bg-red-950/40 text-red-600 flex items-center justify-center font-bold text-sm">☎️</span>
                <div>
                    <h3 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF]">Kontak Darurat Wisatawan</h3>
                    <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">Ditampilkan pada bagian footer darurat pariwisata Bali.</p>
                </div>
            </div>

            <div class="space-y-1 max-w-xs">
                <label for="emergency_phone_112" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Nomor Call Center Darurat <span class="text-red-500">*</span></label>
                <input type="text" id="emergency_phone_112" name="emergency_phone_112" value="{{ old('emergency_phone_112', $settings['emergency_phone_112']) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] font-bold text-red-600 dark:text-red-400 focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>
        </div>

        <!-- Save Button Sticky Bar -->
        <div class="flex items-center justify-end space-x-3 pt-2">
            <button type="submit" class="px-8 py-3 rounded-2xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all cursor-pointer flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Simpan Seluruh Perubahan Halaman Depan</span>
            </button>
        </div>
    </form>
</div>
@endsection
