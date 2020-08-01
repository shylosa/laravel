<?php

namespace App\Http\Controllers;

use App\Project;
use App\Tag;
use App\Category;
use Eloquent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @mixin Eloquent
 */
class HomeController extends Controller
{
    /**
     * Quantity projects on page
     */
    protected const PROJECTS_ON_PAGE = 9;

    /**
     * Display main page
     *
     * @return Factory|View
     */
    public function index()
    {
        $projects = Project::paginate(self::PROJECTS_ON_PAGE);

        return view('pages.index')->with('projects', $projects);
    }

    /**
     * Display one selected project
     *
     * @param $slug
     * @return Factory|View
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('pages.show', compact('project'));
    }

    /**
     * Filtration projects by tags
     *
     * @param $slug
     * @return Factory|View
     */
    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $projects = $tag->projects()->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.list', ['projects'  =>  $projects]);
    }

    /**
     * Filtration projects by categories
     *
     * @param $slug
     * @return Factory|View
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $projects = $category->projects()->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.list', ['projects'  =>  $projects]);
    }
}