<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
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
            'reflections' => $this->reflections,
        ];
    }
}
