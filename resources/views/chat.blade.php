@extends('layouts.app')

@section('title', $location->slug === 'seluruh-bali' ? 'Santi AI Cultural Guardian — Seluruh Wisata Bali' : 'Santi AI Guardian — ' . $location->name)

@section('content')
<div class="pt-28 pb-14 bg-[#F8F6EF] dark:bg-[#0B1E17] min-h-screen flex flex-col justify-between transition-colors duration-200">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex-grow flex flex-col space-y-4">
        <!-- Top Location Header Bar (Grounded & Premium) -->
        <div class="bg-white/90 dark:bg-[#16352A]/90 backdrop-blur-md rounded-2xl p-4 shadow-sm border border-[#174D3B]/10 dark:border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 transition-colors">
            <div class="flex items-center space-x-3.5">
                <a href="{{ route('locations.index') }}" title="Daftar Seluruh Destinasi Wisata" class="w-10 h-10 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-[#174D3B] hover:text-white text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-center transition-colors shadow-2xs group shrink-0">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>

                <!-- Location Thumbnail -->
                <div class="relative w-11 h-11 rounded-xl overflow-hidden shrink-0 border border-gray-200 dark:border-white/15 shadow-2xs">
                    <img src="{{ asset($locationImage) }}" alt="{{ $location->name }}" class="w-full h-full object-cover">
                </div>

                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Destination Quick Switcher Dropdown -->
                        <div class="relative inline-block">
                            <select id="destination-switcher" onchange="window.location.href = this.value" class="appearance-none pl-2.5 pr-7 py-1 rounded-lg bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-white dark:hover:bg-[#21845B]/20 border border-[#174D3B]/20 dark:border-white/15 font-extrabold text-sm sm:text-base text-[#174D3B] dark:text-[#DDF2DF] focus:outline-none focus:ring-2 focus:ring-[#21845B] cursor-pointer shadow-2xs transition-colors max-w-[210px] sm:max-w-xs md:max-w-md truncate">
                                <option value="{{ route('santi.index') }}" {{ $location->slug === 'seluruh-bali' ? 'selected' : '' }}>
                                    🌐 Seluruh Wisata & Budaya Bali (Semua)
                                </option>
                                <optgroup label="Destinasi Wisata Spesifik:">
                                    @foreach($allLocations as $loc)
                                        @if($loc->slug !== 'seluruh-bali')
                                            <option value="{{ route('santi.show', $loc->slug) }}" {{ $location->slug === $loc->slug ? 'selected' : '' }}>
                                                {{ $loc->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1.5 text-[#174D3B] dark:text-[#DDF2DF]">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#21845B]/15 text-[#21845B] dark:text-[#A7D9B8]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#21845B]"></span>
                            <span>{{ $location->slug === 'seluruh-bali' ? 'Cakupan Seluruh Bali' : 'Kawasan Aktif' }}</span>
                        </span>
                    </div>
                    @if($location->address)
                        <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF] truncate max-w-xs sm:max-w-md flex items-center space-x-1 mt-0.5">
                            <svg class="w-3 h-3 text-[#C6A15B] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $location->address }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Header Controls: Guidelines Link, Language Selector & Reset -->
            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                <!-- Direct Link to Written Guidelines -->
                @if($location->slug === 'seluruh-bali')
                    <a href="{{ route('locations.index') }}" class="inline-flex items-center space-x-1.5 px-3 py-2 rounded-xl bg-[#DDF2DF]/80 hover:bg-[#DDF2DF] dark:bg-[#21845B]/25 dark:hover:bg-[#21845B]/40 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold transition-all shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="hidden md:inline">Katalog Destinasi</span>
                        <span class="md:hidden">Destinasi</span>
                    </a>
                @else
                    <a href="{{ route('guidelines.show', $location->slug) }}" class="inline-flex items-center space-x-1.5 px-3 py-2 rounded-xl bg-[#DDF2DF]/80 hover:bg-[#DDF2DF] dark:bg-[#21845B]/25 dark:hover:bg-[#21845B]/40 text-[#174D3B] dark:text-[#A7D9B8] text-xs font-bold transition-all shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="hidden md:inline">Buku Panduan Adat</span>
                        <span class="md:hidden">Panduan</span>
                    </a>
                @endif

                <!-- Multi-Language Selector Dropdown -->
                <div class="relative">
                    <select id="chat-lang-select" class="appearance-none pl-3 pr-8 py-2 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-white dark:hover:bg-[#21845B]/20 border border-[#174D3B]/20 dark:border-white/10 text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF] focus:outline-none focus:ring-2 focus:ring-[#21845B] cursor-pointer shadow-2xs transition-colors">
                        <option value="id" {{ app()->getLocale() === 'id' ? 'selected' : '' }}>🇮🇩 ID (Indonesia)</option>
                        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>🇬🇧 EN (English)</option>
                        <option value="zh" {{ app()->getLocale() === 'zh' ? 'selected' : '' }}>🇨🇳 ZH (中文)</option>
                        <option value="ja" {{ app()->getLocale() === 'ja' ? 'selected' : '' }}>🇯🇵 JA (日本語)</option>
                        <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>🇷🇺 RU (Русский)</option>
                        <option value="fr" {{ app()->getLocale() === 'fr' ? 'selected' : '' }}>🇫🇷 FR (Français)</option>
                        <option value="de" {{ app()->getLocale() === 'de' ? 'selected' : '' }}>🇩🇪 DE (Deutsch)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#174D3B] dark:text-[#DDF2DF]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Reset Chat -->
                <button type="button" id="new-chat-btn" title="Mulai Percakapan Baru" class="p-2 sm:px-3 sm:py-2 rounded-xl bg-[#F8F6EF] dark:bg-[#1D4436] hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-950/40 dark:hover:text-red-300 text-[#5A6961] dark:text-[#C1D1C7] text-xs font-semibold flex items-center space-x-1.5 transition-colors cursor-pointer shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span class="hidden sm:inline">Reset</span>
                </button>
            </div>
        </div>

        <!-- Chat Main Container Card -->
        <div class="bg-white dark:bg-[#132B22] rounded-3xl shadow-xl border border-[#174D3B]/10 dark:border-white/10 flex flex-col h-[70vh] sm:h-[74vh] overflow-hidden transition-colors">
            <!-- Sub-Header Status Strip -->
            <div class="px-4 sm:px-6 py-2.5 bg-[#F8F6EF]/80 dark:bg-[#16352A]/80 border-b border-[#174D3B]/10 dark:border-white/10 flex items-center justify-between text-xs">
                <div class="flex items-center space-x-2">
                    <div class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#21845B] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#21845B]"></span>
                    </div>
                    <span class="font-bold text-[#174D3B] dark:text-[#DDF2DF] text-xs">Santi AI Cultural Guardian</span>
                    <span class="text-[10px] text-gray-400 dark:text-gray-500 hidden sm:inline">• Menjawab Berdasarkan Rujukan Terverifikasi</span>
                </div>
                <div class="flex items-center space-x-1 text-[11px] font-semibold text-[#C6A15B]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span>SE No. 4/2023 & Awig-Awig</span>
                </div>
            </div>

            <!-- Messages Scroll Area -->
            <div id="chat-messages" class="flex-grow p-4 sm:p-6 overflow-y-auto space-y-4 scroll-smooth">
                <!-- Initial Welcome Message from Santi -->
                <div class="flex items-start space-x-3 message-item" data-role="model">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#174D3B] to-[#21845B] text-[#C6A15B] flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-xs border border-white/20">
                        S
                    </div>
                    <div class="flex flex-col space-y-1.5 max-w-[90%] sm:max-w-[82%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Santi AI Cultural Guardian</span>
                            <span class="text-[10px] text-gray-400">Aktif</span>
                        </div>
                        <div class="bg-[#F8F6EF] dark:bg-[#1A3E31] border border-[#C6A15B]/30 rounded-2xl rounded-tl-xs p-4 sm:p-4.5 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] leading-relaxed shadow-xs space-y-2">
                            <p class="font-bold text-[#174D3B] dark:text-[#E5C378] text-sm" id="greeting-title">
                                @if($location->slug === 'seluruh-bali')
                                    Om Swastiastu! Rahajeng rauh ring Bali. 🙏
                                @else
                                    Om Swastiastu! Rahajeng rauh ring {{ $location->name }}. 🙏
                                @endif
                            </p>
                            <p id="greeting-desc">
                                @if($location->slug === 'seluruh-bali')
                                    Saya <strong>Santi</strong>, asisten pemandu kebudayaan & pariwisata virtual Bali. Saya siap mendampingi Anda memahami tata krama adat, etika berkunjung, ketentuan busana, etika di pantai, desa adat, pura, gunung, hingga regulasi resmi <strong>SE Gubernur Bali No. 4/2023</strong> untuk <strong>seluruh destinasi wisata di Bali</strong> berdasarkan rujukan resmi yang terverifikasi.
                                @else
                                    Saya <strong>Santi</strong>, asisten pemandu kebudayaan & pariwisata virtual Anda. Saya siap membantu Anda memahami tata krama adat, ketentuan busana, etika berkunjung, norma kesopanan lokal, serta panduan seluruh destinasi wisata di Bali di kawasan <strong>{{ $location->name }}</strong> berdasarkan rujukan resmi terverifikasi.
                                @endif
                            </p>
                            <p class="text-[11px] text-[#5A6961] dark:text-[#A7B9AF]" id="greeting-hint">
                                @if($location->slug === 'seluruh-bali')
                                    Silakan pilih pertanyaan yang disarankan di bawah ini atau tanyakan apa saja seputar etika wisata & kebudayaan Bali.
                                @else
                                    Silakan pilih pertanyaan yang disarankan di bawah ini atau ketik pertanyaan bebas Anda seputar wisata dan budaya Bali.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Verified Rules Summary Pill in Initial State -->
                @if($location->slug === 'seluruh-bali')
                    <div class="px-4 py-2.5 rounded-xl bg-[#21845B]/10 dark:bg-[#21845B]/20 border border-[#21845B]/20 dark:border-[#21845B]/30 text-[11px] text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span>Basis data terverifikasi aktif: <strong>Seluruh pedoman dresta adat & regulasi pariwisata resmi (SE Gubernur Bali No. 4/2023)</strong> terintegrasi.</span>
                        </div>
                    </div>
                @elseif($location->verifiedCulturalRules->count() > 0)
                    <div class="px-4 py-2.5 rounded-xl bg-[#21845B]/10 dark:bg-[#21845B]/20 border border-[#21845B]/20 dark:border-[#21845B]/30 text-[11px] text-[#174D3B] dark:text-[#DDF2DF] flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span>Basis data terverifikasi aktif: <strong>{{ $location->verifiedCulturalRules->count() }} pedoman dresta adat & etika wisata</strong> untuk destinasi ini.</span>
                        </div>
                    </div>
                @else
                    <div class="px-4 py-2.5 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 text-[11px] text-amber-800 dark:text-amber-200 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>Peringatan: Lokasi ini adalah lokasi simulasi dan belum memiliki pedoman adat terverifikasi resmi di basis data Santi.</span>
                    </div>
                @endif
            </div>

            <!-- Loading Indicator Box (Hidden by default) -->
            <div id="loading-indicator" class="hidden px-5 py-3 border-t border-gray-100 dark:border-white/10 bg-[#F8F6EF]/60 dark:bg-[#16352A]/60">
                <div class="flex items-center space-x-3 text-xs text-[#174D3B] dark:text-[#DDF2DF]">
                    <div class="flex space-x-1.5">
                        <div class="w-2 h-2 rounded-full bg-[#174D3B] dark:bg-[#DDF2DF] animate-bounce"></div>
                        <div class="w-2 h-2 rounded-full bg-[#21845B] animate-bounce [animation-delay:0.2s]"></div>
                        <div class="w-2 h-2 rounded-full bg-[#C6A15B] animate-bounce [animation-delay:0.4s]"></div>
                    </div>
                    <span id="loading-text" class="font-medium">Santi sedang memverifikasi pedoman adat dan merumuskan jawaban...</span>
                </div>
            </div>

            <!-- Suggested Questions Carousel / Chips -->
            <div class="px-4 py-2.5 bg-[#F8F6EF]/70 dark:bg-[#16352A]/40 border-t border-gray-100 dark:border-white/10 overflow-x-auto">
                <div class="flex items-center space-x-2 text-xs" id="suggested-questions-container">
                    <span class="text-[11px] font-bold text-[#5A6961] dark:text-[#A7B9AF] whitespace-nowrap">Saran:</span>
                    @foreach($suggestedQuestions['id'] as $index => $sq)
                        <button type="button" class="suggested-btn whitespace-nowrap px-3 py-1.5 rounded-full bg-white dark:bg-[#1D4436] hover:bg-[#174D3B] dark:hover:bg-[#21845B] text-[#174D3B] dark:text-[#DDF2DF] hover:text-white border border-[#174D3B]/20 dark:border-white/10 text-xs transition-colors shadow-2xs cursor-pointer">
                            {{ $sq }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Input Form Box -->
            <div class="p-3 sm:p-4 bg-white dark:bg-[#16352A] border-t border-gray-100 dark:border-white/10">
                <form id="chat-form" class="flex items-center space-x-2">
                    <div class="relative flex-grow">
                        <input type="text" id="user-input" maxlength="1000" autocomplete="off"
                            placeholder="Tanyakan etika wisata, busana pura, aturan pantai, desa adat, atau budaya Bali..."
                            class="w-full pl-4 pr-12 py-3 rounded-2xl bg-[#F8F6EF] dark:bg-[#0E231B] border border-[#174D3B]/20 dark:border-white/10 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#21845B] focus:border-transparent transition-all shadow-inner">
                        <span id="char-counter" class="absolute right-3.5 top-3.5 text-[10px] text-gray-400 dark:text-gray-500">1000</span>
                    </div>

                    <button type="submit" id="send-btn"
                        class="px-5 py-3 rounded-2xl bg-[#174D3B] dark:bg-[#21845B] hover:bg-[#21845B] dark:hover:bg-[#1a6e4b] text-white text-xs sm:text-sm font-bold flex items-center space-x-2 shadow-sm hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer shrink-0">
                        <span>Kirim</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
                <div class="mt-2 text-[10px] text-gray-400 dark:text-gray-500 text-center flex items-center justify-center space-x-2">
                    <span>Santi AI Cultural Guardian • Menghormati Dresta Bali</span>
                    <span>•</span>
                    <span>Gemini AI Engine</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const locationSlug = "{{ $location->slug }}";
        const locationName = "{{ $location->name }}";
        const isGeneralMode = @json($location->slug === 'seluruh-bali');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const chatMessages = document.getElementById('chat-messages');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const loadingIndicator = document.getElementById('loading-indicator');
        const loadingText = document.getElementById('loading-text');
        const charCounter = document.getElementById('char-counter');
        const newChatBtn = document.getElementById('new-chat-btn');

        const chatLangSelect = document.getElementById('chat-lang-select');
        const greetingTitle = document.getElementById('greeting-title');
        const greetingDesc = document.getElementById('greeting-desc');
        const greetingHint = document.getElementById('greeting-hint');
        const suggestedContainer = document.getElementById('suggested-questions-container');

        const allSuggestedQuestions = @json($suggestedQuestions);

        const greetings = {
            'id': {
                'title': isGeneralMode ? 'Om Swastiastu! Rahajeng rauh ring Bali. 🙏' : `Om Swastiastu! Rahajeng rauh ring ${locationName}. 🙏`,
                'desc': isGeneralMode ? 'Saya <strong>Santi</strong>, asisten pemandu kebudayaan & pariwisata virtual Bali. Saya siap mendampingi Anda memahami tata krama adat, ketentuan busana, etika di pantai, desa adat, pura, gunung, hingga regulasi resmi <strong>SE Gubernur Bali No. 4/2023</strong> untuk <strong>seluruh destinasi wisata di Bali</strong> berdasarkan rujukan resmi yang terverifikasi.' : `Saya <strong>Santi</strong>, asisten pemandu kebudayaan & pariwisata virtual Anda. Saya siap membantu Anda memahami tata krama adat, ketentuan busana, etika berkunjung, norma kesopanan lokal, serta panduan seluruh destinasi wisata di Bali di kawasan <strong>${locationName}</strong> berdasarkan rujukan resmi terverifikasi.`,
                'hint': isGeneralMode ? 'Silakan pilih pertanyaan yang disarankan di bawah ini atau tanyakan apa saja seputar etika wisata & kebudayaan Bali.' : 'Silakan pilih pertanyaan yang disarankan di bawah ini atau ketik pertanyaan bebas Anda.',
                'placeholder': 'Tanyakan etika wisata, busana pura, aturan pantai, desa adat, atau budaya Bali...',
                'loading': 'Santi sedang memverifikasi pedoman adat dan merumuskan jawaban...',
                'you': 'Anda',
                'send': 'Kirim',
                'label_saran': 'Saran:',
                'confirm_reset': 'Mulai sesi percakapan baru dengan Santi?',
                'error_server': 'Terjadi kendala pada server saat memproses pertanyaan.',
                'error_network': 'Koneksi ke server terputus. Silakan periksa jaringan internet Anda.'
            },
            'en': {
                'title': isGeneralMode ? 'Om Swastiastu! Welcome to Bali. 🙏' : `Om Swastiastu! Welcome to ${locationName}. 🙏`,
                'desc': isGeneralMode ? 'I am <strong>Santi</strong>, your AI Cultural Guardian for Bali. I am here to help you understand customary etiquette, beach rules, cultural village norms, temple dress codes, mountain regulations, and official guidelines under <strong>Bali Governor Circular No. 4/2023</strong> across <strong>all destinations in Bali</strong>.' : `I am <strong>Santi</strong>, your AI Cultural Guardian. I am here to help you understand sacred etiquette, dress codes, beach and village guidelines, and visitor regulations at <strong>${locationName}</strong> and across Bali based on verified official regulations.`,
                'hint': 'Please select one of the suggested questions below or type your own question freely.',
                'placeholder': 'Ask about cultural etiquette, dress codes, beaches, villages, or Bali travel rules...',
                'loading': 'Santi is verifying customary guidelines and crafting your answer...',
                'you': 'You',
                'send': 'Send',
                'label_saran': 'Suggestions:',
                'confirm_reset': 'Start a fresh conversation with Santi?',
                'error_server': 'A server error occurred while processing your query.',
                'error_network': 'Network error. Please check your internet connection.'
            },
            'zh': {
                'title': isGeneralMode ? 'Om Swastiastu! 欢迎来到巴厘岛。🙏' : `Om Swastiastu! 欢迎来到 ${locationName}。🙏`,
                'desc': isGeneralMode ? '我是您的智能文化向导 <strong>Santi</strong>。我很荣幸协助您全面了解<strong>全巴厘岛</strong>（包括沙滩、传统村落、圣庙、火山与文化景观）的民俗礼仪、着装规范与官方文明旅游准则（SE 4/2023）。' : `我是您的智能文化向导 <strong>Santi</strong>。我很荣幸协助您了解 <strong>${locationName}</strong> 以及全巴厘岛（海滩、传统村落、圣庙、火山与文化景观）的民俗礼仪、着装规范与官方文明旅游准则。`,
                'hint': '请选择以下推荐问题，或直接输入您的疑问。',
                'placeholder': '询问着装规范、海滩村落礼仪或巴厘岛旅游规则...',
                'loading': 'Santi 正在对照传统村规验证并生成权威建议...',
                'you': '您',
                'send': '发送',
                'label_saran': '推荐问题:',
                'confirm_reset': '开始与 Santi 的全新对话？',
                'error_server': '服务器处理问题时发生故障。',
                'error_network': '网络连接中断，请检查您的网络设置。'
            },
            'ja': {
                'title': isGeneralMode ? 'Om Swastiastu! バリ島へようこそ。🙏' : `Om Swastiastu! ${locationName} へようこそ。🙏`,
                'desc': isGeneralMode ? '私はあなたのAI文化ガーディアン <strong>Santi</strong> です。公式に認証された慣習記録に基づき、<strong>バリ島全域</strong>（寺院、ビーチ、伝統村、聖山）における服装規定、礼儀作法、旅行者ガイドライン（州知事令2023年第4号）をご案内します。' : `私はあなたのAI文化ガーディアン <strong>Santi</strong> です。公式に認証された慣習記録に基づき、<strong>${locationName}</strong> やバリ島全域（寺院、ビーチ、伝統村、聖山）における服装規定、礼儀作法、旅行者ガイドラインをご案内します。`,
                'hint': '以下の質問候補を選択するか、自由にご質問を入力してください。',
                'placeholder': '服装規定、ビーチや寺院、村落のマナーについて質問する...',
                'loading': 'Santiが慣習法を確認し、回答を生成しています...',
                'you': 'あなた',
                'send': '送信',
                'label_saran': 'おすすめの質問:',
                'confirm_reset': '新しいチャットセッションを開始しますか？',
                'error_server': 'サーバーエラーが発生しました。',
                'error_network': 'ネットワークエラーです。接続を確認してください。'
            },
            'ru': {
                'title': isGeneralMode ? 'Om Swastiastu! Добро пожаловать на Бали. 🙏' : `Om Swastiastu! Добро пожаловать в ${locationName}. 🙏`,
                'desc': isGeneralMode ? 'Я <strong>Santi</strong>, ваш виртуальный ИИ-хранитель культуры Бали. Я помогу вам разобраться в правилах поведения, дресс-коде, этикете на пляжах, в деревнях, храмах и священных горах <strong>по всему Бали</strong>.' : `Я <strong>Santi</strong>, ваш виртуальный ИИ-хранитель культуры. Я помогу вам разобраться в правилах поведения, дресс-коде, этикете на пляжах, в деревнях, храмах и священных горах в <strong>${locationName}</strong> и по всему Бали.`,
                'hint': 'Выберите один из предложенных вопросов ниже или напишите свой.',
                'placeholder': 'Спросите об этикете, дресс-коде, правилах на пляжах или храмах...',
                'loading': 'Santi проверяет традиции общины и готовит ответ...',
                'you': 'Вы',
                'send': 'Отправить',
                'label_saran': 'Примеры:',
                'confirm_reset': 'Начать новый диалог с Santi?',
                'error_server': 'Ошибка сервера при обработке запроса.',
                'error_network': 'Ошибка сети. Проверьте интернет-соединение.'
            },
            'fr': {
                'title': isGeneralMode ? 'Om Swastiastu ! Bienvenue à Bali. 🙏' : `Om Swastiastu ! Bienvenue à ${locationName}. 🙏`,
                'desc': isGeneralMode ? 'Je suis <strong>Santi</strong>, votre gardien culturel virtuel pour Bali. Je suis là pour vous expliquer les codes vestimentaires, les attitudes respectueuses sur les plages, dans les villages traditionnels, les temples et les montagnes à <strong>travers toute l\'île de Bali</strong>.' : `Je suis <strong>Santi</strong>, votre gardien culturel virtuel. Je suis là untuk vous expliquer les codes vestimentaires, les attitudes respectueuses sur les plages, dans les villages traditionnels, les temples et les montagnes à <strong>${locationName}</strong>.`,
                'hint': 'Choisissez l\'une des questions suggérées ci-dessous ou posez librement votre question.',
                'placeholder': 'Posez une question sur la tenue, les plages, les temples ou les règles à Bali...',
                'loading': 'Santi vérifie les règles coutumières pour vous répondre...',
                'you': 'Vous',
                'send': 'Envoyer',
                'label_saran': 'Suggestions :',
                'confirm_reset': 'Démarrer une nouvelle conversation avec Santi ?',
                'error_server': 'Une erreur serveur est survenue.',
                'error_network': 'Erreur de connexion. Vérifiez votre réseau.'
            },
            'de': {
                'title': isGeneralMode ? 'Om Swastiastu! Willkommen auf Bali. 🙏' : `Om Swastiastu! Willkommen in ${locationName}. 🙏`,
                'desc': isGeneralMode ? 'Ich bin <strong>Santi</strong>, Ihre virtuelle KI-Kulturwächterin für Bali. Ich helfe Ihnen, die Kleiderordnung, Verhaltensregeln für Strände, traditionelle Dörfer, Tempel und heilige Berge auf <strong>ganz Bali</strong> zu verstehen.' : `Ich bin <strong>Santi</strong>, Ihre virtuelle KI-Kulturwächterin. Ich helfe Ihnen, die Kleiderordnung, Verhaltensregeln für Strände, traditionelle Dörfer, Tempel und heilige Berge in <strong>${locationName}</strong> und auf ganz Bali zu verstehen.`,
                'hint': 'Wählen Sie eine der vorgeschlagenen Fragen oder tippen Sie Ihre eigene.',
                'placeholder': 'Fragen zu Kleidung, Stränden, Tempeln oder Bali-Reiseregeln...',
                'loading': 'Santi prüft die Bräuche und formuliert die Antwort...',
                'you': 'Sie',
                'send': 'Senden',
                'label_saran': 'Vorschläge:',
                'confirm_reset': 'Eine neue Unterhaltung mit Santi beginnen?',
                'error_server': 'Ein Serverfehler ist aufgetreten.',
                'error_network': 'Netzwerkfehler. Bitte Verbindung prüfen.'
            }
        };

        let currentLang = '{{ app()->getLocale() }}';
        if (!greetings[currentLang]) currentLang = 'id';
        let conversationHistory = [];
        let isProcessing = false;

        function renderSuggestedButtons(lang) {
            if (!suggestedContainer) return;
            const g = greetings[lang] || greetings['id'];
            const questions = allSuggestedQuestions[lang] || allSuggestedQuestions['en'] || allSuggestedQuestions['id'] || [];

            let html = `<span class="text-[11px] font-bold text-[#5A6961] dark:text-[#A7B9AF] whitespace-nowrap">${g.label_saran}</span>`;
            questions.forEach(q => {
                html += `<button type="button" class="suggested-btn whitespace-nowrap px-3 py-1.5 rounded-full bg-white dark:bg-[#1D4436] hover:bg-[#174D3B] dark:hover:bg-[#21845B] text-[#174D3B] dark:text-[#DDF2DF] hover:text-white border border-[#174D3B]/20 dark:border-white/10 text-xs transition-colors shadow-2xs cursor-pointer">${escapeHtml(q)}</button>`;
            });
            suggestedContainer.innerHTML = html;

            suggestedContainer.querySelectorAll('.suggested-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (isProcessing) return;
                    userInput.value = btn.textContent.trim();
                    chatForm.dispatchEvent(new Event('submit'));
                });
            });
        }

        // Language setter
        function setLanguage(lang) {
            currentLang = lang;
            if (chatLangSelect) chatLangSelect.value = lang;

            const g = greetings[lang] || greetings['id'];
            userInput.placeholder = g.placeholder;
            loadingText.textContent = g.loading;
            greetingTitle.textContent = g.title;
            greetingDesc.innerHTML = g.desc;
            greetingHint.textContent = g.hint;

            const sendBtnSpan = sendBtn.querySelector('span');
            if (sendBtnSpan) sendBtnSpan.textContent = g.send;

            renderSuggestedButtons(lang);
        }

        // Initialize language
        setLanguage(currentLang);

        if (chatLangSelect) {
            chatLangSelect.addEventListener('change', (e) => {
                setLanguage(e.target.value);
            });
        }

        // Character counter
        userInput.addEventListener('input', () => {
            const remaining = 1000 - userInput.value.length;
            charCounter.textContent = remaining;
        });

        // Reset chat
        newChatBtn.addEventListener('click', () => {
            const g = greetings[currentLang] || greetings['id'];
            if (confirm(g.confirm_reset)) {
                conversationHistory = [];
                // Remove all user and AI messages except initial welcome
                const messages = chatMessages.querySelectorAll('.message-item');
                messages.forEach((msg, idx) => {
                    if (idx > 0) msg.remove();
                });
                userInput.value = '';
                userInput.focus();
            }
        });

        // Form submit handler
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message || isProcessing) return;

            // Render User Bubble
            renderUserMessage(message);
            userInput.value = '';
            charCounter.textContent = '1000';

            // Set Loading state
            setProcessing(true);

            try {
                const response = await fetch("{{ route('santi.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        location_slug: locationSlug,
                        language: currentLang,
                        history: conversationHistory,
                    }),
                });

                const data = await response.json();

                if (response.ok) {
                    renderAiMessage(data);

                    // Add to conversation history
                    conversationHistory.push({ role: 'user', content: message });
                    conversationHistory.push({ role: 'model', content: data.answer });

                    // Keep history bounded
                    if (conversationHistory.length > 8) {
                        conversationHistory = conversationHistory.slice(-8);
                    }
                } else {
                    const g = greetings[currentLang] || greetings['id'];
                    const errorMsg = data.message || g.error_server;
                    renderErrorMessage(errorMsg);
                }
            } catch (error) {
                console.error('Chat error:', error);
                const g = greetings[currentLang] || greetings['id'];
                renderErrorMessage(g.error_network);
            } finally {
                setProcessing(false);
                userInput.focus();
            }
        });

        function setProcessing(processing) {
            isProcessing = processing;
            sendBtn.disabled = processing;
            userInput.disabled = processing;
            if (processing) {
                loadingIndicator.classList.remove('hidden');
                scrollToBottom();
            } else {
                loadingIndicator.classList.add('hidden');
            }
        }

        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function renderUserMessage(text) {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const g = greetings[currentLang] || greetings['id'];
            const messageHtml = `
                <div class="flex items-start justify-end space-x-3 message-item" data-role="user">
                    <div class="flex flex-col items-end space-y-1 max-w-[88%] sm:max-w-[75%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-[10px] text-gray-400">${timeStr}</span>
                            <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">${g.you}</span>
                        </div>
                        <div class="bg-gradient-to-r from-[#174D3B] to-[#21845B] text-white rounded-2xl rounded-tr-xs p-3.5 text-xs sm:text-sm leading-relaxed shadow-xs">
                            ${escapeHtml(text)}
                        </div>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#174D3B] text-white flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-xs border border-white/20">
                        <svg class="w-4 h-4 text-[#C6A15B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            `;
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            scrollToBottom();
        }

        function renderAiMessage(data) {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const isInsufficient = data.status === 'insufficient_verified_information';

            // Format markdown bold & line breaks cleanly
            let formattedAnswer = escapeHtml(data.answer)
                .replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-[#174D3B] dark:text-[#E5C378]">$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\n\n/g, '<br><br>')
                .replace(/\n/g, '<br>');

            let statusBannerHtml = '';
            if (isInsufficient) {
                const statusNotice = {
                    'id': 'Status: Informasi Terverifikasi Belum Tersedia. Santi tidak membuat aturan spekulatif.',
                    'en': 'Status: Insufficient Verified Information. Santi avoids speculative rules.',
                    'zh': '状态：权威认证信息暂缺。Santi 不会推测未经核实的村规。',
                    'ja': 'ステータス：認証済みの情報がありません。Santiは憶測による回答を控えています。',
                    'ru': 'Статус: Нет верифицированной информации. Santi не дает предположительных ответов.',
                    'fr': 'Statut : Informations vérifiées insuffisantes. Santi refuse les règles spéculatives.',
                    'de': 'Status: Keine verifizierten Informationen vorhanden. Santi vermeidet spekulative Auskünfte.'
                };
                const noticeText = statusNotice[currentLang] || statusNotice['id'];
                statusBannerHtml = `
                    <div class="mb-3 p-3 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 text-[11px] text-amber-900 dark:text-amber-200 flex items-start space-x-2">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>${noticeText}</span>
                    </div>
                `;
            }

            // Sources block
            let sourcesHtml = '';
            if (data.sources && data.sources.length > 0) {
                const refTitles = {
                    'id': 'Rujukan Aturan Terverifikasi (Database Santi)',
                    'en': 'Verified Reference Rules (Santi Database)',
                    'zh': '权威认证传统规约 (Santi 数据库)',
                    'ja': '公式認証済み慣習規則 (Santi データベース)',
                    'ru': 'Верифицированные правила (База данных Santi)',
                    'fr': 'Règles Coutumières Vérifiées (Base Santi)',
                    'de': 'Verifizierte Referenzregeln (Santi Datenbank)'
                };
                const sourceHeading = refTitles[currentLang] || refTitles['id'];

                const sourceItems = data.sources.map(s => {
                    const link = s.source_url ? `<a href="${escapeHtml(s.source_url)}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] dark:text-[#34D399] hover:underline font-semibold inline-flex items-center space-x-1"><span>${escapeHtml(s.source_name || 'Rujukan Resmi')}</span><svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>` : `<span>${escapeHtml(s.source_name || 'Rujukan Resmi')}</span>`;
                    return `
                        <div class="p-2.5 rounded-xl bg-white/70 dark:bg-[#16352A] border border-gray-100 dark:border-white/10 text-[11px] space-y-0.5">
                            <div class="font-semibold text-[#174D3B] dark:text-[#DDF2DF] flex items-center space-x-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#C6A15B]"></span>
                                <span>${escapeHtml(s.title)}</span>
                                <span class="text-[9px] uppercase px-1.5 py-0.2 rounded bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 font-normal">[${escapeHtml(s.category || 'Adat')}]</span>
                            </div>
                            <div class="text-[#5A6961] dark:text-[#A7B9AF] text-[10px] pl-3">
                                Sumber: ${link}
                            </div>
                        </div>
                    `;
                }).join('');

                sourcesHtml = `
                    <div class="mt-3 pt-3 border-t border-[#C6A15B]/30">
                        <div class="text-[10px] uppercase font-bold tracking-wider text-[#174D3B] dark:text-[#E5C378] mb-2 flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>${sourceHeading}</span>
                        </div>
                        <div class="space-y-1.5">
                            ${sourceItems}
                        </div>
                    </div>
                `;
            }

            const rawTextId = 'msg-text-' + Date.now();

            const messageHtml = `
                <div class="flex items-start space-x-3 message-item" data-role="model">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#174D3B] to-[#21845B] text-[#C6A15B] flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-xs border border-white/20">
                        S
                    </div>
                    <div class="flex flex-col space-y-1 max-w-[90%] sm:max-w-[82%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-[#174D3B] dark:text-[#DDF2DF]">Santi AI Cultural Guardian</span>
                            <span class="text-[10px] text-gray-400">${timeStr}</span>
                        </div>
                        <div class="bg-[#F8F6EF] dark:bg-[#1A3E31] border border-[#C6A15B]/30 rounded-2xl rounded-tl-xs p-4 sm:p-4.5 text-xs sm:text-sm text-[#202A25] dark:text-[#F8F6EF] leading-relaxed shadow-xs">
                            ${statusBannerHtml}
                            <div id="${rawTextId}" class="prose prose-sm max-w-none text-[#202A25] dark:text-[#F8F6EF]">
                                ${formattedAnswer}
                            </div>
                            ${sourcesHtml}
                            <div class="mt-2.5 pt-2 border-t border-gray-200/50 dark:border-white/10 flex items-center justify-end">
                                <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('${rawTextId}').innerText); this.innerHTML='✓ Tersalin'; setTimeout(() => this.innerHTML='Salin Jawaban', 2000)" class="text-[10px] font-semibold text-[#5A6961] dark:text-[#A7B9AF] hover:text-[#174D3B] dark:hover:text-[#DDF2DF] cursor-pointer transition-colors flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <span>Salin Jawaban</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            scrollToBottom();
        }

        function renderErrorMessage(errorText) {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const messageHtml = `
                <div class="flex items-start space-x-3 message-item" data-role="error">
                    <div class="w-8 h-8 rounded-full bg-red-600 text-white flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-xs">
                        !
                    </div>
                    <div class="flex flex-col space-y-1 max-w-[88%] sm:max-w-[80%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-red-700">Pemberitahuan Sistem</span>
                            <span class="text-[10px] text-gray-400">${timeStr}</span>
                        </div>
                        <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl rounded-tl-xs p-4 text-xs sm:text-sm leading-relaxed shadow-xs">
                            ${escapeHtml(errorText)}
                        </div>
                    </div>
                </div>
            `;
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            scrollToBottom();
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    });
</script>
@endpush
@endsection
