<?php

namespace App\Site\Providers;

use Illuminate\Routing\Router;
//use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class RouteServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Site\Http\Controllers';

    /**
     * Register bindings in the container.
     */
    public function register()
    {
    }
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //@todo ver cache
        if (!$this->app->routesAreCached()) {
            $this->registerRoutes($this->app['router']);
        }
        
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'site');
        parent::boot($router);
    }

    
    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function registerRoutes(Router $router)
    {
        $router->group(
            [
                'namespace' => $this->namespace,
            ],
            function ($router) {
                require app_path('Site/Http/routes.php');
                require app_path('Site/Http/routes_1.php');
            }
        );
    }
    
    
}
