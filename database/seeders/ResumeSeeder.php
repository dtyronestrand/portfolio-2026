<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Publication;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resume = Resume::factory()->create();

        Experience::factory(4)->create(['resume_id' => $resume->id]);
        Experience::factory()->current()->create(['resume_id' => $resume->id]);

        Education::factory(2)->create(['resume_id' => $resume->id]);

        Publication::factory(3)->create(['resume_id' => $resume->id]);

        $resume->skills()->attach(
            Skill::inRandomOrder()->limit(8)->pluck('id')
                ->mapWithKeys(fn (int $id, int $index) => [$id => ['sort_order' => $index + 1]])
        );
    }
}
