<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class PhotoController
 *
 * @package App\Http\Controllers\Admin
 */
class PhotoController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function photosUpload(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.photos.photo');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function photosStore(Request $request): void
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:8000'
        ]);
    }
}
