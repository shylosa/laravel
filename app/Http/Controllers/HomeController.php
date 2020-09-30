<?php

namespace App\Http\Controllers;

use App\Project;
use App\Tag;
use App\Category;
use Eloquent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $projects = Project::translatedIn(app()->getLocale())->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.index', ['projects' => $projects]);
    }

    /**
     * Display one selected project
     *
     * @param string $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(string $slug)
    {
        $project = Project::whereTranslation('slug', $slug)->firstOrFail();

        if ($project->translate()->where('slug', $slug)->first()->locale !== app()->getLocale()) {
            return redirect()->route('pages.show', $project->translate()->slug);
        }

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

        return view('pages.list', ['projects' => $projects]);
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

        return view('pages.list', ['projects' => $projects]);
    }
}
