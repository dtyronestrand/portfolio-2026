<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'PHP', 'Laravel', 'JavaScript', 'TypeScript', 'Vue.js', 'React',
                'Node.js', 'Python', 'MySQL', 'PostgreSQL', 'Redis', 'Docker',
                'Kubernetes', 'AWS', 'Git', 'Tailwind CSS', 'REST APIs', 'GraphQL',
                'CI/CD', 'Linux', 'Bash', 'Jest', 'PHPUnit', 'Figma',
            ]),
            'level' => fake()->numberBetween(1, 4),
            'skill_category_id' => SkillCategory::factory(),
        ];
    }
}
