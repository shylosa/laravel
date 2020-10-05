<?php

namespace App\Services\Localization;

/**
 * Class Localization
 * @package App\Services\Localization
 */
class Localization
{
    /**
     * @return string
     */
    public function locale(): string
    {
        $locale = request()->segment(1, '');

        // Set the prefix for allowed languages

        if ($locale && array_key_exists($locale, config('translatable.locales'))) {
            return $locale;
        }
        return '';
    }
}
