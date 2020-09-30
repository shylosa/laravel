<?php

namespace App;

use Astrotomic\Translatable\Locales;
use DB;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppModel
 * @package App
 */
abstract class AppModel extends Model
{
    /**
     * Count elements in sidebar
     *
     * @return array
     */
    public static function sidebarCount(): array
    {
        $tables = ['categories', 'projects', 'tags', 'users'];
        $count = [];
        foreach ($tables as $table) {
            try {
                $count[$table] = DB::table($table)->get()->count();
            } catch (PDOException $e) {
                echo __('Подключение не удалось: ') . $e->getMessage();
            }

        }

        return $count;
    }

    /**
     * @return array
     */
    public static function getLocales()
    {
        return config('translatable.locales');
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        $locale = app()->getLocale();
        if ($this->hasTranslation($locale)) {
            return $this->translate($locale)->slug;
        }
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        $locale = app()->getLocale();
        if ($this->hasTranslation($locale)) {
            return $this->translateOrDefault($locale)->title;
        }
    }
}
