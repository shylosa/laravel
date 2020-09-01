<?php

namespace App\Http\Controllers\Admin;

use App\Category;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'	=> 'required',
            'title.*' => 'alpha'
        ]);

        $model = Category::add();
        $model->setTranslations($validated['title']);

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'title'	=> [
                'required',
                Rule::unique('categories')->ignore($id),
                ]
        ]);

        $category = Category::find($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
