<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class Photo
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property string $image
 * @property string $project_id
 */
class Photo extends AppModel
{

    protected $fillable = ['project_id', 'image', 'is_main'];

    /**
     * Project Database Dependencies
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Add new photo
     *
     * @param array $fields
     * @return static
     */
    public static function add(array $fields): self
    {
        $photo = new self();
        $photo->fill($fields);
        $photo->save();

        return $photo;
    }

    /**
     * Getting a photo belonging to the project
     *
     * @return string
     */
    public function getPhoto(): string
    {
        if ($this->image === null) {
            return self::noPhoto();
        }

        return '/uploads/' . $this->image;
    }

    /**
     * @return string
     */
    public static function noPhoto(): string
    {
        return '/img/no-image.png';
    }

    /**
     * Remove image from uploads directory
     */
    public function removePhoto(): void
    {
        if ($this->image !== null) {
            Storage::delete(Project::UPLOAD_PATH . $this->image);
        }
    }
}
