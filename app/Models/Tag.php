<?php

namespace App\Models;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Tag
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
 * @method static Builder|Tag findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereSlug($value)
 * @method static Builder|Tag whereTitle($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @property-read TagTranslation|null $translation
 * @property-read Collection|TagTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|Tag listsTranslations($translationField)
 * @method static Builder|Tag notTranslatedIn($locale = null)
 * @method static Builder|Tag orWhereTranslation($translationField, $value, $locale = null)
 * @method static Builder|Tag orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static Builder|Tag orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static Builder|Tag translated()
 * @method static Builder|Tag translatedIn($locale = null)
 * @method static Builder|Tag whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static Builder|Tag whereTranslationLike($translationField, $value, $locale = null)
 * @method static Builder|Tag withTranslation()
 */
class Tag extends AppModel implements TranslatableContract
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    /**
     * Project Database Dependencies
     *
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_tags',
            'tag_id',
            'project_id'
        );

    }

    /**
     * Add new tag
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
    public static function getAllTagsList()
    {
        return Tag::with('translations')->get()->pluck('title', 'id')->all();
    }
}
