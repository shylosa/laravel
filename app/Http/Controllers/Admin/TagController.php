<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Astrotomic\Translatable\Locales;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tags = Tag::all();
        //We leave only the tags that have translations
        foreach ($tags as $key => $tag) {
            if (!$tag->hasTranslation()) {
                unset($tag[$key]);
            }
        }

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            '*_title' => 'string'
        ]);

        $model = Tag::add();
        foreach (app(Locales::class)->all() as $locale) {
            $model->translateOrNew($locale)->title = $validated[$locale . '_title'];
        }
        $model->save();

        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            '*_title' => 'string',
            Rule::unique('tags')->ignore($id),
        ]);

        $model = Tag::find($id);
        if ($model) {
            $tagData = [];
            foreach (app(Locales::class)->all() as $locale) {
                $tagData[$locale] = [
                    'title' => $validated[$locale . '_title']
                ];
            }

            $model->update($tagData);
        }

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $model = Tag::find($id);

        if ($model) {
            $model->deleteTranslations();
            $model->delete();
        }

        return redirect()->route('tags.index');
    }
}
