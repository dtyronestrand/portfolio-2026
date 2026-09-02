<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['school', 'degree', 'field_of_study', 'start_date', 'end_date', 'description', 'resume_id'])]
class Education extends Model
{
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
