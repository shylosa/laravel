<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Category
 *
 * @package App
 * @mixin Eloquent
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
 * @property-read CategoryTranslation|null $translation
 * @property-read Collection|CategoryTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|Category listsTranslations($translationField)
 * @method static Builder|Category notTranslatedIn($locale = null)
 * @method static Builder|Category orWhereTranslation($translationField, $value, $locale = null)
 * @method static Builder|Category orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static Builder|Category orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static Builder|Category translated()
 * @method static Builder|Category translatedIn($locale = null)
 * @method static Builder|Category whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static Builder|Category whereTranslationLike($translationField, $value, $locale = null)
 * @method static Builder|Category withTranslation()
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
        return self::with('translations')->get()->pluck('title', 'id')->all();
    }
}
