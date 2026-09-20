<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#{Fillable(['filename', 'mime_type', 'size'])}
class Media extends Model
{
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
