<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->catchPhrase(),
            'problem' => fake()->paragraph(3),
            'product' => fake()->paragraph(3),
            'hero' => fake()->imageUrl(1200, 800, 'business'),
            'attachments' => fake()->randomElements(
                array_map(fn () => fake()->imageUrl(800, 600), range(1, 5)),
                fake()->numberBetween(1, 3)
            ),
        ];
    }
}