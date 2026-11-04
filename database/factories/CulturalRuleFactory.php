<?php

namespace Database\Factories;

use App\Models\CulturalRule;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CulturalRule>
 */
class CulturalRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'category' => fake()->randomElement(['dress_code', 'behavior', 'photography', 'sacred_area', 'general']),
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'source_name' => 'Simulasi Pedoman Adat Parisada Hindu Dharma Indonesia',
            'source_url' => 'https://phdi.or.id',
            'is_verified' => true,
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the rule is unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => false,
            'source_name' => null,
            'source_url' => null,
        ]);
    }

    /**
     * Indicate that the rule is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
