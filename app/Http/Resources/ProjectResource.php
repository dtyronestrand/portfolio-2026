<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    public static $wrap = 'project';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'role' => $this->role,
            'audience' => $this->audience,
            'completed_at' => $this->completed_at,
            'challenge' => $this->challenge,
            'solution' => $this->solution,
            'modality' => $this->modality,
            'learning_objectives' => $this->learning_objectives,
            'process' => $this->process,
            'seat_time' => $this->seat_time,
            'design_rationale' => $this->design_rationale,
            'demo_url' => $this->demo_url,
            'sort_order' => $this->sort_order,
            'is_published' => $this->is_published,
            'featured' => $this->featured,
            'reflection' => $this->reflection,
            'tags' => $this->whenLoaded('tags', fn() => $this->tags->pluck('name')->all()),
            // 'hero' is a singleFile collection, so return one URL (or null) rather than an array.
            'hero' => $this->getFirstMediaUrl('hero') ?: null,
            'gallery' => $this->mediaWithPreviews('gallery'),
            'storyboard' => $this->mediaWithPreviews('storyboard'),
            'design_docs' => $this->mediaWithPreviews('design_docs'),
            'video' => $this->mediaWithPreviews('video'),
            // MediaCollection::jsonSerialize() returns [] for relationship collections
            // (use_default_collection_serialization = false), so serialize the models directly.

        ];
    }

    /**
     * @return array<int, string>
     */
    private function getMediaUrls(string $collectionName): array
    {
        return $this->getMedia($collectionName)->map(fn($item) => $item->getUrl())->all();
    }

    private function mediaWithPreviews(string $collectionName): array
    {
        return $this->getMedia($collectionName)->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'original_url' => $item->getUrl(),
            'preview_url' => $item->hasGeneratedConversion('preview') ? $item->getUrl('preview') : null,
        ])->all();
    }
}
