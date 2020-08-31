<?php

namespace App;

use Illuminate\Support\Facades\Config;

if (! function_exists('adverts_path')) {
    function getLocales()
    {
        return Config::get('locales.supported');
    }
}
