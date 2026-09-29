<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-8 years', '-1 year');

        return [
            'title' => fake()->jobTitle(),
            'company' => fake()->company(),
            'location' => fake()->city().', '.fake()->stateAbbr(),
            'start_date' => $startDate,
            'end_date' => fake()->optional(0.7)->dateTimeBetween($startDate, 'now'),
            'description' => fake()->paragraph(3),
            'resume_id' => Resume::factory(),
        ];
    }

    /**
     * Indicate that the experience is the person's current position.
     */
    public function current(): static
    {
        return $this->state(fn (array $attributes) => [
            'end_date' => null,
        ]);
    }
}
