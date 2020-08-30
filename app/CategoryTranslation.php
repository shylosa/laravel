<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends AppModel
{
    protected $fillable = ['category_id', 'locale', 'title'];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
