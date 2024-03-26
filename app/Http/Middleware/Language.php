<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Language
 * @package App\Http\Middleware
 */
class Language
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Check if the first segment is admin page
        if (mb_strtolower($request->segment(1)) === 'admin') {
            return $next($request);
        }

        $prefix = $request->segment(1);
        $segments = $request->segments();
        $localeCookie = Cookie::get('lang');

        //Redirect to saved in cookie locale
        if (empty($prefix) && $localeCookie !== null && $this->isValidLocale($localeCookie)) {
            array_unshift($segments, $localeCookie);

            return redirect()->to(implode('/', $segments));
        }

        // Remove default language prefix from url
        if (mb_strtolower($prefix) === config('app.fallback_locale')) {
            array_shift($segments);

            return redirect()->to(implode('/', $segments));
        }

        //Set locale cookie or delete cookie for default locale
        if ($this->isValidLocale($prefix) || $prefix === '') {
            $cookie = \cookie('lang', $prefix, 60 * 24 * 30 * 3);
        } elseif ($prefix === 'lang') {
            $cookie = \cookie('lang', $prefix, -20);
        }

        return isset($cookie) ? ($next($request))->cookie($cookie) : $next($request);
    }

    /**
     * @param $locale
     * @return bool
     */
    protected function isValidLocale($locale): bool
    {
        return array_key_exists($locale, config('translatable.locales'));
    }
}
