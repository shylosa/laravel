<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppModel;
use App\Models\Tag;
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

/**
 * Class TagController
 * @package App\Http\Controllers\Admin
 */
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $tags = Tag::paginate(Controller::PER_PAGE);
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
    public function create(): Factory|View|Application
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            '*_title' => 'string'
        ]);

        $model = Tag::add();
        foreach (AppModel::getLocales() as $locale => $language) {
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
    public function edit(int $id): Factory|View|Application
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            '*_title' => 'string',
            Rule::unique('tags')->ignore($id),
        ]);

        $model = Tag::findOrFail($id);
        if ($model) {
            $tagData = [];
            foreach (AppModel::getLocales() as $locale => $language) {
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
    public function destroy(int $id): RedirectResponse
    {
        $model = Tag::findOrFail($id);

        if ($model) {
            $model->deleteTranslations();
            $model->delete();
        }

        return redirect()->route('tags.index');
    }
}
