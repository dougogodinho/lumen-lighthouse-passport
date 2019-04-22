<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->registerRoutes();
        $this->registerLighthouseRoutes();
    }

    public function boot()
    {
    }

    public function registerRoutes()
    {
        app()->router->group([
            'namespace' => 'App\Http\Controllers',
        ], function ($router) {

        });
    }

    public function registerLighthouseRoutes()
    {
        app()->router->group(config('lighthouse.route', []), function (): void {
            $routeName = config('lighthouse.route_name', 'graphql');
            $controller = config('lighthouse.controller');

            if (config('lighthouse.route_enable_get', false)) {
                app('router')->get($routeName, [
                    'as' => 'lighthouse.graphql',
                    'uses' => $controller,
                ]);
            }

            app('router')->post($routeName, [
                'as' => 'lighthouse.graphql',
                'uses' => $controller,
            ]);
        });
    }
}
