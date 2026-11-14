@extends('layouts.admin')

@section('title', 'Edit Aturan Adat — SANTI Admin')
@section('header_title', 'Edit Aturan Adat: ' . $culturalRule->title)

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center space-x-2 text-xs">
        <a href="{{ route('admin.cultural-rules.index', ['location_id' => $culturalRule->location_id]) }}" class="text-[#21845B] hover:underline font-semibold">&larr; Kembali ke Daftar Aturan</a>
    </div>

    <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-6">
        <div class="border-b border-gray-100 dark:border-white/10 pb-4">
            <h3 class="text-base font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">Perbarui Pedoman Budaya</h3>
            <p class="text-xs text-[#5A6961] dark:text-[#A7B9AF]">Aturan ID #{{ $culturalRule->id }} • Terkait dengan {{ $culturalRule->location->name ?? 'Seluruh Bali' }}</p>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs text-red-800 dark:text-red-300 space-y-1">
                @foreach($errors->all() as $err)
                    <div>• {{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.cultural-rules.update', $culturalRule) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Location Selector -->
            <div class="space-y-1">
                <label for="location_id" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Destinasi Budaya Terkait <span class="text-red-500">*</span></label>
                <select id="location_id" name="location_id" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ old('location_id', $culturalRule->location_id) == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }} ({{ $loc->address ?? 'Bali' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category Selector -->
            <div class="space-y-1">
                <label for="category" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Kategori Aturan Adat <span class="text-red-500">*</span></label>
                <select id="category" name="category" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                    <option value="dress_code" {{ old('category', $culturalRule->category) === 'dress_code' ? 'selected' : '' }}>Busana Adat (Dress Code)</option>
                    <option value="sacred_area" {{ old('category', $culturalRule->category) === 'sacred_area' ? 'selected' : '' }}>Kawasan Sakral (Utama Mandala, Pohon Suci, Puncak Gunung)</option>
                    <option value="behavior" {{ old('category', $culturalRule->category) === 'behavior' ? 'selected' : '' }}>Tata Krama & Pantangan (Canang Sari, Cuntaka, Upacara)</option>
                    <option value="photography" {{ old('category', $culturalRule->category) === 'photography' ? 'selected' : '' }}>Etika Foto & Operasi Drone</option>
                    <option value="general" {{ old('category', $culturalRule->category) === 'general' ? 'selected' : '' }}>Aturan Umum (Transaksi QRIS, Helm, SE Gubernur)</option>
                </select>
            </div>

            <!-- Title Input -->
            <div class="space-y-1">
                <label for="title" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Judul Aturan Ringkas <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $culturalRule->title) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Content Textarea -->
            <div class="space-y-1">
                <label for="content" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Isi & Penjelasan Lengkap Pedoman <span class="text-red-500">*</span></label>
                <textarea id="content" name="content" rows="4" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('content', $culturalRule->content) }}</textarea>
            </div>

            <!-- Source Name & URL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label for="source_name" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Nama Sumber / Regulasi Resmi</label>
                    <input type="text" id="source_name" name="source_name" value="{{ old('source_name', $culturalRule->source_name) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                </div>

                <div class="space-y-1">
                    <label for="source_url" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Tautan Rujukan / Dokumen Resmi</label>
                    <input type="url" id="source_url" name="source_url" value="{{ old('source_url', $culturalRule->source_url) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="pt-2 flex flex-col sm:flex-row gap-4">
                <label class="inline-flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $culturalRule->is_verified) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#21845B] focus:ring-[#21845B] border-gray-300 dark:border-white/20 bg-white dark:bg-[#0E231B]">
                    <span class="text-xs font-bold text-emerald-700 dark:text-emerald-400">Verifikasi Resmi (Digunakan Santi AI untuk menjawab)</span>
                </label>

                <label class="inline-flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $culturalRule->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#21845B] focus:ring-[#21845B] border-gray-300 dark:border-white/20 bg-white dark:bg-[#0E231B]">
                    <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Aktifkan di Katalog Panduan</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.cultural-rules.index', ['location_id' => $culturalRule->location_id]) }}" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-xs font-semibold text-[#5A6961] dark:text-[#A7B9AF] hover:text-black dark:hover:text-white">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] text-white font-bold text-xs shadow-md transition-colors">Perbarui Aturan</button>
            </div>
        </form>
    </div>
</div>
@endsection
