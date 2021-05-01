<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class ProjectTranslation
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property int $project_id
 * @property string $locale
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $customer_name
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @method static Builder|ProjectTranslation findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|ProjectTranslation newModelQuery()
 * @method static Builder|ProjectTranslation newQuery()
 * @method static Builder|ProjectTranslation query()
 * @method static Builder|ProjectTranslation whereAddress($value)
 * @method static Builder|ProjectTranslation whereCreatedAt($value)
 * @method static Builder|ProjectTranslation whereCustomerName($value)
 * @method static Builder|ProjectTranslation whereDescription($value)
 * @method static Builder|ProjectTranslation whereId($value)
 * @method static Builder|ProjectTranslation whereLocale($value)
 * @method static Builder|ProjectTranslation whereProjectId($value)
 * @method static Builder|ProjectTranslation whereSlug($value)
 * @method static Builder|ProjectTranslation whereTitle($value)
 * @method static Builder|ProjectTranslation whereUpdatedAt($value)
 */
class ProjectTranslation extends AppModel
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    protected $fillable = ['title', 'slug', 'description', 'customer_name', 'address'];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
