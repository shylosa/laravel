<?php

namespace App\Http\Controllers\Admin;

use App\AppModel;
use App\Category;
use Astrotomic\Translatable\Validation\RuleFactory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use \Astrotomic\Translatable\Locales;

/**
 * Class CategoriesController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::paginate(Controller::PER_PAGE);
        //We leave only the categories that have translations
        foreach ($categories as $key => $category) {
            if (!$category->hasTranslation()) {
                unset($categories[$key]);
            }
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show create new category and translations form
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.categories.create');
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

        $model = Category::add();
        foreach (app(Locales::class)->all() as $locale) {
            $model->translateOrNew($locale)->title = $validated[$locale . '_title'];
        }
        $model->save();

        return redirect()->route('categories.index');
    }

    /**
     * Show edit existing category and translations form
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
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
            Rule::unique('categories')->ignore($id),
        ]);

        $model = Category::findOrFail($id);
        if ($model) {
            $categoryData = [];
            foreach (AppModel::getLocales() as $locale => $language) {
                $categoryData[$locale] = [
                    'title' => $validated[$locale . '_title']
                ];
            }
            $model->update($categoryData);
        }

        return redirect()->route('categories.index');
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
        $model = Category::find($id);
        if ($model) {
            $model->deleteTranslations();
            $model->delete();
        }

        return redirect()->route('categories.index');
    }
}
