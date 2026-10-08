<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'authors' => fake()->name().', '.fake()->name(),
            'publisher' => fake()->company(),
            'published_at' => fake()->dateTimeBetween('-8 years', 'now'),
            'url' => fake()->optional(0.7)->url(),
            'description' => fake()->optional(0.7)->paragraph(2),
            'resume_id' => Resume::factory(),
        ];
    }
}
