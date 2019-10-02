<?php

namespace App\Providers;

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
//        if ($this->app->environment() !== 'production') {
//                $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//            }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin._sidebar', static function ($view){
            $view->with('count', \App\AppModel::sidebarCount());
        });
    }
}
