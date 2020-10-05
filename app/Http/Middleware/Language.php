<?php

namespace App\Http\Middleware;

use Arr;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Language
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the first segment is admin page
        if (mb_strtolower($request->segment(1)) === 'admin') {
            return $next($request);
        }

        // Remove default language prefix from url
        if (mb_strtolower($request->segment(1)) === config('app.fallback_locale')) {
            $segments = $request->segments();
            array_shift($segments);

            return redirect()->to(implode('/', $segments));
        }

        return $next($request);
    }
}