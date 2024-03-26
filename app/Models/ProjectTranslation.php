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
