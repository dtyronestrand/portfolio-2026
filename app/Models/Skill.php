<?php

namespace App\Models;

use App\Enums\SkillLevel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property SkillLevel $level
 * @property int $skill_category_id
 * @property-read SkillCategory|null $skillCategory
 */
#[Fillable(['name', 'level',  'skill_category_id'])]
class Skill extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo<SkillCategory, $this>
     */
    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    /**
     * @return BelongsToMany<Resume, $this>
     */
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
