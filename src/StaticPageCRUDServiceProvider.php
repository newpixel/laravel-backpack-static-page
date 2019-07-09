<?php

namespace Newpixel\StaticPageCRUD;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class StaticPageCRUDServiceProvider extends ServiceProvider
{
    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/backpack/staticpage.php';

    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-backpack-static-page');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-backpack-static-page');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__.'/../config/config.php' => config_path('laravel-backpack-static-page.php'),
            // ], 'config');

            // Publishing the migrations.
            $this->publishes([
                __DIR__.'/database/migrations/' => database_path('migrations'),
            ], 'migrations');

            // Publishing the seeds.
            $this->publishes([
                __DIR__.'/database/seeds/' => database_path('seeds'),
            ], 'seeds');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-backpack-static-page'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-backpack-static-page'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-backpack-static-page'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                \Newpixel\StaticPageCRUD\app\Console\Commands\AddSidebarStaticPageLinks::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'config');

        // Register its dependencies
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);

        // Setup the routes
        $this->setupRoutes($this->app->router);

        // Register the main class to use with the facade
        // $this->app->singleton('laravel-backpack-blog', function () {
            // return new BlogCRUD;
        // });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;
        // but if there's a file with the same name in routes/backpack, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }
        $this->loadRoutesFrom($routeFilePathInUse);
    }
}
