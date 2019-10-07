<?php

namespace App\Http\Controllers;

use App\Project;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(2);

        return view('pages.index')->with('projects', $projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('pages.show', compact('project'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $projects = $tag->projects()->paginate(2);

        return view('pages.list', ['projects'  =>  $projects]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $projects = $category->projects()->paginate(2);

        return view('pages.list', ['projects'  =>  $projects]);
    }
}
