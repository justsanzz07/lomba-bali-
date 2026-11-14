@extends('layouts.admin')

@section('title', 'Edit ' . $location->name . ' — SANTI Admin')
@section('header_title', 'Edit Destinasi: ' . $location->name)

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between text-xs">
        <a href="{{ route('admin.locations.index') }}" class="text-[#21845B] hover:underline font-semibold">&larr; Kembali ke Daftar Destinasi</a>
        <a href="{{ route('guidelines.show', $location) }}" target="_blank" class="text-[#174D3B] dark:text-[#A7D9B8] hover:underline font-semibold flex items-center space-x-1">
            <span>Lihat Tampilan Publik</span>
            <span>↗</span>
        </a>
    </div>

    <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-6">
        <div class="border-b border-gray-100 dark:border-white/10 pb-4 flex items-center justify-between">
            <div>
                <h3 class="text-base font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">Perbarui Informasi Destinasi</h3>
                <p class="text-xs text-[#5A6961] dark:text-[#A7B9AF]">ID #{{ $location->id }} • {{ $location->cultural_rules_count }} Aturan Budaya Terkait</p>
            </div>
            <a href="{{ route('admin.cultural-rules.index', ['location_id' => $location->id]) }}" class="px-3 py-1.5 rounded-xl bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold hover:bg-[#c9e8cd]">
                Kelola Aturan Adat &rarr;
            </a>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs text-red-800 dark:text-red-300 space-y-1">
                @foreach($errors->all() as $err)
                    <div>• {{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.locations.update', $location) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name Input -->
            <div class="space-y-1">
                <label for="name" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Nama Destinasi / Pura / Cagar Budaya <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $location->name) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Slug Input -->
            <div class="space-y-1">
                <label for="slug" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Slug URL <span class="text-red-500">*</span></label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $location->slug) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] font-mono focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Address Input -->
            <div class="space-y-1">
                <label for="address" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Wilayah / Alamat Lengkap</label>
                <input type="text" id="address" name="address" value="{{ old('address', $location->address) }}"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Description Textarea -->
            <div class="space-y-1">
                <label for="description" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Deskripsi & Nilai Sejarah Budaya <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" required
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('description', $location->description) }}</textarea>
            </div>

            <!-- Is Active Checkbox -->
            <div class="pt-2">
                <label class="inline-flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $location->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#21845B] focus:ring-[#21845B] border-gray-300 dark:border-white/20 bg-white dark:bg-[#0E231B]">
                    <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Aktifkan destinasi untuk publik & konsultasi AI</span>
                </label>
            </div>

            <!-- Form Action Buttons -->
            <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.locations.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-xs font-semibold text-[#5A6961] dark:text-[#A7B9AF] hover:text-black dark:hover:text-white">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] text-white font-bold text-xs shadow-md transition-colors">Perbarui Destinasi</button>
            </div>
        </form>
    </div>
</div>
@endsection

