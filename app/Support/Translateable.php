<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;

trait Translateable
{
    protected static function boot()
    {
        parent::boot();

        static::saved(static function ($model) {

            //Let's get our supported configurations from the config file we've created
            $locales = Config::get('locales.supported');
            foreach ($locales as $locale) {
                $model->translation()->create(['locale' => $locale]);
            }
        });
    }
}