@extends('layouts.admin')

@section('title', 'Destinasi Wisata & Kawasan Budaya — SANTI Admin')
@section('header_title', 'Destinasi Wisata & Kawasan Budaya Bali')

@section('content')
<div class="space-y-6">
    <!-- Header Controls & Search -->
    <div class="bg-white dark:bg-[#132B22] rounded-3xl p-5 sm:p-6 border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.locations.index') }}" class="flex-grow flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Search Input -->
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari destinasi, pura, desa adat, atau kabupaten..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Status Filter -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif Publik</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif (Draft)</option>
            </select>

            <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] text-white text-xs font-bold hover:bg-[#21845B]">Cari</button>
            @if(request('search') || request()->has('status'))
                <a href="{{ route('admin.locations.index') }}" class="px-3 py-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-xs text-[#5A6961] dark:text-[#A7B9AF] hover:text-black dark:hover:text-white text-center">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.locations.create') }}" class="px-4.5 py-2.5 rounded-xl bg-[#21845B] hover:bg-[#1a6e4b] text-white font-bold text-xs shadow-xs transition-colors flex items-center justify-center space-x-1.5 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Destinasi Baru</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-[#132B22] rounded-3xl border border-[#174D3B]/10 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#F8F6EF] dark:bg-[#16352A] text-[#174D3B] dark:text-[#A7D9B8] uppercase text-[10px] tracking-wider font-bold border-b border-[#174D3B]/10 dark:border-white/10">
                    <tr>
                        <th class="px-5 py-3.5">Nama Destinasi & Wilayah</th>
                        <th class="px-4 py-3.5">Slug URL</th>
                        <th class="px-4 py-3.5 text-center">Jumlah Aturan</th>
                        <th class="px-4 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5 text-[#202A25] dark:text-[#F8F6EF]">
                    @forelse($locations as $location)
                        <tr class="hover:bg-[#F8F6EF]/50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-5 py-4">
                                <div class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-sm">
                                    {{ $location->name }}
                                </div>
                                <div class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">
                                    📍 {{ $location->address ?? 'Provinsi Bali' }}
                                </div>
                            </td>
                            <td class="px-4 py-4 font-mono text-[11px] text-gray-500 dark:text-gray-400">
                                /panduan/{{ $location->slug }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('admin.cultural-rules.index', ['location_id' => $location->id]) }}"
                                   class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#DDF2DF] dark:bg-[#21845B]/25 text-[#174D3B] dark:text-[#A7D9B8] font-bold text-[11px] hover:bg-[#c9e8cd]">
                                    <span>{{ $location->cultural_rules_count }} aturan</span>
                                    <span>&rarr;</span>
                                </a>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('admin.locations.toggle', $location) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="Klik untuk mengubah status aktif" class="cursor-pointer">
                                        @if($location->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300">
                                                ● Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                                ○ Nonaktif
                                            </span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center space-x-1.5">
                                    <!-- View Public Link -->
                                    <a href="{{ route('guidelines.show', $location) }}" target="_blank" title="Lihat di Web Publik"
                                       class="p-1.5 rounded-lg bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 hover:text-[#174D3B]">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    <!-- Edit Link -->
                                    <a href="{{ route('admin.locations.edit', $location) }}" title="Edit Destinasi"
                                       class="p-1.5 rounded-lg bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#A7D9B8] hover:bg-[#c9e8cd]">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.locations.destroy', $location) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi \'{{ $location->name }}\'? Seluruh data aturan budaya terkait juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Destinasi" class="p-1.5 rounded-lg bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 hover:bg-red-100 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-gray-400">
                                Tidak ada destinasi yang cocok dengan pencarian Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($locations->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-white/10 bg-[#F8F6EF]/50 dark:bg-white/5">
                {{ $locations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

