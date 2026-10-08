<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

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
        return [
            'name' => fake()->sentence(3),
            'problem' => fake()->paragraph(3),
            'product' => fake()->paragraph(3),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Project $project) {
            $file = UploadedFile::fake()->image('hero.jpg');

            $project->addMedia($file)
                ->toMediaCollection('hero');

            foreach ($this->fakeDocuments(random_int(1, 3)) as $attachment) {
                $project->addMedia($attachment)
                    ->toMediaCollection('attachments');
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
        $attachments = [$this->fakeDocument()];

        while (count($attachments) < $count) {
            $attachments[] = fake()->boolean(30)
                ? UploadedFile::fake()->image(fake()->unique()->slug(2).'.png', 800, 600)
                : $this->fakeDocument();
        }

        return $attachments;
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
