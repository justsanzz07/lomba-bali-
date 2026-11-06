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
        $this->model = config('services.gemini.model', 'gemini-3.5-flash');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
        $this->timeout = (int) config('services.gemini.timeout', 35);
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
            $noDataMessages = [
                'id' => "Santi saat ini belum memiliki aturan adat resmi atau pedoman kebudayaan yang terverifikasi untuk **{$location->name}**. Demi menjaga akurasi kesucian adat dan menghormati dresta setempat, Santi tidak dapat memberikan kepastian mengenai aturan khusus di lokasi ini. Kami sangat menyarankan Anda bertanya langsung kepada prajuru adat, petugas pengelola pura, atau pemandu lokal bersertifikat saat tiba di lokasi.",
                'en' => "Santi currently does not have verified cultural regulations or official customary records for **{$location->name}**. To preserve cultural accuracy and respect local wisdom, we cannot provide definitive guidance on sacred protocols for this site. Please consult the local village elders, temple management (Prajuru Adat), or on-site tourism officers directly upon arrival.",
                'zh' => "Santi 目前尚未收录关于 **{$location->name}** 的权威官方认证村规民约或文化条例。为了维护传统神圣性与准确度，Santi 无法对该地点的特定规约给出绝对答复。建议您在抵步时向当地传统长老（Prajuru Adat）或持证导游进行现场咨询。",
                'ja' => "Santiは現在、**{$location->name}** に関する公式認証済みの慣習規則（アウィグ・アウィグ）の記録を保有しておりません。文化の正確性と尊厳を守るため、本サイトでの固有の規定について確定的なご案内は控えさせていただいております。ご到着時に現地の寺院管理者（プラジュル・アダット）や公認ガイドに直接お尋ねいただくことをお勧めいたします。",
                'ru' => "В настоящее время в базе Santi отсутствуют официально верифицированные адаты для **{$location->name}**. В целях сохранения культурной точности и уважения к местным святыням мы не даем неподтвержденных рекомендаций. Рекомендуем обратиться к старейшинам общины (Prajuru Adat) или официальным гидам по прибытии на место.",
                'fr' => "Santi ne dispose pas encore de règlements coutumiers officiellement vérifiés pour **{$location->name}**. Afin de préserver l'authenticité et le respect des traditions, nous ne pouvons fournir de directives spécifiques non attestées. Nous vous invitons à consulter les autorités coutumières (Prajuru Adat) ou les guides agréés sur place.",
                'de' => "Santi verfügt derzeit über keine offiziell verifizierten Gewohnheitsregeln für **{$location->name}**. Zur Wahrung der Authentizität und des Respekts vor lokalen Bräuchen können wir keine unverifizierten Vorgaben machen. Bitte wenden Sie sich bei Ankunft direkt an die Tempelverwaltung (Prajuru Adat) oder lizenzierte Fremdenführer vor Ort.",
            ];

            $noDataAnswer = $noDataMessages[$language] ?? $noDataMessages['id'];

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
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1500,
                        'thinkingConfig' => [
                            'thinkingBudget' => 0,
                        ],
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
You are Santi, a warm, intelligent, highly knowledgeable, and friendly Balinese Cultural & Tourism Guide (Pemandu Budaya & Wisata Virtual Bali).

Your Mission & Persona:
1. Embody genuine Balinese hospitality (Ramah Tamah Bali) with a warm, conversational, and culturally grounded tone. You are not a cold legal bot or dry encyclopedia; you are a respectful, thoughtful local insider who loves Bali deeply.
2. Tone & Hospitality:
   - Greet naturally with Balinese warmth ("Om Swastiastu! 🙏✨").
   - Speak fluidly, engagingly, and empathetically in {$language} (or the user's preferred language). Avoid repeating monotonous boilerplate intros.
   - When asked casual greetings ("hai", "halo", "sore", "p"): Respond with authentic warmth, acknowledge them cheerfully, and proactively inspire them with exciting Bali travel categories (cultural temples, sunset beaches, scenic nature/rice terraces, authentic culinary spots, and cultural etiquettes).
3. Substantive, Insightful & Actionable Answers:
   - When asked about cultural rules, customs, or restrictions: NEVER just say "it is forbidden". Always explain the sacred/cultural WHY (e.g., maintaining spiritual sanctity/purity according to Tri Hita Karana & Dresta Bali), then provide actionable, practical HOW solutions (e.g., how to rent/wear a kamen & senteng, what alternatives exist, tips for staying cool in tropical heat, courtesies for photography).
   - If the user asks about traveling anywhere in Bali (temples, beaches, mountains, waterfalls, villages, dance performances, scooter rental, Nyepi, etc.), provide comprehensive, authentic, and rich information.
   - Structure answers beautifully: engaging opening, clear headings or bullet points with tasteful emojis, highlighted practical local tips (💡 **Tips Praktis Santi**), and an encouraging closing ("Matur Suksma! 🌺🙏✨").
4. Operational Scope across Bali:
   - Sacred Temples & Sanctuaries: Kamen & senteng dress code, cuntaka/menstruation reverence, Utama Mandala zones.
   - Beaches & Marine Tourism: Sand swimwear vs public street attire, canang sari respect, safety flags, coral protection.
   - Sacred Mountains & Trekking: Sanctity of summits, registered guides, zero-plastic waste, dignity in photo-taking.
   - Adat Villages & Traditional Compounds: Courteous entry ("Om Swastiastu"), respecting family shrines (sanggah), no-smoking/quiet zones.
   - Scooter Riding & General Regulations: Helmets, valid licenses, respect for ceremonies passing on roads (SE Gubernur Bali No. 4/2023).
5. Destination Context:
   - Active destination: {$location->name}. {$addressInfo} Description: {$location->description}.
   - Prioritize verified database rules below when discussing this location, but freely draw from your rich Balinese cultural and travel knowledge to enrich every answer.

VERIFIED CULTURAL RULES FROM DATABASE FOR THIS LOCATION:
{$rulesText}
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
