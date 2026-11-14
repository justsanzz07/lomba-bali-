<?php

namespace Tests\Feature;

use App\Models\CulturalRule;
use App\Models\Location;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Administrator Santi',
            'email' => 'admin@santi.bali',
            'password' => Hash::make('SantiBali2026!'),
        ]);
    }

    public function test_guest_cannot_access_admin_dashboard_and_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_admin_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Panel Pengelola Santi AI');
        $response->assertSee('admin@santi.bali');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@santi.bali',
            'password' => 'SantiBali2026!',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@santi.bali',
            'password' => 'WrongPassword123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Ringkasan dan Statistik Budaya');
        $response->assertSee('Kelola Konten dan Pedoman Adat Bali');
    }

    public function test_admin_can_view_locations_index(): void
    {
        Location::factory()->create([
            'name' => 'Pura Tanah Lot Test',
            'slug' => 'pura-tanah-lot-test',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/locations');

        $response->assertStatus(200);
        $response->assertSee('Pura Tanah Lot Test');
        $response->assertSee('/panduan/pura-tanah-lot-test');
    }

    public function test_admin_can_create_new_destination(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/locations', [
            'name' => 'Pura Tirta Gangga',
            'slug' => 'pura-tirta-gangga',
            'address' => 'Ababi, Abang, Karangasem',
            'description' => 'Taman air peninggalan Kerajaan Karangasem dengan kolam suci dan arca batu.',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/locations');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('locations', [
            'name' => 'Pura Tirta Gangga',
            'slug' => 'pura-tirta-gangga',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_destination(): void
    {
        $location = Location::factory()->create([
            'name' => 'Nama Lama',
            'slug' => 'nama-lama',
            'description' => 'Deskripsi lama.',
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/locations/{$location->slug}", [
            'name' => 'Nama Baru Diperbarui',
            'slug' => 'nama-baru-diperbarui',
            'address' => 'Karangasem, Bali',
            'description' => 'Deskripsi baru yang diperbarui.',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/locations');
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'name' => 'Nama Baru Diperbarui',
            'slug' => 'nama-baru-diperbarui',
        ]);
    }

    public function test_admin_can_toggle_destination_status(): void
    {
        $location = Location::factory()->create(['is_active' => true]);

        $response = $this->actingAs($this->admin)->post("/admin/locations/{$location->slug}/toggle");

        $response->assertRedirect();
        $this->assertFalse($location->fresh()->is_active);
    }

    public function test_admin_can_delete_destination(): void
    {
        $location = Location::factory()->create([
            'name' => 'Lokasi Dihapus',
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/locations/{$location->slug}");

        $response->assertRedirect('/admin/locations');
        $this->assertDatabaseMissing('locations', [
            'id' => $location->id,
        ]);
    }

    public function test_admin_can_create_new_cultural_rule(): void
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->admin)->post('/admin/cultural-rules', [
            'location_id' => $location->id,
            'category' => 'dress_code',
            'title' => 'Wajib Kamen dan Selendang',
            'content' => 'Wisatawan wajib mengenakan kain penutup tubuh bagian bawah.',
            'source_name' => 'Awig-Awig Adat',
            'source_url' => 'https://baliprov.go.id',
            'is_verified' => '1',
            'is_active' => '1',
        ]);

        $response->assertRedirect("/admin/cultural-rules?location_id={$location->id}");
        $this->assertDatabaseHas('cultural_rules', [
            'location_id' => $location->id,
            'title' => 'Wajib Kamen dan Selendang',
            'is_verified' => true,
        ]);
    }

    public function test_admin_can_update_cultural_rule(): void
    {
        $rule = CulturalRule::factory()->create([
            'title' => 'Judul Awal',
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/cultural-rules/{$rule->id}", [
            'location_id' => $rule->location_id,
            'category' => 'sacred_area',
            'title' => 'Judul Aturan Baru',
            'content' => 'Konten aturan baru yang sudah direvisi pengelola.',
            'source_name' => 'SE Gubernur Bali No. 4/2023',
            'source_url' => 'https://baliprov.go.id',
            'is_verified' => '1',
            'is_active' => '1',
        ]);

        $response->assertRedirect("/admin/cultural-rules?location_id={$rule->location_id}");
        $this->assertDatabaseHas('cultural_rules', [
            'id' => $rule->id,
            'title' => 'Judul Aturan Baru',
            'category' => 'sacred_area',
        ]);
    }

    public function test_admin_can_toggle_rule_verification(): void
    {
        $rule = CulturalRule::factory()->create(['is_verified' => false]);

        $response = $this->actingAs($this->admin)->post("/admin/cultural-rules/{$rule->id}/toggle-verify");

        $response->assertRedirect();
        $this->assertTrue($rule->fresh()->is_verified);
    }

    public function test_admin_can_delete_cultural_rule(): void
    {
        $rule = CulturalRule::factory()->create();

        $response = $this->actingAs($this->admin)->delete("/admin/cultural-rules/{$rule->id}");

        $response->assertRedirect("/admin/cultural-rules?location_id={$rule->location_id}");
        $this->assertDatabaseMissing('cultural_rules', [
            'id' => $rule->id,
        ]);
    }

    public function test_admin_can_update_front_page_settings_and_see_them_on_landing_page(): void
    {
        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'hero_title_1' => 'Jelajahi Keindahan Bali.',
            'hero_title_2' => 'Hormati Kesucian Adatnya.',
            'hero_subtitle' => 'Pemandu AI Budaya Resmi Provinsi Bali.',
            'announcement_banner' => 'Perhatian Khusus Hari Raya Galungan dan Kuningan.',
            'about_heading' => 'Komitmen Pelestarian Budaya Leluhur',
            'about_p1' => 'Tatanan sakral Bali dijaga melalui harmoni Tri Hita Karana.',
            'about_p2' => 'Santi AI menjadi garda digital penjaga adat.',
            'about_highlight' => '100% Berlandaskan SE No. 4/2023.',
            'emergency_phone_112' => '112-BALI',
        ]);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success');

        // Check that settings are persisted in database
        $this->assertEquals('Jelajahi Keindahan Bali.', SiteSetting::get('hero_title_1'));
        $this->assertEquals('Perhatian Khusus Hari Raya Galungan dan Kuningan.', SiteSetting::get('announcement_banner'));

        // Visit landing page and verify custom text appears
        $landingResponse = $this->get('/?lang=id');
        $landingResponse->assertStatus(200);
        $landingResponse->assertSee('Jelajahi Keindahan Bali.');
        $landingResponse->assertSee('Hormati Kesucian Adatnya.');
        $landingResponse->assertSee('Perhatian Khusus Hari Raya Galungan dan Kuningan.');
        $landingResponse->assertSee('Komitmen Pelestarian Budaya Leluhur');
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->admin)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
