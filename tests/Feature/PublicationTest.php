<?php

namespace Tests\Feature;

use App\Models\Publication;
use App\Models\Resume;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PublicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_admin_resume_page_lists_publications_newest_first()
    {
        $resume = Resume::factory()->create();
        $older = Publication::factory()->create(['resume_id' => $resume->id, 'published_at' => '2020-01-15']);
        $newer = Publication::factory()->create(['resume_id' => $resume->id, 'published_at' => '2024-06-01']);

        $this->get(route('admin.resume'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('admin/Resume')
                ->has('resume.publications', 2)
                ->where('resume.publications.0.id', $newer->id)
                ->where('resume.publications.0.published_at', '2024-06-01')
                ->where('resume.publications.1.id', $older->id));
    }

    public function test_a_publication_can_be_added()
    {
        $resume = Resume::factory()->create();

        $response = $this->from(route('admin.resume'))->post(route('admin.publications.store'), [
            'resume_id' => $resume->id,
            'title' => 'On Testing',
            'authors' => 'A. Author, B. Author',
            'publisher' => 'Journal of Tests',
            'published_at' => '2025-02-03',
            'url' => 'https://example.com/on-testing',
            'description' => '',
        ]);

        $response->assertRedirect(route('admin.resume'));
        $publication = $resume->publications()->sole();
        $this->assertSame('On Testing', $publication->title);
        $this->assertSame('2025-02-03', $publication->toArray()['published_at']);
        $this->assertNull($publication->description);
    }

    public function test_adding_a_publication_validates_its_fields()
    {
        $response = $this->post(route('admin.publications.store'), [
            'resume_id' => 999,
            'title' => '',
            'publisher' => '',
            'published_at' => 'not-a-date',
            'url' => 'not-a-url',
        ]);

        $response->assertSessionHasErrors(['resume_id', 'title', 'publisher', 'published_at', 'url']);
        $this->assertSame(0, Publication::count());
    }

    public function test_a_publication_can_be_updated()
    {
        $publication = Publication::factory()->create(['title' => 'Old Title']);

        $response = $this->from(route('admin.resume'))->put(route('admin.publications.update', $publication), [
            'title' => 'New Title',
            'authors' => null,
            'publisher' => 'New Publisher',
            'published_at' => '2023-11-20',
            'url' => null,
            'description' => 'Revised.',
        ]);

        $response->assertRedirect(route('admin.resume'));
        $publication->refresh();
        $this->assertSame('New Title', $publication->title);
        $this->assertSame('New Publisher', $publication->publisher);
        $this->assertNull($publication->authors);
        $this->assertSame('Revised.', $publication->description);
    }

    public function test_updating_a_publication_validates_its_fields()
    {
        $publication = Publication::factory()->create(['title' => 'Old Title']);

        $response = $this->put(route('admin.publications.update', $publication), [
            'title' => '',
            'publisher' => '',
            'published_at' => '',
        ]);

        $response->assertSessionHasErrors(['title', 'publisher', 'published_at']);
        $this->assertSame('Old Title', $publication->refresh()->title);
    }

    public function test_a_publication_can_be_deleted()
    {
        $publication = Publication::factory()->create();

        $response = $this->from(route('admin.resume'))->delete(route('admin.publications.destroy', $publication));

        $response->assertRedirect(route('admin.resume'));
        $this->assertModelMissing($publication);
    }
}
