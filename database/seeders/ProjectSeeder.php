<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(8)->create();

        Project::factory(6)
            ->create()
            ->each(function (Project $project) use ($tags) {
                $project->tags()->attach(
                    $tags->random(random_int(1, 4))->pluck('id')
                );
            });
    }
}
