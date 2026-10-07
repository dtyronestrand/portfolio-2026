<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

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
            'name' => fake()->sentence(3),
            'problem' => fake()->paragraph(3),
            'product' => fake()->paragraph(3),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Project $project) {
            $file = UploadedFile::fake()->image('hero.jpg');

            $project->addMedia($file)
                ->toMediaCollection('hero');
        });
    }
}
