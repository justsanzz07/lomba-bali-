@extends('layouts.app')

@section('title', 'Login Panel Pengelola — SANTI AI Cultural Guardian')

@section('content')
<div class="min-h-screen pt-28 pb-16 bg-[#F8F6EF] dark:bg-[#0B1E17] flex items-center justify-center px-4 transition-colors duration-200">
    <div class="max-w-md w-full space-y-6">
        <!-- Brand Header -->
        <div class="text-center space-y-2">
            <a href="{{ route('landing') }}" class="inline-flex items-center justify-center space-x-3 group">
                <div class="w-12 h-12 rounded-full bg-[#174D3B] dark:bg-[#21845B] border border-white/20 flex items-center justify-center text-white font-bold text-base shadow-md group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 3-1.9 5.8a2 2 0 0 1-1.28 1.28L3 12l5.8 1.9a2 2 0 0 1 1.28 1.28L12 21l1.9-5.8a2 2 0 0 1 1.28-1.28Z"/>
                        <circle cx="12" cy="12" r="2.5"/>
                    </svg>
                </div>
            </a>
            <h1 class="text-2xl font-extrabold text-[#174D3B] dark:text-[#DDF2DF] tracking-tight">Panel Pengelola Santi AI</h1>
            <p class="text-xs text-[#5A6961] dark:text-[#A7B9AF]">Masuk untuk mengelola destinasi budaya, aturan adat, dan konten halaman depan.</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl p-7 sm:p-8 shadow-xl border border-[#174D3B]/10 dark:border-white/10 transition-colors">
            @if(session('info'))
                <div class="mb-5 p-3.5 rounded-2xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-xs text-blue-800 dark:text-blue-300 flex items-center space-x-2">
                    <svg class="w-4 h-4 shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-xs text-red-800 dark:text-red-300 space-y-1">
                    @foreach($errors->all() as $err)
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $err }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="admin@santi.bali"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B] focus:border-transparent transition-all">
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] focus:outline-none focus:ring-2 focus:ring-[#21845B] focus:border-transparent transition-all">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#21845B] focus:ring-[#21845B] border-gray-300 dark:border-white/20 bg-white dark:bg-[#0E231B]">
                        <span class="text-[#5A6961] dark:text-[#A7B9AF]">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] dark:hover:bg-[#1a6e4b] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center space-x-2">
                        <span>Masuk ke Panel Pengelola</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

            <!-- Demo Account Credentials Info Box -->
            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-white/10 text-xs text-[#5A6961] dark:text-[#A7B9AF] space-y-1.5">
                <p class="font-bold text-[#174D3B] dark:text-[#DDF2DF] flex items-center space-x-1.5">
                    <svg class="w-3.5 h-3.5 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Akun Pengelola Default:</span>
                </p>
                <div class="p-2.5 rounded-xl bg-[#F8F6EF] dark:bg-[#0E231B] font-mono text-[11px] space-y-0.5 border border-[#174D3B]/10 dark:border-white/5">
                    <div>Email: <strong class="text-[#174D3B] dark:text-white">admin@santi.bali</strong></div>
                    <div>Password: <strong class="text-[#174D3B] dark:text-white">SantiBali2026!</strong></div>
                </div>
            </div>
        </div>

        <!-- Back to Website Link -->
        <div class="text-center">
            <a href="{{ route('landing') }}" class="text-xs text-[#174D3B] dark:text-[#A7D9B8] hover:underline inline-flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Website Publik</span>
            </a>
        </div>
    </div>
</div>
@endsection
