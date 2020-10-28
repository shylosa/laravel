<?php

namespace App\Services\Localization;

use Illuminate\Support\ServiceProvider;
use App\Services\Localization\Localization;

/**
 * Class LocalizationServiceProvider
 * @package App\Services\Localization
 */
class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc }
     */
    public function register()
    {
        $this->app->bind("Localization", Localization::class);
    }
}
