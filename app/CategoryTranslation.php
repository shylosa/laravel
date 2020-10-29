<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CategoryTranslation
 * @package App
 * @mixin Eloquent
 */
class CategoryTranslation extends AppModel
{
    use Sluggable;

    /**
     * @var string[]
     */
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
