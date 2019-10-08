<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

class Project extends AppModel
{
    use Sluggable;

    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;
    public const IS_STANDART = 0;
    public const IS_POPULAR = 1;


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
        return $this->hasMany(Photo::class);
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
        $filename = Str::random(10) . '.' . mb_strtolower($image->getClientOriginalExtension());
        $image = Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
        });
        $path = 'uploads';
        //Проверка наличия директории и её создание при необходимости
        $this->checkDirectory($path);
        $image->save($path . '/' . $filename);
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
            return;
        }

        $this->setPublic();
    }

    public function setPopular(): void
    {
        $this->is_popular = self::IS_POPULAR;
        $this->save();
    }

    public function setStandart(): void
    {
        $this->is_popular = self::IS_STANDART;
        $this->save();
    }

    public function togglePopular($value): void
    {
        if($value === null)
        {
            $this->setStandart();
            return;
        }

        $this->setPopular();
    }

    public function setDateAttribute($value): void
    {
        //$date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
       $date = $value;
       $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value): string
    {
       // return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        return $value;
    }

    public static function getCurrentDate():string
    {
        return Carbon::now()->toDateString();
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

    public function hasCategory(): bool
    {
        return $this->category != null ? true : false;
    }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious(); //ID
        return self::find($postID);
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

    public function checkDirectory($directory)
    {
        $path = public_path() . '/' . $directory;

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }

}
