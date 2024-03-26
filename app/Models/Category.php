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
 * Class Categories
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string $slug
 */
class Category extends AppModel implements TranslatableContract
{
    use Translatable;

    /**
     * @var string[]
     */
    public array $translatedAttributes = ['title'];

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
    public static function list(): array
    {
        return self::with('translations')->get()->pluck('title', 'id')->all();
    }
}
