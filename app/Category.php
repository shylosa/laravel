<?php

namespace App;

use App;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Category
 *
 * @package App
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Project[] $projects
 * @property-read int|null $projects_count
 * @method static Builder|Category findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends AppModel implements TranslatableContract
{
    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Project Database Dependencies
     *
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Add new category
     *
     * @return static
     */
    public static function add(): self
    {
        $model = new static();
        $model->save();

        return $model;
    }

    /**
     * @return array
     */
    public static function getAllCategoriesList()
    {
        return Category::with('translations')->get()->pluck('title', 'id')->all();
    }
}
