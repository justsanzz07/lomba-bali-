@extends('layouts.app')

@section('title', 'Santi AI Guardian — ' . $location->name)

@section('content')
<div class="bg-[#F8F6EF] min-h-[calc(100vh-80px)] py-4 sm:py-6 lg:py-8 flex flex-col justify-between">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 w-full flex-grow flex flex-col">
        <!-- Top Location Header Bar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-xs border border-[#174D3B]/10 mb-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <div class="flex items-center space-x-3">
                <a href="{{ route('locations.index') }}" title="Ganti Lokasi" class="w-9 h-9 rounded-xl bg-[#F8F6EF] hover:bg-[#174D3B] hover:text-white text-[#174D3B] flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="font-serif-bali font-bold text-base sm:text-lg text-[#174D3B]">{{ $location->name }}</h1>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#21845B]/10 text-[#21845B]">
                            Kawasan Aktif
                        </span>
                    </div>
                    @if($location->address)
                        <p class="text-[11px] text-[#5A6961] truncate max-w-xs sm:max-w-md">{{ $location->address }}</p>
                    @endif
                </div>
            </div>

            <!-- Header Controls: Language Toggle & Location Switcher -->
            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                <!-- Language Selector -->
                <div class="inline-flex rounded-xl bg-[#F8F6EF] p-1 border border-[#174D3B]/10 text-xs font-semibold">
                    <button type="button" id="lang-id-btn" class="lang-btn px-2.5 py-1 rounded-lg bg-[#174D3B] text-white transition-all duration-150">
                        Bahasa
                    </button>
                    <button type="button" id="lang-en-btn" class="lang-btn px-2.5 py-1 rounded-lg text-[#5A6961] hover:text-[#174D3B] transition-all duration-150">
                        English
                    </button>
                </div>

                <!-- Reset Chat -->
                <button type="button" id="new-chat-btn" title="Mulai Percakapan Baru" class="p-2 rounded-xl bg-[#F8F6EF] hover:bg-gray-200 text-[#5A6961] text-xs font-medium flex items-center space-x-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span class="hidden sm:inline">Reset</span>
                </button>
            </div>
        </div>

        <!-- Chat Main Container Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-[#174D3B]/10 flex flex-col h-[65vh] sm:h-[68vh] overflow-hidden">
            <!-- Messages Scroll Area -->
            <div id="chat-messages" class="flex-grow p-4 sm:p-6 overflow-y-auto space-y-4">
                <!-- Initial Welcome Message from Santi -->
                <div class="flex items-start space-x-3 message-item" data-role="model">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#174D3B] to-[#21845B] text-[#C6A15B] flex-shrink-0 flex items-center justify-center font-serif-bali font-bold text-xs shadow-xs">
                        S
                    </div>
                    <div class="flex flex-col space-y-1.5 max-w-[88%] sm:max-w-[80%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-[#174D3B]">Santi AI Cultural Guardian</span>
                            <span class="text-[10px] text-gray-400">Sekarang</span>
                        </div>
                        <div class="bg-[#F8F6EF] border border-[#C6A15B]/30 rounded-2xl rounded-tl-xs p-4 text-xs sm:text-sm text-[#202A25] leading-relaxed shadow-xs">
                            <p class="font-semibold text-[#174D3B] text-sm mb-1" id="greeting-title">
                                Om Swastiastu! Rahajeng rauh ring {{ $location->name }}. 🙏
                            </p>
                            <p id="greeting-desc">
                                Saya <strong>Santi</strong>, asisten pemandu kebudayaan virtual Anda. Saya siap membantu Anda memahami tata krama adat, ketentuan busana (kamen & senteng), etika persembahyangan, serta batas-batas sakral di kawasan <strong>{{ $location->name }}</strong> berdasarkan rujukan resmi yang terverifikasi.
                            </p>
                            <p class="mt-2 text-[11px] text-[#5A6961]" id="greeting-hint">
                                Silakan pilih pertanyaan yang disarankan di bawah ini atau ketik pertanyaan bebas Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Verified Rules Summary Pill in Initial State -->
                @if($location->verifiedCulturalRules->count() > 0)
                    <div class="px-4 py-2.5 rounded-xl bg-[#21845B]/10 border border-[#21845B]/20 text-[11px] text-[#174D3B] flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span>Basis data terverifikasi aktif: <strong>{{ $location->verifiedCulturalRules->count() }} pedoman dresta adat</strong> untuk pura ini.</span>
                        </div>
                    </div>
                @else
                    <div class="px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-200 text-[11px] text-amber-800 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>Peringatan: Lokasi ini adalah lokasi uji coba dan belum memiliki pedoman adat terverifikasi resmi di basis data Santi.</span>
                    </div>
                @endif
            </div>

            <!-- Loading Indicator Box (Hidden by default) -->
            <div id="loading-indicator" class="hidden px-6 py-3 border-t border-gray-100 bg-[#F8F6EF]/50">
                <div class="flex items-center space-x-3 text-xs text-[#174D3B]">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 rounded-full bg-[#174D3B] animate-bounce"></div>
                        <div class="w-2 h-2 rounded-full bg-[#21845B] animate-bounce [animation-delay:0.2s]"></div>
                        <div class="w-2 h-2 rounded-full bg-[#C6A15B] animate-bounce [animation-delay:0.4s]"></div>
                    </div>
                    <span id="loading-text">Santi sedang memverifikasi pedoman adat dan merumuskan jawaban...</span>
                </div>
            </div>

            <!-- Suggested Questions Carousel / Chips -->
            <div class="px-4 py-3 bg-[#F8F6EF]/60 border-t border-gray-100 overflow-x-auto">
                <div class="flex items-center space-x-2 text-xs" id="suggested-questions-container">
                    <span class="text-[11px] font-semibold text-[#5A6961] whitespace-nowrap">Saran:</span>
                    @foreach($suggestedQuestions['id'] as $index => $sq)
                        <button type="button" class="suggested-btn whitespace-nowrap px-3 py-1.5 rounded-full bg-white hover:bg-[#174D3B] text-[#174D3B] hover:text-white border border-[#174D3B]/20 text-xs transition-colors"
                            data-q-id="{{ $sq }}"
                            data-q-en="{{ $suggestedQuestions['en'][$index] ?? $sq }}">
                            {{ $sq }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Input Form Box -->
            <div class="p-3 sm:p-4 bg-white border-t border-gray-100">
                <form id="chat-form" class="flex items-center space-x-2">
                    <div class="relative flex-grow">
                        <input type="text" id="user-input" maxlength="1000" autocomplete="off"
                            placeholder="Tanyakan etika, busana, atau aturan pura..."
                            class="w-full pl-4 pr-10 py-3 rounded-xl bg-[#F8F6EF] border border-[#174D3B]/20 text-xs sm:text-sm text-[#202A25] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#174D3B] focus:border-transparent transition-all">
                        <span id="char-counter" class="absolute right-3 top-3.5 text-[10px] text-gray-400">1000</span>
                    </div>

                    <button type="submit" id="send-btn"
                        class="px-5 py-3 rounded-xl bg-gradient-to-r from-[#174D3B] to-[#21845B] hover:from-[#21845B] hover:to-[#174D3B] text-white text-xs sm:text-sm font-semibold flex items-center space-x-2 shadow-xs hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span>Kirim</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
                <div class="mt-2 text-[10px] text-gray-400 text-center flex items-center justify-center space-x-2">
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
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const chatMessages = document.getElementById('chat-messages');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const loadingIndicator = document.getElementById('loading-indicator');
        const loadingText = document.getElementById('loading-text');
        const charCounter = document.getElementById('char-counter');
        const newChatBtn = document.getElementById('new-chat-btn');

        const langIdBtn = document.getElementById('lang-id-btn');
        const langEnBtn = document.getElementById('lang-en-btn');
        const greetingTitle = document.getElementById('greeting-title');
        const greetingDesc = document.getElementById('greeting-desc');
        const greetingHint = document.getElementById('greeting-hint');
        const suggestedButtons = document.querySelectorAll('.suggested-btn');

        let currentLang = 'id';
        let conversationHistory = [];
        let isProcessing = false;

        // Language toggle handlers
        function setLanguage(lang) {
            currentLang = lang;
            if (lang === 'id') {
                langIdBtn.classList.add('bg-[#174D3B]', 'text-white');
                langIdBtn.classList.remove('text-[#5A6961]');
                langEnBtn.classList.remove('bg-[#174D3B]', 'text-white');
                langEnBtn.classList.add('text-[#5A6961]');

                userInput.placeholder = "Tanyakan etika, busana, atau aturan pura...";
                loadingText.textContent = "Santi sedang memverifikasi pedoman adat dan merumuskan jawaban...";
                greetingTitle.textContent = `Om Swastiastu! Rahajeng rauh ring ${locationName}. 🙏`;
                greetingDesc.innerHTML = `Saya <strong>Santi</strong>, asisten pemandu kebudayaan virtual Anda. Saya siap membantu Anda memahami tata krama adat, ketentuan busana (kamen & senteng), etika persembahyangan, serta batas-batas sakral di kawasan <strong>${locationName}</strong> berdasarkan rujukan resmi yang terverifikasi.`;
                greetingHint.textContent = "Silakan pilih pertanyaan yang disarankan di bawah ini atau ketik pertanyaan bebas Anda.";

                suggestedButtons.forEach(btn => {
                    btn.textContent = btn.getAttribute('data-q-id');
                });
            } else {
                langEnBtn.classList.add('bg-[#174D3B]', 'text-white');
                langEnBtn.classList.remove('text-[#5A6961]');
                langIdBtn.classList.remove('bg-[#174D3B]', 'text-white');
                langIdBtn.classList.add('text-[#5A6961]');

                userInput.placeholder = "Ask about dress code, sanctuary rules, or temple etiquette...";
                loadingText.textContent = "Santi is verifying customary guidelines and crafting your answer...";
                greetingTitle.textContent = `Om Swastiastu! Welcome to ${locationName}. 🙏`;
                greetingDesc.innerHTML = `I am <strong>Santi</strong>, your AI Cultural Guardian. I am here to help you understand sacred etiquette, required attire (kamen & senteng), prayer courtesies, and sanctuary restrictions at <strong>${locationName}</strong> based on verified customary records.`;
                greetingHint.textContent = "Please select one of the suggested questions below or type your own question freely.";

                suggestedButtons.forEach(btn => {
                    btn.textContent = btn.getAttribute('data-q-en');
                });
            }
        }

        langIdBtn.addEventListener('click', () => setLanguage('id'));
        langEnBtn.addEventListener('click', () => setLanguage('en'));

        // Character counter
        userInput.addEventListener('input', () => {
            const remaining = 1000 - userInput.value.length;
            charCounter.textContent = remaining;
        });

        // Suggested questions click
        suggestedButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (isProcessing) return;
                const questionText = currentLang === 'id' ? btn.getAttribute('data-q-id') : btn.getAttribute('data-q-en');
                userInput.value = questionText;
                chatForm.dispatchEvent(new Event('submit'));
            });
        });

        // Reset chat
        newChatBtn.addEventListener('click', () => {
            if (confirm(currentLang === 'id' ? 'Mulai sesi percakapan baru dengan Santi?' : 'Start a fresh conversation with Santi?')) {
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
                    const errorMsg = data.message || (currentLang === 'id' ? 'Terjadi kendala pada server saat memproses pertanyaan.' : 'A server error occurred while processing your query.');
                    renderErrorMessage(errorMsg);
                }
            } catch (error) {
                console.error('Chat error:', error);
                const networkMsg = currentLang === 'id' 
                    ? 'Koneksi ke server terputus. Silakan periksa jaringan internet Anda.' 
                    : 'Network error. Please check your internet connection.';
                renderErrorMessage(networkMsg);
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
            const messageHtml = `
                <div class="flex items-start justify-end space-x-3 message-item" data-role="user">
                    <div class="flex flex-col items-end space-y-1 max-w-[88%] sm:max-w-[75%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-[10px] text-gray-400">${timeStr}</span>
                            <span class="text-xs font-bold text-[#174D3B]">${currentLang === 'id' ? 'Anda' : 'You'}</span>
                        </div>
                        <div class="bg-gradient-to-r from-[#174D3B] to-[#21845B] text-white rounded-2xl rounded-tr-xs p-3.5 text-xs sm:text-sm leading-relaxed shadow-xs">
                            ${escapeHtml(text)}
                        </div>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#174D3B] text-white flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-xs">
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

            // Format markdown bold & line breaks simply
            let formattedAnswer = escapeHtml(data.answer)
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\n\n/g, '<br><br>')
                .replace(/\n/g, '<br>');

            let statusBannerHtml = '';
            if (isInsufficient) {
                statusBannerHtml = `
                    <div class="mb-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-[11px] text-amber-900 flex items-start space-x-2">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>${currentLang === 'id' ? 'Status: Informasi Terverifikasi Belum Tersedia. Santi tidak membuat aturan spekulatif.' : 'Status: Insufficient Verified Information. Santi avoids speculative rules.'}</span>
                    </div>
                `;
            }

            // Sources block
            let sourcesHtml = '';
            if (data.sources && data.sources.length > 0) {
                const sourceItems = data.sources.map(s => {
                    const link = s.source_url ? `<a href="${escapeHtml(s.source_url)}" target="_blank" rel="noopener noreferrer" class="text-[#21845B] hover:underline font-medium inline-flex items-center space-x-1"><span>${escapeHtml(s.source_name || 'Rujukan Resmi')}</span><svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>` : `<span>${escapeHtml(s.source_name || 'Rujukan Resmi')}</span>`;
                    return `
                        <div class="p-2 rounded-lg bg-white/70 border border-gray-100 text-[11px] space-y-0.5">
                            <div class="font-semibold text-[#174D3B] flex items-center space-x-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#C6A15B]"></span>
                                <span>${escapeHtml(s.title)}</span>
                                <span class="text-[9px] uppercase px-1.5 py-0.2 rounded bg-gray-100 text-gray-500 font-normal">[${escapeHtml(s.category || 'Adat')}]</span>
                            </div>
                            <div class="text-[#5A6961] text-[10px] pl-3">
                                Sumber: ${link}
                            </div>
                        </div>
                    `;
                }).join('');

                sourcesHtml = `
                    <div class="mt-3 pt-3 border-t border-[#C6A15B]/30">
                        <div class="text-[10px] uppercase font-bold tracking-wider text-[#174D3B] mb-2 flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 text-[#21845B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>${currentLang === 'id' ? 'Rujukan Aturan Terverifikasi (Database Santi)' : 'Verified Reference Rules (Santi Database)'}</span>
                        </div>
                        <div class="space-y-1.5">
                            ${sourceItems}
                        </div>
                    </div>
                `;
            }

            const messageHtml = `
                <div class="flex items-start space-x-3 message-item" data-role="model">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#174D3B] to-[#21845B] text-[#C6A15B] flex-shrink-0 flex items-center justify-center font-serif-bali font-bold text-xs shadow-xs">
                        S
                    </div>
                    <div class="flex flex-col space-y-1 max-w-[88%] sm:max-w-[80%]">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-[#174D3B]">Santi AI Cultural Guardian</span>
                            <span class="text-[10px] text-gray-400">${timeStr}</span>
                        </div>
                        <div class="bg-[#F8F6EF] border border-[#C6A15B]/30 rounded-2xl rounded-tl-xs p-4 text-xs sm:text-sm text-[#202A25] leading-relaxed shadow-xs">
                            ${statusBannerHtml}
                            <div class="prose prose-sm max-w-none text-[#202A25]">
                                ${formattedAnswer}
                            </div>
                            ${sourcesHtml}
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
