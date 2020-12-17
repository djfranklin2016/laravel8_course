<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component('components.card', 'card');
        Blade::component('components.tags', 'tags');

        // view()->composer('*', ActivityComposer::class);  // to make data from ActivityComposer available to EVERY VIEW

        // view()->composer('posts.index', ActivityComposer::class);    // make data from ActivityComposer available to 'posts.index'

        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);   // use an array for more than one view

    }
}
