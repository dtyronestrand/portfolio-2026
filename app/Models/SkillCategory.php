<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name'])]
class SkillCategory extends Model
{
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
