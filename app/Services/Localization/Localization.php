<?php

namespace App\Services\Localization;

class Localization
{
    public function locale()
    {
        $locale = request()->segment(1, '');

        if ($locale && array_key_exists($locale, config("translatable.locales"))) {
            return $locale;
        }

        return "";
    }
}
