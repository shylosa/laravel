<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
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
    public function index(): Factory|View
    {
        $projects = Project::translatedIn(app()->getLocale())->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.index', ['projects' => $projects, 'mainPageFlag' => 'main-page']);
    }

    /**
     * Display one selected project
     *
     * @param string $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(string $slug): Factory|View|RedirectResponse|Application
    {
        $locale = app()->getLocale();
        $project = Project::whereTranslation('slug', $slug)->firstOrFail();

        if ($project->translate()->where('slug', $slug)->first()->locale !== $locale) {
            return redirect()->route('projects.show_project', $project->translate($locale)->slug);
        }

        return view('pages.show', ['project' => $project]);
    }

    /**
     * Filtration projects by tags
     *
     * @param string $slug
     * @return Factory|View
     */
    public function tags(string $slug): Factory|View
    {
        $tag = Tag::whereTranslation('slug', $slug)->firstOrFail();
        $projects = $tag->projects()->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.list', ['projects' => $projects]);
    }

    /**
     * Filtration projects by categories
     *
     * @param string $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function categories(string $slug): Factory|View|RedirectResponse|Application
    {
        $category = Category::whereTranslation('slug', $slug)->firstOrFail();
        $projects = $category->projects()->paginate(self::PROJECTS_ON_PAGE);

        return view('pages.list', ['projects' => $projects]);
    }
}
