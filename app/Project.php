<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class Project extends Model
{
    use Sluggable;

    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;

    protected $fillable = ['title', 'description', 'date'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tags',
            'project_id',
            'tag_id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields)
    {
        $project = new static();
        $project->fill($fields);
        //$project->user_id = 1;

        $project->save();

        return $project;
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove(): void
    {
        $this->removeImage();
        try {
            $this->delete();
        } catch (\Exception $e) {
        }
    }

    public function removeImage()
    {
        if($this->main_image !== null)
        {
            Storage::delete('uploads/' . $this->main_image);
        }
    }

    public function uploadImage($image)
    {
        if($image === null) { return; }

        $this->removeImage();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->main_image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if($this->main_image === null)
        {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->main_image;
    }

    public function setCategory($id): void
    {
        if($id === null) {return;}
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids): void
    {
        if($ids === null){return;}

        $this->tags()->sync($ids);
    }

    public function setDraft(): void
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    public function setPublic(): void
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value): void
    {
        if($value === null)
        {
            $this->setDraft();
        }

        $this->setPublic();
    }

    public function setPopular(): void
    {
        $this->is_popular = 1;
        $this->save();
    }

    public function setStandart(): void
    {
        $this->is_popular = 0;
        $this->save();
    }

    public function togglePopular($value): void
    {
        if($value === null)
        {
            $this->setStandart();
        }

        $this->setPopular();
    }

    public function setDateAttribute($value): void
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
    }

    public function getCategoryTitle()
    {
        return ($this->category !== null)
            ?   $this->category->title
            :   'Нет категории';
    }

    public function getTagsTitles()
    {
        return (!$this->tags->isEmpty())
            ?   implode(', ', $this->tags->pluck('title')->all())
            : 'Нет тегов';
    }

    public function getCategoryID()
    {
        return $this->category !== null ? $this->category->id : null;
    }

    public function getDate(): string
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }
}
