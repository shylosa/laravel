<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

/**
 * Class AdminMiddleware
 * @package App\Http\Middleware
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        abort(404);
    }
}
