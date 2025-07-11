<?php

namespace Clean\Theme\Providers;

use Illuminate\Support\ServiceProvider;

class CleanThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'clean-theme');
        
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        $this->publishes([
            __DIR__ . '/../../publishable/assets/css' => public_path('themes/clean/css'),
            __DIR__ . '/../../publishable/assets/js' => public_path('themes/clean/js'),
            __DIR__ . '/../../publishable/assets/images' => public_path('themes/clean/images'),
        ], 'clean-theme-assets');
        
        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('views/clean-theme'),
        ], 'clean-theme-views');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

    /**
     * Register theme services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->bind(
            \Clean\Theme\Services\ThemeService::class,
            function ($app) {
                return new \Clean\Theme\Services\ThemeService();
            }
        );
    }
}