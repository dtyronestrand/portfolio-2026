<?php

namespace Tests\Feature;

use App\Enums\SkillLevel;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_skill_can_be_updated()
    {
        $skill = Skill::factory()->create(['name' => 'PHP', 'level' => 1]);
        $category = SkillCategory::factory()->create();

        $response = $this->put(route('admin.skills.update', $skill), [
            'name' => 'Laravel',
            'level' => 4,
            'skill_category_id' => $category->id,
        ]);

        $response->assertRedirect(route('admin.skills'));
        $skill->refresh();
        $this->assertSame('Laravel', $skill->name);
        $this->assertSame(SkillLevel::EXPERT, $skill->level);
        $this->assertSame($category->id, $skill->skill_category_id);
    }

    public function test_updating_a_skill_validates_its_fields()
    {
        $skill = Skill::factory()->create(['name' => 'PHP', 'level' => 1]);

        $response = $this->put(route('admin.skills.update', $skill), [
            'name' => '',
            'level' => 9,
            'skill_category_id' => 0,
        ]);

        $response->assertSessionHasErrors(['name', 'level', 'skill_category_id']);
        $this->assertSame('PHP', $skill->refresh()->name);
    }
}
