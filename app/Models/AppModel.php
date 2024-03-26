<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppModel.
 *
 * @package App
 * @mixin Eloquent
 */
abstract class AppModel extends Model
{
    /**
     * @return array
     */
    public static function getLocales(): array
    {
        return config('translatable.locales');
    }

    /**
     * @return mixed
     */
    public function getSlug(): mixed
    {
        $locale = app()->getLocale();
        if ($this->hasTranslation($locale)) {
            return $this->translate($locale)->slug;
        }

        return '';
    }

    /**
     * @return mixed
     */
    public function getTitle(): mixed
    {
        $locale = app()->getLocale();
        if ($this->hasTranslation($locale)) {
            return $this->translateOrDefault($locale)->title;
        }

        return '';
    }
}
