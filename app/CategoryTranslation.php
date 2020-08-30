<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends AppModel
{
    protected $fillable = ['category_id', 'locale', 'title'];

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
