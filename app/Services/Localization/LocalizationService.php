<?php

namespace App\Services\Localization;

use Illuminate\Support\Facades\Facade;

/**
 * Class LocalizationService
 *
 * @package App\Services\Localization
 */
class LocalizationService extends Facade
{
    /**
     * {@inheritdoc }
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return "Localization";
    }
}
