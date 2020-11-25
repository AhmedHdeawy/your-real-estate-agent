<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('front.search', 'App\Http\View\Composers\SearchComposer');

        View::composer('layouts.navbar', function ($view) {
            $navCategories = Cache::rememberForever('properties_categories', function () {
                return Category::all();
            });
            $view->with('navCategories', $navCategories);
        });
    }
}
