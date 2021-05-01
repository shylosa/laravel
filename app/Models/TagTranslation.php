<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class TagTranslation
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property int $tag_id
 * @property string $locale
 * @property string $title
 * @property string|null $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Tag $tag
 * @method static Builder|TagTranslation findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|TagTranslation newModelQuery()
 * @method static Builder|TagTranslation newQuery()
 * @method static Builder|TagTranslation query()
 * @method static Builder|TagTranslation whereCreatedAt($value)
 * @method static Builder|TagTranslation whereId($value)
 * @method static Builder|TagTranslation whereLocale($value)
 * @method static Builder|TagTranslation whereSlug($value)
 * @method static Builder|TagTranslation whereTagId($value)
 * @method static Builder|TagTranslation whereTitle($value)
 * @method static Builder|TagTranslation whereUpdatedAt($value)
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
