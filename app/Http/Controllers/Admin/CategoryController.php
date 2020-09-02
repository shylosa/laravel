<?php

namespace App\Http\Controllers\Admin;

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
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        //We leave only the categories that have translations
        foreach ($categories as $key => $category) {
            if (!$category->hasTranslation()) {
                unset($categories[$key]);
            }
        }

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store category and translations to database
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
     * Edit existing category and translations
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update existing category and translations
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

        $model = Category::find($id);
        if ($model) {
            $categoryData = [];
            foreach (app(Locales::class)->all() as $locale) {
                $categoryData[$locale] = [
                    'title' => $validated[$locale . '_title']
                ];
            }

            $model->update($categoryData);
        }

        return redirect()->route('categories.index');
    }

    /**
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
