<?php
/**
 * Serhii Shylo
 *
 * PHP Version 7.4
 *
 * @category Personal project
 * @package JOIWood
 * @author Serhii Shylo <shylosa.mm@gmail.com>
 * @copyright 2021 Serhii Shylo
 * @license http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */

/**
 * Project model class.
 *
 * @category Personal project
 * @package JOIWood
 * @author Serhii Shylo <shylosa.mm@gmail.com>
 * @copyright 2021 Serhii Shylo
 * @license http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
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
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string $main_image
 * @property string|null $description
 * @property int|null $category_id
 * @property string $customer_name
 * @property string|null $address
 * @property int $status
 * @property int $views
 * @property int $is_popular
 * @property string $date
 * @property HasMany $photos
 *
 * @property BelongsToMany Tags
 */
class Project extends AppModel implements TranslatableContract
{
    use Translatable;

    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;
    public const IS_STANDARD = 0;
    public const IS_POPULAR = 1;

    const IS_MAIN_PHOTO = 1;

    public const UPLOAD_PATH = 'uploads/';
    /**
     * @var string[]
     */
    public array $translatedAttributes = ['title', 'description', 'customer_name', 'address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'status', 'is_popular', 'date'];

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
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id');
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
        foreach ($this->photos as $photo) {
            if ($photo instanceof Photo) {
                $photo->removePhoto();
            }
        }
        try {
            $this->delete();
        } catch (Exception $e) {
        }
    }


    /**
     * Upload image
     *
     * @param array $photos
     * @param array $old_photos
     * @throws Exception
     */
    public function setPhotos(array $photos, array $old_photos): void
    {
        // Check for the existence of a directory and create it if necessary
        $this->checkDirectory(self::UPLOAD_PATH);

        // Remove old files and their database records
        if (!empty($old_photos)) {
            $photosToDelete = $this->photos->whereNotIn('id', array_map('intval', $old_photos))->all();
            foreach ($photosToDelete as $photoToDelete) {
                if ($photoToDelete instanceof Photo) {
                    $photoToDelete->removePhoto();
                    $photoToDelete->delete();
                }
            }
        }
        //Upload new files and save records in database
        if (!empty($photos)) {
            foreach ($photos as $key => $photo) {
                $fields = [];
                $filename = Str::random(10) . '.' . mb_strtolower($photo->getClientOriginalExtension());
                $file = Image::make($photo)->resize(800, null, static function ($constraint) {
                    $constraint->aspectRatio();
                });
                $file->save(self::UPLOAD_PATH . $filename);
                $fields = [
                    'project_id' => $this->id,
                    'image' => $filename,
                    'is_main' => ($key === 0) ? 1 : 0
                ];
                Photo::add($fields);
            }
        }
    }

    /**
     * Getting a image belonging to the project
     *
     * @return string
     */
    public function getImage(): string
    {
        if ($this->main_image === null) {
            return '/img/no-image.png';
        }

        return '/' . self::UPLOAD_PATH . $this->main_image;
    }

    /**
     * Set category for current project
     *
     * @param int|null $id
     */
    public function setCategory(?int $id): void
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
     * @param array|null $ids
     */
    public function setTags(?array $ids): void
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
    public function getCategoryTitle(): string
    {
        return ($this->category !== null) ? $this->category->title : __('Нет категории');
    }

    /**
     * Get tags titles
     *
     * @return string
     */
    public function getTagsTitles(): string
    {
        return (!$this->tags->isEmpty())
            ? implode(', ', $this->tags->pluck('title')->all())
            : __('Нет тегов');
    }

    /**
     * Get category ID
     *
     * @return int|null
     */
    public function getCategoryID(): ?int
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
     * Returns whether the given project category
     *
     * @return bool
     */
    public function hasCategory(): bool
    {
        return $this->category !== null;
    }

    /**
     * Returns whether the given project tags
     *
     * @return bool
     */
    public function hasTags(): bool
    {
        return $this->tags->isNotEmpty();
    }

    /**
     * Returns whether the previous given project has
     *
     * @return mixed
     */
    public function hasPrevious(): mixed
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    /**
     * Returns previous project
     *
     * @return mixed
     */
    public function getPrevious(): mixed
    {
        $postID = $this->hasPrevious(); //ID

        return self::find($postID);
    }

    /**
     * Returns whether the next given project has
     *
     * @return mixed
     */
    public function hasNext(): mixed
    {
        return self::has('translation')->where('id', '>', $this->id)->min('id');
    }

    /**
     * Returns next project
     *
     * @return mixed
     */
    public function getNext(): mixed
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
        return self::has('translation')->get()->except($this->id);
    }

    /**
     * Check for a directory
     *
     * @param string $directory
     */
    public function checkDirectory(string $directory): void
    {
        $path = public_path() . '/' . $directory;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    /**
     * @return string
     */
    public function getMainPhoto(): string
    {
        if ($this->photos->isEmpty()) {
            return '';
        }

        $photo = $this->photos->where('is_main', self::IS_MAIN_PHOTO)->first();
        if (empty($photo)) {
            return '/' . self::UPLOAD_PATH . $this->photos->first()->image;
        }

        return '/' . self::UPLOAD_PATH . $photo->image;
    }

    /**
     * @return string
     */
    public function getMainPhotoID(): string
    {
        if ($this->photos->isEmpty()) {
            return '';
        }

        $photo = $this->photos->where('is_main', self::IS_MAIN_PHOTO)->first();

        return $photo->id ?? $this->photos[0]->id;
    }

    /**
     * @return array|HasMany
     */
    public function getAdditionalPhotos()
    {
        if ($this->photos->isEmpty()) {
            return [];
        }

        return $this->photos->where('is_main', '<>', self::IS_MAIN_PHOTO)->all();
    }

    /**
     * @param $validated
     * @return void
     */
    public function saveTranslationsData($validated): void
    {
        foreach (AppModel::getLocales() as $locale) {
            $this->translateOrNew($locale)->title = $validated[$locale . '_title'];

            if (array_key_exists($locale . '_customer_name', $validated) && $validated[$locale . '_customer_name']) {
                $this->translateOrNew($locale)->customer_name = $validated[$locale . '_customer_name'];
            }

            if (array_key_exists($locale . '_address', $validated) && $validated[$locale . '_address']) {
                $this->translateOrNew($locale)->address = $validated[$locale . '_address'];
            }

            if (array_key_exists($locale . '_description', $validated) && $validated[$locale . '_description']) {
                $this->translateOrNew($locale)->description = $validated[$locale . '_description'];
            }
        }
        $this->save();
    }
}
