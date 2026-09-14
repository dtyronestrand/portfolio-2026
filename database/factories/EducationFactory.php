<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-10 years', '-4 years');

        return [
            'school' => fake()->company().' University',
            'degree' => fake()->randomElement([
                'Bachelor of Science', 'Bachelor of Arts', 'Master of Science', 'Associate of Science',
            ]),
            'field_of_study' => fake()->randomElement([
                'Computer Science', 'Software Engineering', 'Information Technology',
                'Web Development', 'Data Science',
            ]),
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, '-1 year'),
            'description' => fake()->paragraph(2),
            'resume_id' => Resume::factory(),
        ];
    }
}
