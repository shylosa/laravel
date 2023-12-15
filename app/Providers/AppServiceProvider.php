<?php

namespace App\Providers;

use App\Classes\Helpers\Sidebar;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     *
     * @return void
     */
    public function boot(Request $request): void
    {
        // Set the app locale according to the URL
        if (array_key_exists($request->segment(1), config('translatable.locales'))) {
            app()->setLocale($request->segment(1));
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }

        view()->composer('admin._sidebar', static function ($view) {
            $view->with('sidebar', Sidebar::getSidebar());
        });

        // Use Bootstrap styles for pagination blocks.
        Paginator::useBootstrap();
    }
}
