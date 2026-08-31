<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name', 'level',  'skill_category_id'])]
class Skill extends Model
{
   public function skillCategory(): BelongsTo
   {
       return $this->belongsTo(SkillCategory::class);
   }
}
