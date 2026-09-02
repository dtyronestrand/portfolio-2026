<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'company', 'location', 'start_date', 'end_date', 'description', 'resume_id'])]
class Experience extends Model
{
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
