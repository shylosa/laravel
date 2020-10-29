<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TagTranslation
 * @package App
 * @mixin Eloquent
 */
class TagTranslation extends AppModel
{
    use Sluggable;

    protected $fillable = ['title'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    /**
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
