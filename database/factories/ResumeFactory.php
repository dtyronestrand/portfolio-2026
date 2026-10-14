<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resume>
 */
class ResumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => [
                'street' => fake()->streetAddress(),
                'city' => fake()->city(),
                /** @phpstan-ignore-next-line */
                'state' => fake('en_US')->state(),
            ],
            'summary' => fake()->paragraph(4),
        ];
    }
}
