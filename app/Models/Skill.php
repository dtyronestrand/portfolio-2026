<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\SkillLevel;

#[Fillable(['name', 'level',  'skill_category_id'])]
class Skill extends Model
{
    use HasFactory;

    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    protected function casts(): array
    {
        return [
            'level' => SkillLevel::class,
        ];
    }
}
