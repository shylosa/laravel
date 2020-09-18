<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class Photo
 *
 * @package App
 * @property int $id
 * @property string $image
 * @property string $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @method static Builder|Photo newModelQuery()
 * @method static Builder|Photo newQuery()
 * @method static Builder|Photo query()
 * @method static Builder|Photo whereCreatedAt($value)
 * @method static Builder|Photo whereId($value)
 * @method static Builder|Photo whereImage($value)
 * @method static Builder|Photo whereProjectId($value)
 * @method static Builder|Photo whereUpdatedAt($value)
 * @mixin Eloquent
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
        $photo = new static();
        $photo->fill($fields);
        $photo->save();

        return $photo;
    }

    /**
     * Getting a photo belonging to the project
     *
     * @return string
     */
    public function getPhoto()
    {
        if ($this->image === null) {
            self::noImage();
        }

        return '/uploads/' . $this->image;
    }

    /**
     * @return string
     */
    public static function noPhoto()
    {
        return '/img/no-image.png';
    }

    /**
     * Remove image from uploads directory
     */
    public function removePhoto()
    {
        if ($this->image !== null) {
            Storage::delete(Project::UPLOAD_PATH . $this->image);
        }
    }
}
