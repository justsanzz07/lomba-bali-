<?php

namespace Tests\Feature;

use App\Models\CulturalRule;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            'services.gemini.model' => 'gemini-2.5-flash',
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
        $response->assertSee('Santi Cultural Guardian');
        $response->assertSee('Discover the Magic of Bali');
        $response->assertSee('Tanya Santi AI');
        $response->assertSee('Pura Besakih');
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
}

