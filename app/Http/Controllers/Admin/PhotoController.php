<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function photosUpload()
    {
        return view('admin.photos.photo');
    }

    public function photosStore(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:8000'
        ]);

    }
}
