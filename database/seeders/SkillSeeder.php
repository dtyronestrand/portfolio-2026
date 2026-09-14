<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillCategory::factory(5)
            ->create()
            ->each(function (SkillCategory $category) {
                Skill::factory(random_int(3, 6))->create([
                    'skill_category_id' => $category->id,
                ]);
            });
    }
}
