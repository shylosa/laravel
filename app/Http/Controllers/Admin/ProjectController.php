<?php

namespace App\Http\Controllers\Admin;

use App\AppModel;
use App\Project;
use App\Tag;
use App\Category;
use Astrotomic\Translatable\Locales;
use Eloquent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class ProjectsController
 * @package App\Http\Controllers\Admin
 * @mixin Eloquent
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $projects = Project::paginate(Controller::PER_PAGE);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::getAllCategoriesList();
        $tags = Tag::getAllTagsList();

        return view('admin.projects.create', compact('categories', 'tags'));
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
            '*_title' => 'required|string',
            '*_description' => 'sometimes|string|nullable',
            'customer_name' => 'sometimes|string|nullable',
            'address' => 'sometimes|string|nullable',
            'status' => 'sometimes|accepted',
            'is_popular' => 'sometimes|accepted',
            'date' =>'required|date_format:Y-m-d',
            'photos.*' => 'nullable|image|max:8000'
        ]);

        $model = Project::add($validated);
        foreach (AppModel::getLocales() as $locale) {
            $model->translateOrNew($locale)->title = $validated[$locale . '_title'];

            if (in_array($locale . '_customer_name', $validated, true) && $validated[$locale . '_customer_name']) {
                $model->translateOrNew($locale)->customer_name = $validated[$locale . '_customer_name'];
            }

            if (in_array($locale . '_address', $validated, true) && $validated[$locale . '_address']) {
                $model->translateOrNew($locale)->address = $validated[$locale . '_address'];
            }

            if (in_array($locale . '_description', $validated, true) && $validated[$locale . '_description']) {
                $model->translateOrNew($locale)->description = $validated[$locale . '_description'];
            }
        }
        $model->save();


        $model->setPhotos($request->get('photos'), $request->get('old_photos'));
        $model->setTags($request->get('tags'));
        $model->toggleStatus($request->get('status'));
        $model->togglePopular($request->get('is_popular'));

        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $project = Project::find($id);
        $categories = Category::getAllCategoriesList();
        $tags = Tag::getAllTagsList();
        $selectedTags = $project->tags->pluck('id')->all();
        //$photos = $project->photos->pluck('id')->all();
        $photos = $project->getAdditionalPhotos();

        return view('admin.projects.edit', compact('categories', 'tags', 'project', 'selectedTags', 'photos'));
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
            '*_title' => 'required|string',
            '*_description' => 'sometimes|string|nullable',
            'customer_name' => 'sometimes|string|nullable',
            'address' => 'sometimes|string|nullable',
            'status' => 'sometimes|accepted',
            'is_popular' => 'sometimes|accepted',
            'date' =>'required|date_format:Y-m-d',
            'photos.*' => 'nullable|image|max:8000',
            'old_photos.*' => 'sometimes|integer|exists:photos,id',
        ]);

        $projects = Project::find($id);
        $projects->edit($validated);

        if (isset($validated['photos'])) {
            $projects->setPhotos($validated);
        }
        $projects->setCategory($request->get('category_id'));
        $projects->setTags($request->get('tags'));
        $projects->toggleStatus($request->get('status'));
        $projects->togglePopular($request->get('is_popular'));

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        //Удаление записей о тегах из промежуточной таблицы
        Project::find($id)->tags()->detach();
        //Удаление записи
        Project::find($id)->remove();
        return redirect()->route('projects.index');
    }
}
