<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectTranslation
 * @package App
 * @mixin Eloquent
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
