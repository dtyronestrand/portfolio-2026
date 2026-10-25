<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_home_shows_only_published_featured_projects_in_sort_order()
    {
        $second = Project::factory()->create(['is_published' => true, 'featured' => true, 'sort_order' => 2]);
        $first = Project::factory()->create(['is_published' => true, 'featured' => true, 'sort_order' => 1]);
        Project::factory()->create(['is_published' => true, 'featured' => false]);
        Project::factory()->create(['is_published' => false, 'featured' => true]);

        $this->get(route('home'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('projects', 2)
                ->where('projects.0.id', $first->id)
                ->where('projects.1.id', $second->id)
            );
    }

    public function test_home_limits_featured_projects_to_three()
    {
        Project::factory()->count(4)->create(['is_published' => true, 'featured' => true]);

        $this->get(route('home'))
            ->assertInertia(fn (Assert $page) => $page->has('projects', 3));
    }
}
