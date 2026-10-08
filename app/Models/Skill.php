<?php

namespace App\Models;

use App\Enums\SkillLevel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'level',  'skill_category_id'])]
class Skill extends Model
{
    use HasFactory;

    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function resumes(): BelongsToMany
    {
        return $this->belongsToMany(Resume::class)->withPivot('sort_order')->withTimestamps();
    }

    protected function casts(): array
    {
        return [
            'level' => SkillLevel::class,
        ];
    }
}
