<?php

namespace Tests\Feature;

use App\Models\CulturalRule;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SantiCulturalGuardianTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.gemini.api_key' => 'test-fake-gemini-key',
            'services.gemini.model' => 'gemini-3.5-flash',
        ]);
    }

    /**
     * Test 1 & 2: Landing page loads successfully with Santi branding and cultural elements.
     */
    public function test_landing_page_renders_successfully(): void
    {
        Location::factory()->create([
            'name' => 'Pura Besakih',
            'slug' => 'pura-besakih',
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SANTI');
        $response->assertSee('Discover Bali');
        $response->assertSee('Tanya Santi AI');
    }

    /**
     * Test: Language switcher switches between Indonesian and English.
     */
    public function test_language_switcher_switches_between_indonesian_and_english(): void
    {
        // 1. Indonesian test
        $responseId = $this->get('/?lang=id');
        $responseId->assertStatus(200);
        $responseId->assertSee('Tanya Santi AI');
        $responseId->assertSee('Panduan Budaya AI untuk Menjelajahi Bali');

        // 2. English test
        $responseEn = $this->get('/?lang=en');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Ask Santi AI');
        $responseEn->assertSee('Your AI Cultural Guide to Exploring Bali');

        // 3. Route switch
        $responseSwitch = $this->get('/lang/en');
        $responseSwitch->assertRedirect();
    }

    /**
     * Test: Language switcher supports multiple international tourist languages.
     */
    public function test_language_switcher_supports_multiple_international_tourist_languages(): void
    {
        $locales = ['zh', 'ja', 'ru', 'fr', 'de'];

        foreach ($locales as $locale) {
            $response = $this->get('/?lang='.$locale);
            $response->assertStatus(200);

            $switch = $this->get('/lang/'.$locale);
            $switch->assertRedirect();
        }
    }

    /**
     * Test 3 & 4: Location directory page displays all active locations.
     */
    public function test_locations_directory_displays_active_locations(): void
    {
        $activeLocation = Location::factory()->create([
            'name' => 'Pura Luhur Uluwatu',
            'slug' => 'pura-uluwatu',
            'is_active' => true,
        ]);

        $inactiveLocation = Location::factory()->create([
            'name' => 'Pura Non-Aktif',
            'slug' => 'pura-non-aktif',
            'is_active' => false,
        ]);

        $response = $this->get('/locations');

        $response->assertStatus(200);
        $response->assertSee('Pura Luhur Uluwatu');
        $response->assertDontSee('Pura Non-Aktif');
        $response->assertSee('/panduan/pura-uluwatu');
        $response->assertSee('Lihat Panduan Adat');
    }

    /**
     * Test: Guidelines page renders successfully with categorized rules and official sources.
     */
    public function test_guidelines_page_renders_successfully_with_categorized_rules(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Agung Besakih',
            'slug' => 'pura-besakih',
            'description' => 'Pura terbesar dan tersuci di Pulau Bali (Mother Temple).',
            'address' => 'Jl. Gunung Agung, Desa Besakih, Karangasem',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Kewajiban Busana Sopan Adat',
            'content' => 'Setiap pengunjung wajib mengenakan kamen dan senteng.',
            'source_name' => 'Pedoman PHDI Bali',
            'source_url' => 'https://phdi.or.id',
            'is_verified' => true,
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'sacred_area',
            'title' => 'Zona Sakral Utama Mandala',
            'content' => 'Area Utama Mandala dikhususkan untuk umat yang bersembahyang.',
            'source_name' => 'Tata Tertib Pengelola Besakih',
            'is_verified' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/panduan/pura-besakih');

        $response->assertStatus(200);
        $response->assertSee('Pura Agung Besakih');
        $response->assertSee('Jl. Gunung Agung, Desa Besakih, Karangasem');
        $response->assertSee('Kewajiban Busana Sopan Adat');
        $response->assertSee('Zona Sakral Utama Mandala');
        $response->assertSee('Pedoman PHDI Bali');
        $response->assertSee('Masih Ada Pertanyaan? Tanya Santi AI');
        $response->assertSee(route('santi.show', 'pura-besakih'));
    }

    /**
     * Test: Guidelines page aborts with 404 for inactive location.
     */
    public function test_guidelines_page_aborts_for_inactive_location(): void
    {
        Location::factory()->create([
            'name' => 'Pura Non-Aktif',
            'slug' => 'pura-non-aktif-2',
            'is_active' => false,
        ]);

        $response = $this->get('/panduan/pura-non-aktif-2');

        $response->assertStatus(404);
    }

    /**
     * Test: Guidelines page covers diverse tourism destinations such as cultural heritage villages.
     */
    public function test_guidelines_page_covers_cultural_village_tourism(): void
    {
        $village = Location::factory()->create([
            'name' => 'Desa Wisata Adat Penglipuran',
            'slug' => 'desa-penglipuran',
            'description' => 'Desa adat terbersih di dunia dengan arsitektur bambu.',
            'address' => 'Kelurahan Kubu, Bangli, Bali',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $village->id,
            'category' => 'behavior',
            'title' => 'Zona Bebas Kendaraan Bermotor',
            'content' => 'Kawasan utama desa merupakan zona steril kendaraan bermotor.',
            'source_name' => 'Awig-Awig Desa Adat Penglipuran',
            'is_verified' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/panduan/desa-penglipuran');

        $response->assertStatus(200);
        $response->assertSee('Desa Wisata Adat Penglipuran');
        $response->assertSee('Zona Bebas Kendaraan Bermotor');
        $response->assertSee('Awig-Awig Desa Adat Penglipuran');
    }

    /**
     * Test 5: AI Cultural Assistant page opens for an active location.
     */
    public function test_chat_page_opens_for_active_location(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Tirta Empul',
            'slug' => 'pura-tirta-empul',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'title' => 'Tata Tertib Melukat',
            'is_verified' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/santi/pura-tirta-empul');

        $response->assertStatus(200);
        $response->assertSee('Pura Tirta Empul');
        $response->assertSee('Om Swastiastu');
        $response->assertSee('Santi AI Cultural Guardian');
    }

    /**
     * Test: AI Cultural Assistant page opens in general mode covering all Bali destinations (/santi).
     */
    public function test_chat_page_opens_in_general_mode_covering_all_bali_destinations(): void
    {
        $seluruhBali = Location::factory()->create([
            'name' => 'Seluruh Wisata & Budaya Bali',
            'slug' => 'seluruh-bali',
            'address' => 'Provinsi Bali (9 Kabupaten & Kota)',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $seluruhBali->id,
            'title' => 'Etika Busana di Pantai vs Ruang Publik (SE Gubernur No. 4/2023)',
            'is_verified' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/santi');

        $response->assertStatus(200);
        $response->assertSee('Santi AI Cultural Guardian');
        $response->assertSee('Om Swastiastu! Rahajeng rauh ring Bali.');
    }

    /**
     * Test 6: Chat page returns 404 for inactive location.
     */
    public function test_chat_page_aborts_for_inactive_location(): void
    {
        Location::factory()->create([
            'name' => 'Pura Tutup',
            'slug' => 'pura-tutup',
            'is_active' => false,
        ]);

        $response = $this->get('/santi/pura-tutup');

        $response->assertStatus(404);
    }

    /**
     * Test 7 & 8: Chat endpoint provides AI answer using location context and verified rules.
     */
    public function test_chat_provides_verified_guidance_via_gemini_api(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Agung Besakih',
            'slug' => 'pura-besakih',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Kewajiban Kamen dan Senteng',
            'content' => 'Wajib mengenakan kamen dan senteng di pinggang. Celana pendek dilarang.',
            'source_name' => 'Pedoman PHDI Bali',
            'source_url' => 'https://phdi.or.id',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Om Swastiastu. Di Pura Agung Besakih, Anda wajib mengenakan kamen dan senteng.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/chat', [
            'message' => 'Apakah boleh memakai celana pendek?',
            'location_slug' => 'pura-besakih',
            'language' => 'id',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'answer' => 'Om Swastiastu. Di Pura Agung Besakih, Anda wajib mengenakan kamen dan senteng.',
            'location' => [
                'name' => 'Pura Agung Besakih',
                'slug' => 'pura-besakih',
            ],
        ]);

        $this->assertCount(1, $response->json('sources'));
        $this->assertEquals('Kewajiban Kamen dan Senteng', $response->json('sources.0.title'));
        $this->assertEquals('Pedoman PHDI Bali', $response->json('sources.0.source_name'));
    }

    /**
     * Test: Chat endpoint works for all Bali general scope (seluruh-bali).
     */
    public function test_chat_provides_guidance_for_all_bali_general_scope(): void
    {
        $seluruhBali = Location::factory()->create([
            'name' => 'Seluruh Wisata & Budaya Bali',
            'slug' => 'seluruh-bali',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $seluruhBali->id,
            'category' => 'general',
            'title' => 'Regulasi Pariwisata SE No. 4/2023',
            'content' => 'Wisatawan wajib menghormati adat istiadat dan berbusana sopan.',
            'source_name' => 'SE Gubernur Bali No. 4/2023',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Om Swastiastu. Seluruh wisatawan di Bali wajib menghormati adat istiadat.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/chat', [
            'message' => 'haiii',
            'location_slug' => 'seluruh-bali',
            'language' => 'id',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'answer' => 'Om Swastiastu. Seluruh wisatawan di Bali wajib menghormati adat istiadat.',
            'location' => [
                'name' => 'Seluruh Wisata & Budaya Bali',
                'slug' => 'seluruh-bali',
            ],
        ]);
        $this->assertNotEmpty($response->json('sources'));
    }

    /**
     * Test 9: Unverified rules are not served as official rules (insufficient_verified_information).
     */
    public function test_location_without_verified_rules_returns_insufficient_verified_info_status(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Desa Simulasi',
            'slug' => 'pura-desa-simulasi',
            'is_active' => true,
        ]);

        // Create ONLY an unverified rule
        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'title' => 'Catatan Draft Tidak Terverifikasi',
            'content' => 'Belum diverifikasi oleh prajuru.',
            'is_verified' => false,
            'is_active' => true,
        ]);

        $response = $this->postJson('/chat', [
            'message' => 'Apa aturan di pura ini?',
            'location_slug' => 'pura-desa-simulasi',
            'language' => 'id',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'insufficient_verified_information',
        ]);

        $this->assertEmpty($response->json('sources'));
        $this->assertStringContainsString('belum memiliki aturan adat resmi', $response->json('answer'));
    }

    /**
     * Test 10 & 11: English language mode responds appropriately.
     */
    public function test_chat_supports_english_language(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Luhur Uluwatu',
            'slug' => 'pura-uluwatu',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Sarong and Yellow Sash Requirement',
            'content' => 'Visitors must wear a sarong and yellow sash before entering.',
            'source_name' => 'Uluwatu Management',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Om Swastiastu. Visitors must wear a sarong and yellow sash.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/chat', [
            'message' => 'Can I wear shorts?',
            'location_slug' => 'pura-uluwatu',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'answer' => 'Om Swastiastu. Visitors must wear a sarong and yellow sash.',
        ]);
    }

    /**
     * Test 12: Validation rules are strictly enforced.
     */
    public function test_chat_validates_inputs_strictly(): void
    {
        // 1. Missing message
        $response = $this->postJson('/chat', [
            'location_slug' => 'pura-besakih',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['message']);

        // 2. Message exceeds 1000 characters
        $responseLong = $this->postJson('/chat', [
            'message' => str_repeat('a', 1001),
            'location_slug' => 'pura-besakih',
        ]);
        $responseLong->assertStatus(422);
        $responseLong->assertJsonValidationErrors(['message']);

        // 3. Non-existent location
        $responseInvalidLoc = $this->postJson('/chat', [
            'message' => 'Halo Santi',
            'location_slug' => 'lokasi-tidak-ada-xyz',
        ]);
        $responseInvalidLoc->assertStatus(422);
        $responseInvalidLoc->assertJsonValidationErrors(['location_slug']);
    }

    /**
     * Test 13: Gemini API error is handled gracefully without leaking sensitive details.
     */
    public function test_gemini_api_error_is_handled_gracefully(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Agung Besakih',
            'slug' => 'pura-besakih',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'title' => 'Pedoman Pura',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response(['error' => 'Internal AI failure'], 500),
        ]);

        $response = $this->postJson('/chat', [
            'message' => 'Apakah boleh foto?',
            'location_slug' => 'pura-besakih',
            'language' => 'id',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
        ]);
        $this->assertStringNotContainsString('test-fake-gemini-key', $response->getContent());
        $this->assertStringContainsString('Terjadi kendala saat menghubungi layanan Santi AI', $response->json('answer'));
    }

    /**
     * Test 14: Chat accepts previous long AI response in conversation history (>1500 chars) without 422 error.
     */
    public function test_chat_accepts_conversation_history_with_long_ai_response(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Agung Besakih',
            'slug' => 'pura-besakih',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Kewajiban Kamen dan Senteng',
            'content' => 'Wajib mengenakan kamen dan senteng di pinggang.',
            'source_name' => 'Pedoman PHDI Bali',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Om Swastiastu! Berikut panduan lengkap penyewaan busana adat di Pura Besakih.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        // Long answer (> 1500 chars) returned in previous turn
        $longPreviousAiAnswer = 'Om Swastiastu! 🙏✨ '.str_repeat('Penjelasan tata krama busana adat Bali dan etika persembahyangan yang mendalam bagi wisatawan. ', 25);
        $this->assertGreaterThan(1500, strlen($longPreviousAiAnswer));

        $response = $this->postJson('/chat', [
            'message' => 'Di mana saya bisa menyewa kamen tersebut?',
            'location_slug' => 'pura-besakih',
            'language' => 'id',
            'history' => [
                ['role' => 'user', 'content' => 'Bagaimana aturan pakaian di Pura Besakih?'],
                ['role' => 'model', 'content' => $longPreviousAiAnswer],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'answer' => 'Om Swastiastu! Berikut panduan lengkap penyewaan busana adat di Pura Besakih.',
        ]);

        Http::assertSent(function (Request $request) {
            $contents = $request['contents'];

            // First turn must be user, second model, third user
            return count($contents) === 3
                && $contents[0]['role'] === 'user'
                && $contents[1]['role'] === 'model'
                && $contents[2]['role'] === 'user';
        });
    }

    /**
     * Test 15: Multi-turn history beyond window is condensed and formatted to alternating turns.
     */
    public function test_chat_handles_multi_turn_history_and_condenses_older_turns(): void
    {
        $location = Location::factory()->create([
            'name' => 'Pura Agung Besakih',
            'slug' => 'pura-besakih',
            'is_active' => true,
        ]);

        CulturalRule::factory()->create([
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Kewajiban Kamen dan Senteng',
            'content' => 'Wajib mengenakan kamen dan senteng.',
            'is_verified' => true,
            'is_active' => true,
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Matur suksma! Biaya sewa kamen biasanya berkisar Rp 10.000 - Rp 20.000.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        // Create 8 history messages (4 turns)
        $history = [
            ['role' => 'user', 'content' => 'Pertanyaan 1: Pura Besakih di mana?'],
            ['role' => 'model', 'content' => 'Jawaban 1: Terletak di lereng Gunung Agung.'],
            ['role' => 'user', 'content' => 'Pertanyaan 2: Jam berapa buka?'],
            ['role' => 'model', 'content' => 'Jawaban 2: Buka dari jam 08:00 hingga 18:00 WITA.'],
            ['role' => 'user', 'content' => 'Pertanyaan 3: Boleh pakai celana pendek?'],
            ['role' => 'model', 'content' => 'Jawaban 3: Wajib memakai kamen dan senteng.'],
            ['role' => 'user', 'content' => 'Pertanyaan 4: Apakah ada tempat sewa kamen?'],
            ['role' => 'model', 'content' => 'Jawaban 4: Ada di dekat loket tiket masuk.'],
        ];

        $response = $this->postJson('/chat', [
            'message' => 'Pertanyaan 5: Berapa kisaran biayanya?',
            'location_slug' => 'pura-besakih',
            'language' => 'id',
            'history' => $history,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'answer' => 'Matur suksma! Biaya sewa kamen biasanya berkisar Rp 10.000 - Rp 20.000.',
        ]);

        Http::assertSent(function (Request $request) {
            $contents = $request['contents'];
            $this->assertNotEmpty($contents);

            // Verify alternating sequence
            $expectedRole = 'user';
            foreach ($contents as $turn) {
                $this->assertSame($expectedRole, $turn['role']);
                $expectedRole = ($expectedRole === 'user') ? 'model' : 'user';
            }

            // Verify last turn is the new user prompt
            $lastTurn = end($contents);
            $this->assertSame('user', $lastTurn['role']);
            $this->assertStringContainsString('Berapa kisaran biayanya?', $lastTurn['parts'][0]['text']);

            return true;
        });
    }
}
