<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppModel;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Category;
use Astrotomic\Translatable\Locales;
use Eloquent;
use Exception;
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
     * @throws Exception
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
            'photos.0' => 'required|image|max:8000',
            'photos.*' => 'nullable|image|max:8000',
        ], [
            'photos.0.required' => 'Проект должен иметь главную фотографию',
            'ru_title.required' => 'Поле "Название-ru" обязательное',
            'ua_title.required' => 'Поле "Название-ua" обязательное',
            'en_title.required' => 'Поле "Название-en" обязательное',
        ]);

        $model = Project::add($validated);
        $model->saveTranslationsData($validated);

        $model->setPhotos($request->file('photos'), $request->get('old_photos'));
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
        $project = Project::findOrFail($id);
        $categories = Category::getAllCategoriesList();
        $tags = Tag::getAllTagsList();
        $selectedTags = $project->tags->pluck('id')->all();
        $photos = $project->getAdditionalPhotos();

        return view('admin.projects.edit', compact('categories', 'tags', 'project', 'selectedTags', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
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
        ], [
            'ru_title.required' => 'Поле "Название-ru" обязательное',
            'ua_title.required' => 'Поле "Название-ua" обязательное',
            'en_title.required' => 'Поле "Название-en" обязательное'
        ]);

        $model = Project::findOrFail($id);
        if ($model->photos->isEmpty()
            && empty($request->file('photos'))
            && empty($request->get('old_photos'))
        ) {
            throw ValidationException::withMessages(['photos[0]' => 'Проект должен иметь хотя бы одно фото']);
        }
        $model->edit($validated);
        $model->saveTranslationsData($validated);

        $model->setPhotos($request->file('photos'), $request->get('old_photos'));
        $model->setCategory($request->get('category_id'));
        $model->setTags($request->get('tags'));
        $model->toggleStatus($request->get('status'));
        $model->togglePopular($request->get('is_popular'));

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
        //Remove records from tags table
        Project::findOrFail($id)->tags()->detach();
        //Remove model
        Project::findOrFail($id)->remove();

        return redirect()->route('projects.index');
    }
}
