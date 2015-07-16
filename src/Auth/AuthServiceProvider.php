<?php

namespace Sun\Auth;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Http/Route.php';
        }

        $this->publishes([
            __DIR__ . '/../../assets/css' => public_path('vendor/sun/auth/css'),
            __DIR__ . '/../../assets/fonts' => public_path('vendor/sun/auth/fonts'),
            __DIR__ . '/../../assets/images' => public_path('vendor/sun/auth/images'),
            __DIR__ . '/../../views' => base_path('resources/views/vendor/sun/auth')
        ]);

        $this->publishes([
            __DIR__ . '/../../config/SunAuth.php' => config_path('SunAuth.php')
        ], 'config');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $publishedViewPath = base_path('resources/views/vendor/sun/auth');

        if (file_exists($publishedViewPath)) {
            $this->loadViewsFrom($publishedViewPath, 'sun');
        } else {
            $this->loadViewsFrom(__DIR__ . '/../../views', 'sun');

        }

    }
}
