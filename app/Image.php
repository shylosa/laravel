<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    //
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
