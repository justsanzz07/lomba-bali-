<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected ?string $apiKey;

    protected string $model;

    protected string $baseUrl;

    protected int $timeout;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model', 'gemini-2.5-flash');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
        $this->timeout = 25;
    }

    /**
     * Generate answer based on location, verified cultural rules, user message, and conversation history.
     */
    public function generateCulturalGuidance(
        Location $location,
        Collection $verifiedRules,
        string $userMessage,
        array $history = [],
        string $language = 'id'
    ): array {
        // Format sources from database
        $sources = $verifiedRules->map(function ($rule) {
            return [
                'title' => $rule->title,
                'category' => $rule->category,
                'source_name' => $rule->source_name,
                'source_url' => $rule->source_url,
            ];
        })->values()->all();

        // If no verified rules exist for this location, return insufficient_verified_information
        if ($verifiedRules->isEmpty()) {
            $noDataAnswer = $language === 'en'
                ? "Santi currently does not have verified cultural regulations or official customary records for **{$location->name}**. To preserve cultural accuracy and respect local wisdom, we cannot provide definitive guidance on sacred protocols for this site. Please consult the local village elders, temple management (Prajuru Adat), or on-site tourism officers directly upon arrival."
                : "Santi saat ini belum memiliki aturan adat resmi atau pedoman kebudayaan yang terverifikasi untuk **{$location->name}**. Demi menjaga akurasi kesucian adat dan menghormati dresta setempat, Santi tidak dapat memberikan kepastian mengenai aturan khusus di lokasi ini. Kami sangat menyarankan Anda bertanya langsung kepada prajuru adat, petugas pengelola pura, atau pemandu lokal bersertifikat saat tiba di lokasi.";

            return [
                'answer' => $noDataAnswer,
                'location' => [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                ],
                'sources' => [],
                'status' => 'insufficient_verified_information',
            ];
        }

        // Check if API key is configured
        if (empty($this->apiKey) || $this->apiKey === 'your_gemini_api_key_here') {
            return [
                'answer' => $language === 'en'
                    ? "Gemini API key is not yet configured in the server environment (.env). Please set GEMINI_API_KEY to enable live AI responses. However, based on our verified database for **{$location->name}**, please review the verified rules listed below."
                    : "Kunci API Gemini belum dikonfigurasi di server (.env: GEMINI_API_KEY). Silakan tambahkan API key Anda untuk mengaktifkan asisten AI langsung. Namun, berdasarkan data terverifikasi di sistem kami untuk **{$location->name}**, Anda dapat merujuk pada pedoman resmi di bawah ini.",
                'location' => [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                ],
                'sources' => $sources,
                'status' => 'success',
            ];
        }

        // Build system prompt with location and verified rules context
        $systemInstruction = $this->buildSystemInstruction($location, $verifiedRules, $language);

        // Build contents payload
        $contents = $this->buildContentsPayload($history, $userMessage);

        try {
            $endpoint = "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($endpoint, [
                    'contents' => $contents,
                    'systemInstruction' => [
                        'parts' => [
                            ['text' => $systemInstruction],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 1024,
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $generatedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if (! empty($generatedText)) {
                    return [
                        'answer' => trim($generatedText),
                        'location' => [
                            'name' => $location->name,
                            'slug' => $location->slug,
                            'address' => $location->address,
                        ],
                        'sources' => $sources,
                        'status' => 'success',
                    ];
                }
            }

            // Log error without exposing API key
            Log::error('Gemini API returned error response', [
                'status' => $response->status(),
                'location' => $location->slug,
                'response_summary' => substr($response->body(), 0, 300),
            ]);

            $isRateLimited = $response->status() === 429;
            $fallbackMessage = $isRateLimited
                ? ($language === 'en'
                    ? 'AI assistant is currently experiencing high demand (Rate Limited). Please wait a few moments and try asking again.'
                    : 'Layanan AI sedang menerima banyak permintaan (Batas Kuota Tercapai). Silakan tunggu beberapa saat dan coba tanyakan kembali.')
                : ($language === 'en'
                    ? 'Unable to communicate with Santi AI service at this moment. Please check the verified guidelines listed below.'
                    : 'Terjadi kendala saat menghubungi layanan Santi AI. Anda tetap dapat merujuk pada pedoman terverifikasi di bawah ini.');

            return [
                'answer' => $fallbackMessage,
                'location' => [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                ],
                'sources' => $sources,
                'status' => 'error',
            ];
        } catch (ConnectionException $e) {
            Log::error('Gemini API connection timeout/failure: '.$e->getMessage());

            return [
                'answer' => $language === 'en'
                    ? 'Connection to the AI cultural guardian timed out. Please check your internet connection or try again shortly.'
                    : 'Koneksi ke server AI Santi mengalami kendala batas waktu (timeout). Silakan periksa koneksi Anda dan coba beberapa saat lagi.',
                'location' => [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                ],
                'sources' => $sources,
                'status' => 'error',
            ];
        } catch (\Throwable $e) {
            Log::error('Unexpected error in GeminiService: '.$e->getMessage());

            return [
                'answer' => $language === 'en'
                    ? 'An unexpected error occurred while processing your request. Please try again.'
                    : 'Terjadi kesalahan saat memproses pertanyaan Anda. Silakan coba kembali.',
                'location' => [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                ],
                'sources' => $sources,
                'status' => 'error',
            ];
        }
    }

    /**
     * Build system instruction with ground-truth database rules and location context.
     */
    protected function buildSystemInstruction(Location $location, Collection $verifiedRules, string $language): string
    {
        $rulesText = '';
        foreach ($verifiedRules as $index => $rule) {
            $num = $index + 1;
            $sourceStr = $rule->source_name ? " [Sumber: {$rule->source_name}]" : '';
            $rulesText .= "{$num}. [{$rule->category}] {$rule->title}: {$rule->content}{$sourceStr}\n";
        }

        $addressInfo = $location->address ? " Alamat/Wilayah: {$location->address}." : '';

        return <<<PROMPT
You are Santi, an AI Cultural Guardian specializing in Balinese culture and traditions.

Your mission is to help domestic and international tourists understand local cultural etiquette, sacred-area guidelines, and traditional customs.

You must follow these core operational rules:
1. Always identify the selected location: {$location->name}.
2. Prioritize verified cultural rules provided below from the application's verified database.
3. Never invent location-specific regulations.
4. Never claim that an unverified rule is official.
5. If information is unavailable or not covered by verified guidelines, clearly state that the information has not been verified.
6. Recommend contacting local staff, temple custodians (Prajuru Adat), or certified cultural guides when clarification is needed.
7. Respond politely, respectfully, and naturally with a warm Balinese hospitality tone (e.g., greeting with "Om Swastiastu").
8. Support Indonesian and English fluently.
9. Match the user's language automatically (User requested language preference: {$language}).
10. Provide practical, actionable recommendations (e.g., where to rent a sarong/kamen, how to tie a senteng/sash, how to behave during ceremonies).
11. Never claim to represent an official temple or village authority.

CURRENT ACTIVE LOCATION CONTEXT:
Name: {$location->name}
Slug: {$location->slug}
{$addressInfo}
Description: {$location->description}

VERIFIED CULTURAL RULES FROM DATABASE FOR THIS LOCATION:
{$rulesText}

IMPORTANT GROUNDING DIRECTIVE:
Use ONLY the verified rules above for location-specific mandates (such as specific forbidden areas, exact dress requirements, photography rules). If the user asks about a practice not covered in the verified rules above, explain that there is no officially verified rule in Santi's database for that specific detail and politely advise checking with the on-site temple management or local guide.
PROMPT;
    }

    /**
     * Build contents payload including bounded recent conversation history.
     */
    protected function buildContentsPayload(array $history, string $userMessage): array
    {
        $contents = [];

        // Limit history to the last 6 messages (3 turns)
        $recentHistory = array_slice($history, -6);

        foreach ($recentHistory as $msg) {
            if (! isset($msg['role'], $msg['content']) || ! is_string($msg['content'])) {
                continue;
            }

            $role = ($msg['role'] === 'user') ? 'user' : 'model';
            $text = trim($msg['content']);

            if (! empty($text)) {
                $contents[] = [
                    'role' => $role,
                    'parts' => [
                        ['text' => $text],
                    ],
                ];
            }
        }

        // Add current user message
        $contents[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $userMessage],
            ],
        ];

        return $contents;
    }
}
