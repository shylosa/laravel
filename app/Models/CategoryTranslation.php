<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class CategoryTranslation
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $title
 * @property string|null $slug
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
