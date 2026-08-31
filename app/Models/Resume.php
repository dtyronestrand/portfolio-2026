<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Fillable(['name', 'email', 'phone', 'summary'])]
class Resume extends Model
{
  public function experiences(): HasMany
  {
      return $this->hasMany(Experience::class);
  }

  public function educations(): HasMany
  {
      return $this->hasMany(Education::class);
  }
}
