<?php

namespace App\Services\Localization;

use Illuminate\Support\ServiceProvider;
use App\Services\Localization\Localization;

class LocalizationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("Localization", Localization::class);
    }
}
