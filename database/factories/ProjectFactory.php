<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Non-image document types, keyed by extension.
     *
     * @var array<string, string>
     */
    private const DOCUMENT_TYPES = [
        'pdf' => 'application/pdf',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'csv' => 'text/csv',
        'txt' => 'text/plain',
        'zip' => 'application/zip',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->sentence(3);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => fake()->sentence(12),
            'role' => fake()->randomElement(['Instructional Designer', 'eLearning Developer', 'Learning Experience Designer']),
            'audience' => fake()->randomElement(['New hires', 'Sales associates', 'Healthcare staff', 'Undergraduate students']),
            'completed_at' => fake()->date('F Y'),
            'challenge' => fake()->paragraph(3),
            'solution' => fake()->paragraph(3),
            'modality' => fake()->randomElement(['eLearning', 'Instructor-led', 'Blended', 'Microlearning', 'Video']),
            'learning_objectives' => fake()->sentences(random_int(3, 5)),
            'process' => fake()->paragraphs(2, true),
            'seat_time' => fake()->optional()->randomElement(['15 minutes', '30 minutes', '1 hour', '2 hours']),
            'design_rationale' => fake()->paragraph(3),
            'demo_url' => fake()->optional()->url(),
            'sort_order' => fake()->numberBetween(0, 20),
            'is_published' => fake()->boolean(80),
            'featured' => fake()->boolean(25),
            'reflection' => fake()->optional()->paragraph(2),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Project $project) {
            $file = UploadedFile::fake()->image('hero.jpg');

            $project->addMedia($file)
                ->toMediaCollection('hero');

            foreach (range(1, random_int(2, 4)) as $i) {
                $project->addMedia(UploadedFile::fake()->image("gallery-{$i}.jpg", 1200, 800))
                    ->toMediaCollection('gallery');
            }

            foreach (range(1, random_int(1, 3)) as $i) {
                $project->addMedia(UploadedFile::fake()->image("storyboard-{$i}.png", 1280, 720))
                    ->toMediaCollection('storyboard');
            }

            foreach ($this->fakeDocuments(random_int(1, 3)) as $document) {
                $project->addMedia($document)
                    ->toMediaCollection('design_docs');
            }
        });
    }

    /**
     * Build a mix of fake files, always including at least one non-image.
     *
     * @return list<UploadedFile>
     */
    private function fakeDocuments(int $count): array
    {
        $documents = [$this->fakeDocument()];

        while (count($documents) < $count) {
            $documents[] = fake()->boolean(30)
                ? UploadedFile::fake()->image(fake()->unique()->slug(2).'.png', 800, 600)
                : $this->fakeDocument();
        }

        return $documents;
    }

    private function fakeDocument(): UploadedFile
    {
        $extension = fake()->randomKey(self::DOCUMENT_TYPES);

        return UploadedFile::fake()->create(
            fake()->unique()->slug(2).'.'.$extension,
            random_int(20, 500),
            self::DOCUMENT_TYPES[$extension],
        );
    }
}
