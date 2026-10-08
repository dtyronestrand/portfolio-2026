<?php

namespace Tests\Feature;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Publication;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_resume_has_publications()
    {
        $resume = Resume::factory()->create();
        Publication::factory(2)->create(['resume_id' => $resume->id]);

        $this->assertCount(2, $resume->publications);
        $this->assertTrue($resume->publications->first()->resume->is($resume));
    }

    public function test_a_resume_has_skills()
    {
        $resume = Resume::factory()->create();
        $skills = Skill::factory(3)->create();

        $resume->skills()->attach($skills);

        $this->assertCount(3, $resume->skills);
        $this->assertTrue($skills->first()->resumes->first()->is($resume));
    }

    public function test_resume_skills_are_returned_in_their_manual_order()
    {
        $resume = Resume::factory()->create();
        [$first, $second, $third] = Skill::factory(3)->create();

        $resume->skills()->attach([
            $third->id => ['sort_order' => 3],
            $first->id => ['sort_order' => 1],
            $second->id => ['sort_order' => 2],
        ]);

        $this->assertSame(
            [$first->id, $second->id, $third->id],
            $resume->skills->pluck('id')->all(),
        );
    }

    public function test_experience_casts_highlights_and_dates()
    {
        $experience = Experience::factory()->create([
            'start_date' => '2020-03-01',
            'end_date' => null,
            'highlights' => ['Shipped the thing', 'Led the team'],
        ])->fresh();

        $this->assertSame(['Shipped the thing', 'Led the team'], $experience->highlights);
        $this->assertSame('2020-03-01', $experience->toArray()['start_date']);
        $this->assertNull($experience->end_date);
    }

    public function test_education_casts_dates()
    {
        $education = Education::factory()->create(['start_date' => '2015-09-01'])->fresh();

        $this->assertSame('2015-09-01', $education->toArray()['start_date']);
    }

    public function test_the_resume_seeder_adds_publications_and_skills()
    {
        $this->seed();

        $resume = Resume::first();

        $this->assertCount(3, $resume->publications);
        $this->assertNotEmpty($resume->skills);
    }
}
