<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Tag;
use App\Category;
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
        $projects = Project::all();
        return view('admin.projects.index', ['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.projects.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required',
            'date' =>'required|date_format:Y-m-d',
            'main_image' => 'nullable|image|max:8000'
        ]);

        $project = Project::add($request->all());

        $project->uploadImage($request->file('main_image'));
        $project->setCategory($request->get('category_id'));
        $project->setTags($request->get('tags'));
        $project->toggleStatus($request->get('status'));
        $project->togglePopular($request->get('is_popular'));

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
