@extends('layouts.admin')

@section('title', 'Tambah Destinasi Baru — SANTI Admin')
@section('header_title', 'Tambah Destinasi Wisata / Pura')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center space-x-2 text-xs">
        <a href="{{ route('admin.locations.index') }}" class="text-[#21845B] hover:underline font-semibold">&larr; Kembali ke Daftar Destinasi</a>
    </div>

    <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 sm:p-8 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-6">
        <div class="border-b border-gray-100 dark:border-white/10 pb-4">
            <h3 class="text-base font-extrabold text-[#174D3B] dark:text-[#DDF2DF]">Formulir Destinasi Budaya Baru</h3>
            <p class="text-xs text-[#5A6961] dark:text-[#A7B9AF]">Informasi ini akan ditampilkan pada katalog publik dan dijadikan basis data panduan oleh AI Santi.</p>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs text-red-800 dark:text-red-300 space-y-1">
                @foreach($errors->all() as $err)
                    <div>• {{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.locations.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name Input -->
            <div class="space-y-1">
                <label for="name" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Nama Destinasi / Pura / Cagar Budaya <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    placeholder="Contoh: Pura Goa Lawah"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Slug Input -->
            <div class="space-y-1">
                <label for="slug" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Slug URL (Opsional, otomatis digenerate)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                    placeholder="pura-goa-lawah"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] font-mono focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <p class="text-[11px] text-gray-400">Digunakan untuk akses URL publik, misalnya: <code>/panduan/pura-goa-lawah</code></p>
            </div>

            <!-- Address Input -->
            <div class="space-y-1">
                <label for="address" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Wilayah / Alamat Lengkap</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}"
                    placeholder="Contoh: Desa Pesinggahan, Kec. Dawan, Kabupaten Klungkung, Bali"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
            </div>

            <!-- Description Textarea -->
            <div class="space-y-1">
                <label for="description" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Deskripsi & Nilai Sejarah Budaya <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" required
                    placeholder="Tuliskan latar belakang sejarah, signifikansi spiritual pura, atau keunikan desa adat ini..."
                    class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">{{ old('description') }}</textarea>
            </div>

            <!-- Is Active Checkbox -->
            <div class="pt-2">
                <label class="inline-flex items-center space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#21845B] focus:ring-[#21845B] border-gray-300 dark:border-white/20 bg-white dark:bg-[#0E231B]">
                    <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Aktifkan destinasi untuk publik & konsultasi AI</span>
                </label>
            </div>

            <!-- Form Action Buttons -->
            <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.locations.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-xs font-semibold text-[#5A6961] dark:text-[#A7B9AF] hover:text-black dark:hover:text-white">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] text-white font-bold text-xs shadow-md transition-colors">Simpan Destinasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
