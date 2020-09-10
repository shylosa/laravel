<?php
/**
 * Shylo Serhii
 *
 * PHP Version 7.3.6
 *
 * @category Personal project
 * @package Laravel
 * @author Shylo Serhii <shylosa.mm@gmail.com>
 * @copyright 2020 Shylo Serhii
 * @license http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */

/**
 * Project model class for the Laravel.
 *
 * @category Personal project
 * @package Laravel
 * @author Shylo Serhii <shylosa.mm@gmail.com>
 * @copyright 2020 Shylo Serhii
 * @license http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */

namespace App;

use App;
use Carbon\Carbon;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Project (post) class
 *
 * Class Project
 *
 * @package App
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $category_id
 * @property string $customer_name
 * @property string|null $address
 * @property int $status
 * @property int $views
 * @property int $is_popular
 * @property string $date
 * @property string|null $main_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read Collection|Photo[] $images
 * @property-read int|null $images_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereAddress($value)
 * @method static Builder|Project whereCategoryId($value)
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereCustomerName($value)
 * @method static Builder|Project whereDate($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereIsPopular($value)
 * @method static Builder|Project whereMainImage($value)
 * @method static Builder|Project whereStatus($value)
 * @method static Builder|Project whereTitle($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereViews($value)
 * @mixin Eloquent
 */
class Project extends AppModel implements TranslatableContract
{
    use Translatable;

    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;
    public const IS_STANDARD = 0;
    public const IS_POPULAR = 1;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description', 'customer_name', 'address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'is_popular', 'date'];

    /**
     * Category Database Dependencies
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Tags Database Dependencies
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tags',
            'project_id',
            'tag_id'
        );
    }

    /**
     * Photos Database Dependencies
     *
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Add new project
     *
     * @param array $fields
     * @return static
     */
    public static function add(array $fields): self
    {
        $project = new static();
        $project->fill($fields);
        $project->save();

        return $project;
    }

    /**
     * Edit existing project
     *
     * @param array $fields
     */
    public function edit(array $fields): void
    {
        $this->update($fields);
        $this->save();
    }

    /**
     * Remove existing project
     */
    public function remove(): void
    {
        $this->removeImage();
        try {
            $this->delete();
        } catch (\Exception $e) {
        }
    }

    /**
     * Remove image from uploads directory
     */
    public function removeImage()
    {
        if ($this->main_image !== null) {
            Storage::delete('uploads/' . $this->main_image);
        }
    }

    /**
     * Upload image
     *
     * @param $image
     */
    public function uploadImage($image)
    {
        if ($image === null) {
            return;
        }

        $this->removeImage();
        $filename = Str::random(10) . '.' . mb_strtolower($image->getClientOriginalExtension());
        $image = Image::make($image)->resize(800, null, static function ($constraint) {
            $constraint->aspectRatio();
        });
        $path = 'uploads';

        // Check for the existence of a directory and create it if necessary
        $this->checkDirectory($path);
        $image->save($path . '/' . $filename);
        $this->main_image = $filename;
        $this->save();
    }

    /**
     * Getting a image belonging to the project
     *
     * @return string
     */
    public function getImage()
    {
        if ($this->main_image === null) {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->main_image;
    }

    /**
     * Set category for current project
     *
     * @param int $id
     */
    public function setCategory(int $id): void
    {
        if ($id === null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    /**
     * Set tag for current project
     *
     * @param $ids
     */
    public function setTags($ids): void
    {
        if ($ids === null) {
            return;
        }

        $this->tags()->sync($ids);
    }

    /**
     * Set draft status for project
     */
    public function setDraft(): void
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    /**
     * Set public status for project
     */
    public function setPublic(): void
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    /**
     * Toggle status the project
     *
     * @param $value
     */
    public function toggleStatus($value): void
    {
        if ($value === null) {
            $this->setDraft();
            return;
        }

        $this->setPublic();
    }

    /**
     * Set popular status for the project
     */
    public function setPopular(): void
    {
        $this->is_popular = self::IS_POPULAR;
        $this->save();
    }

    /**
     * Set standard status for the project
     */
    public function setStandard(): void
    {
        $this->is_popular = self::IS_STANDARD;
        $this->save();
    }

    /**
     * Toggle popular status the project
     *
     * @param $value
     */
    public function togglePopular($value): void
    {
        if ($value === null) {
            $this->setStandard();
            return;
        }

        $this->setPopular();
    }

    /**
     * Set date attribute
     *
     * @param $value
     */
    public function setDateAttribute($value): void
    {
        //$date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $date = $value;
        $this->attributes['date'] = $date;
    }

    /**
     * Get date attribute
     *
     * @param $value
     * @return string
     */
    public function getDateAttribute($value): string
    {
        // return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        return $value;
    }

    /**
     * Return current date
     *
     * @return string
     */
    public static function getCurrentDate(): string
    {
        return Carbon::now()->toDateString();
    }

    /**
     * Get title for category
     *
     * @return string
     */
    public function getCategoryTitle()
    {
        return ($this->category !== null)
            ? $this->category->title
            : 'Нет категории';
    }

    /**
     * Get tags titles
     *
     * @return string
     */
    public function getTagsTitles()
    {
        return (!$this->tags->isEmpty())
            ? implode(', ', $this->tags->pluck('title')->all())
            : 'Нет тегов';
    }

    /**
     * Get category ID
     *
     * @return int|null
     */
    public function getCategoryID()
    {
        return $this->category !== null ? $this->category->id : null;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate(): string
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }

    /**
     * Returns whether or not the given project category
     *
     * @return bool
     */
    public function hasCategory(): bool
    {
        return $this->category !== null;
    }

    /**
     * Returns whether or not the previous given project has
     *
     * @return mixed
     */
    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    /**
     * Returns previous project
     *
     * @return mixed
     */
    public function getPrevious()
    {
        $postID = $this->hasPrevious(); //ID
        return self::find($postID);
    }

    /**
     * Returns whether or not the next given project has
     *
     * @return mixed
     */
    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    /**
     * Returns next project
     *
     * @return mixed
     */
    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    /**
     * Returns related projects
     *
     * @return Project[]|Collection
     */
    public function related()
    {
        return self::all()->except($this->id);
    }

    /**
     * Check for a directory
     *
     * @param $directory
     */
    public function checkDirectory(string $directory)
    {
        $path = public_path() . '/' . $directory;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }
}
