@extends('layouts.admin')

@section('title', 'Dashboard Ringkasan — SANTI Admin')
@section('header_title', 'Ringkasan dan Statistik Budaya')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Total Destinasi -->
        <div class="p-5 rounded-3xl bg-white dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs text-[#5A6961] dark:text-[#A7B9AF] font-medium block">Total Destinasi Budaya</span>
                <span class="text-2xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] block">{{ $totalLocations }}</span>
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold">{{ $activeLocations }} aktif di publik</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 dark:bg-[#21845B]/25 text-emerald-700 dark:text-[#A7D9B8] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>

        <!-- Total Aturan Adat -->
        <div class="p-5 rounded-3xl bg-white dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs text-[#5A6961] dark:text-[#A7B9AF] font-medium block">Total Aturan Adat</span>
                <span class="text-2xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] block">{{ $totalRules }}</span>
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold">{{ $verifiedRules }} aturan terverifikasi</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-amber-50 dark:bg-[#C6A15B]/20 text-amber-700 dark:text-[#E5C378] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>

        <!-- Akurasi Anti-Halusinasi -->
        <div class="p-5 rounded-3xl bg-white dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs text-[#5A6961] dark:text-[#A7B9AF] font-medium block">Integritas Budaya AI</span>
                <span class="text-2xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] block">
                    {{ $totalRules > 0 ? round(($verifiedRules / $totalRules) * 100) : 100 }}%
                </span>
                <span class="text-[10px] text-[#5A6961] dark:text-[#A7B9AF]">Tergrounding SE No. 4/2023</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-700 dark:text-indigo-300 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        </div>

        <!-- Akun Pengelola -->
        <div class="p-5 rounded-3xl bg-white dark:bg-[#132B22] border border-[#174D3B]/10 dark:border-white/10 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs text-[#5A6961] dark:text-[#A7B9AF] font-medium block">Pengelola Aktif</span>
                <span class="text-2xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] block">{{ $totalUsers }}</span>
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold">Administrator Resmi</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-teal-50 dark:bg-teal-950/40 text-teal-700 dark:text-teal-300 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
        </div>
    </div>

    <!-- Quick Actions Banner -->
    <div class="p-6 rounded-3xl bg-[#174D3B] dark:bg-[#133E2F] text-white shadow-lg border border-[#21845B]/40 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div class="space-y-1">
            <h3 class="text-lg font-extrabold tracking-tight">Kelola Konten dan Pedoman Adat Bali</h3>
            <p class="text-xs text-white/80 max-w-xl">
                Tambah atau ubah destinasi pariwisata, perbarui aturan tata busana pura, dan sesuaikan teks informasi pada beranda publik secara langsung.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.locations.create') }}" class="px-4 py-2.5 rounded-xl bg-white hover:bg-[#DDF2DF] text-[#174D3B] font-bold text-xs shadow-xs transition-colors flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Destinasi</span>
            </a>
            <a href="{{ route('admin.cultural-rules.create') }}" class="px-4 py-2.5 rounded-xl bg-[#21845B] hover:bg-[#1a6e4b] text-white font-bold text-xs shadow-xs transition-colors flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Aturan Adat</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20 transition-colors">
                <span>Edit Beranda</span>
            </a>
        </div>
    </div>

    <!-- 2-Column Tables (Recent Locations & Recent Rules) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Locations Card -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-white/10">
                <h4 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF] flex items-center space-x-2">
                    <svg class="w-4 h-4 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    <span>Destinasi Terakhir Diperbarui</span>
                </h4>
                <a href="{{ route('admin.locations.index') }}" class="text-xs font-semibold text-[#21845B] dark:text-[#A7D9B8] hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-white/5 text-xs">
                @foreach($recentLocations as $loc)
                    <div class="py-3 flex items-center justify-between gap-3">
                        <div class="overflow-hidden">
                            <a href="{{ route('admin.locations.edit', $loc) }}" class="font-bold text-[#202A25] dark:text-[#F8F6EF] hover:text-[#21845B] truncate block">
                                {{ $loc->name }}
                            </a>
                            <span class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF] block truncate">{{ $loc->address ?? 'Bali' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 shrink-0">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#DDF2DF] dark:bg-[#21845B]/30 text-[#174D3B] dark:text-[#A7D9B8]">
                                {{ $loc->cultural_rules_count }} aturan
                            </span>
                            <a href="{{ route('admin.locations.edit', $loc) }}" class="p-1 rounded-lg text-gray-400 hover:text-[#174D3B] dark:hover:text-white">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Rules Card -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-6 border border-[#174D3B]/10 dark:border-white/10 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-white/10">
                <h4 class="text-sm font-bold text-[#174D3B] dark:text-[#DDF2DF] flex items-center space-x-2">
                    <svg class="w-4 h-4 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Aturan Budaya Terbaru</span>
                </h4>
                <a href="{{ route('admin.cultural-rules.index') }}" class="text-xs font-semibold text-[#21845B] dark:text-[#A7D9B8] hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-white/5 text-xs">
                @foreach($recentRules as $rule)
                    <div class="py-3 flex items-center justify-between gap-3">
                        <div class="overflow-hidden">
                            <a href="{{ route('admin.cultural-rules.edit', $rule) }}" class="font-bold text-[#202A25] dark:text-[#F8F6EF] hover:text-[#21845B] truncate block">
                                {{ $rule->title }}
                            </a>
                            <span class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF] block truncate">
                                📍 {{ $rule->location->name ?? 'Seluruh Bali' }} • {{ ucfirst(str_replace('_', ' ', $rule->category)) }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2 shrink-0">
                            @if($rule->is_verified)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300">Terverifikasi</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">Draft</span>
                            @endif
                            <a href="{{ route('admin.cultural-rules.edit', $rule) }}" class="p-1 rounded-lg text-gray-400 hover:text-[#174D3B] dark:hover:text-white">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
