<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagTranslation extends AppModel
{
    protected $fillable = ['tag_id', 'locale', 'title'];

    /**
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
