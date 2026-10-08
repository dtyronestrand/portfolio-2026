<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'authors', 'publisher', 'published_at', 'url', 'description', 'resume_id'])]
class Publication extends Model
{
    use HasFactory;

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'date:Y-m-d',
        ];
    }
}
