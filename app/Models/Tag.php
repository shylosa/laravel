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
        $model = new self();
        $model->save();

        return $model;
    }

    /**
     * @return array
     */
    public static function list(): array
    {
        return self::with('translations')->get()->pluck('title', 'id')->all();
    }
}
