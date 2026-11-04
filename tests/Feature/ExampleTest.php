<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Location::factory()->create([
            'name' => 'Pura Besakih',
            'slug' => 'pura-besakih',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
