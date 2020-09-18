<?php

namespace App\Providers;

use App\AppModel;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request)
    {
        // Set the app locale according to the URL
        app()->setLocale($request->segment(1));
        view()->composer('admin._sidebar', static function ($view) {
            $view->with('count', AppModel::sidebarCount());
        });
    }
}
