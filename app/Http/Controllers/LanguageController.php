<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends Controller
{
    /**
     * @param Request $request
     * @param string $lang
     * @return RedirectResponse
     */
    public function switchLang(Request $request, string $lang)
    {
        // Store the URL on which the user was
        $previous_url = url()->previous();

        // Transform it into a correct request instance
        $previous_request = app('request')->create($previous_url);

        // Get Query Parameters if applicable
        $query = $previous_request->query();

        // Store the segments of the last request as an array
        $prefix = $previous_request->segment(1, '');
        $segments = $previous_request->segments();
        if (array_key_exists($prefix, config('translatable.locales'))) {
            array_shift($segments);
        }

        if (count($query)) {
            return redirect()->to($lang . '/' . implode('/', $segments) . '?' . http_build_query($query));
        }

        return redirect()->to($lang . '/' . implode('/', $segments));
    }
}
