<?php

namespace App\Http\Controllers\Admin;

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
        $categories = Category::with('translations')->get()->pluck('title', 'id')->all();
        $tags = Tag::with('translations')->get()->pluck('title', 'id')->all();

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
            'date' =>'required|date_format:Y-m-d'
        ]);

//        $this->validate($request, [
//            'title' =>'required',
//            'date' =>'required|date_format:Y-m-d',
//            'main_image' => 'nullable|image|max:8000'
//        ]);

        $model = Project::add($validated);

        foreach (app(Locales::class)->all() as $locale) {
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

        $model->uploadImage($request->file('main_image'));
        $model->setCategory($request->get('category_id'));
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
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $selectedTags = $project->tags->pluck('id')->all();

        return view(
            'admin.projects.edit',
            compact('categories', 'tags', 'project', 'selectedTags')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>'required',
            'date'  =>  'required|date_format:Y-m-d',
            'image' =>  'nullable|image|max:8000'
        ]);

        $projects = Project::find($id);
        $projects->edit($request->all());
        $projects->uploadImage($request->file('image'));
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
    public function destroy($id)
    {
        //Удаление записей о тегах из промежуточной таблицы
        Project::find($id)->tags()->detach();
        //Удаление записи
        Project::find($id)->remove();
        return redirect()->route('projects.index');
    }
}
