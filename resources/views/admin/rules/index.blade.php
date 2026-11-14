@extends('layouts.admin')

@section('title', 'Aturan & Etika Adat — SANTI Admin')
@section('header_title', 'Basis Data Aturan & Etika Adat Bali')

@section('content')
<div class="space-y-6">
    <!-- Header Controls & Filter -->
    <div class="bg-white dark:bg-[#132B22] rounded-3xl p-5 sm:p-6 border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.cultural-rules.index') }}" class="flex-grow flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Search Input -->
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kata kunci aturan, SE Gubernur, atau busana..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Location Filter -->
            <select name="location_id" onchange="this.form.submit()" class="px-3 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <option value="">Semua Destinasi</option>
                @foreach($locations as $loc)
                    <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>
                        {{ $loc->name }}
                    </option>
                @endforeach
            </select>

            <!-- Category Filter -->
            <select name="category" onchange="this.form.submit()" class="px-3 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B]">
                <option value="">Semua Kategori</option>
                <option value="dress_code" {{ request('category') === 'dress_code' ? 'selected' : '' }}>Busana (Dress Code)</option>
                <option value="sacred_area" {{ request('category') === 'sacred_area' ? 'selected' : '' }}>Kawasan Sakral</option>
                <option value="behavior" {{ request('category') === 'behavior' ? 'selected' : '' }}>Tata Krama</option>
                <option value="photography" {{ request('category') === 'photography' ? 'selected' : '' }}>Foto & Drone</option>
                <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>Aturan Umum</option>
            </select>

            <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#174D3B] dark:bg-[#21845B] text-white text-xs font-bold hover:bg-[#21845B]">Filter</button>
            @if(request('search') || request('location_id') || request('category'))
                <a href="{{ route('admin.cultural-rules.index') }}" class="px-3 py-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-xs text-[#5A6961] dark:text-[#A7B9AF] hover:text-black dark:hover:text-white text-center">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.cultural-rules.create', ['location_id' => request('location_id')]) }}" class="px-4.5 py-2.5 rounded-xl bg-[#21845B] hover:bg-[#1a6e4b] text-white font-bold text-xs shadow-xs transition-colors flex items-center justify-center space-x-1.5 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Aturan Adat</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-[#132B22] rounded-3xl border border-[#174D3B]/10 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#F8F6EF] dark:bg-[#16352A] text-[#174D3B] dark:text-[#A7D9B8] uppercase text-[10px] tracking-wider font-bold border-b border-[#174D3B]/10 dark:border-white/10">
                    <tr>
                        <th class="px-5 py-3.5">Aturan & Destinasi</th>
                        <th class="px-4 py-3.5">Kategori</th>
                        <th class="px-4 py-3.5">Rujukan Resmi</th>
                        <th class="px-4 py-3.5 text-center">Verifikasi AI</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5 text-[#202A25] dark:text-[#F8F6EF]">
                    @forelse($rules as $rule)
                        <tr class="hover:bg-[#F8F6EF]/50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-5 py-4 max-w-md">
                                <div class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-sm">
                                    {{ $rule->title }}
                                </div>
                                <div class="text-[11px] text-[#21845B] dark:text-[#A7D9B8] font-semibold mt-0.5">
                                    📍 {{ $rule->location->name ?? 'Seluruh Bali' }}
                                </div>
                                <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF] mt-1 line-clamp-2">
                                    {{ $rule->content }}
                                </p>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @php
                                    $catLabels = [
                                        'dress_code' => ['Busana', 'bg-purple-100 text-purple-800 dark:bg-purple-950/50 dark:text-purple-300'],
                                        'sacred_area' => ['Zona Sakral', 'bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-300'],
                                        'behavior' => ['Tata Krama', 'bg-blue-100 text-blue-800 dark:bg-blue-950/50 dark:text-blue-300'],
                                        'photography' => ['Foto & Drone', 'bg-rose-100 text-rose-800 dark:bg-rose-950/50 dark:text-rose-300'],
                                        'general' => ['Aturan Umum', 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300'],
                                    ];
                                    $badge = $catLabels[$rule->category] ?? ['Lainnya', 'bg-gray-100 text-gray-800'];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $badge[1] }}">
                                    {{ $badge[0] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-[11px] text-[#5A6961] dark:text-[#A7B9AF]">
                                <div>{{ $rule->source_name ?? 'Pedoman Adat Resmi' }}</div>
                                @if($rule->source_url)
                                    <a href="{{ $rule->source_url }}" target="_blank" class="text-[#21845B] hover:underline text-[10px] block truncate max-w-[180px]">
                                        {{ $rule->source_url }} ↗
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('admin.cultural-rules.toggle-verify', $rule) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="Klik untuk mengubah verifikasi AI" class="cursor-pointer">
                                        @if($rule->is_verified)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300">
                                                ✓ Terverifikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-500">
                                                ? Belum
                                            </span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center space-x-1.5">
                                    <a href="{{ route('admin.cultural-rules.edit', $rule) }}" title="Edit Aturan"
                                       class="p-1.5 rounded-lg bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#A7D9B8] hover:bg-[#c9e8cd]">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>

                                    <form action="{{ route('admin.cultural-rules.destroy', $rule) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus aturan \'{{ $rule->title }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Aturan" class="p-1.5 rounded-lg bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 hover:bg-red-100 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-gray-400">
                                Belum ada aturan adat yang terdaftar dengan kriteria ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($rules->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-white/10 bg-[#F8F6EF]/50 dark:bg-white/5">
                {{ $rules->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
