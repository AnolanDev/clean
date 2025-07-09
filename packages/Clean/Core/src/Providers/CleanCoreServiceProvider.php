<?php

namespace Clean\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class CleanCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'clean-core');
        
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/clean/core'),
        ], 'clean-core-assets');
        
        $this->loadConfigFrom();
        
        // Register package routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php',
            'core'
        );
    }

    /**
     * Register repositories.
     *
     * @return void
     */
    protected function registerRepositories()
    {
        $this->app->bind(
            \Clean\Core\Repositories\CleanBrandRepository::class,
            function ($app) {
                return new \Clean\Core\Repositories\CleanBrandRepository(
                    $app->make(\Clean\Core\Models\CleanBrand::class)
                );
            }
        );

        $this->app->bind(
            \Clean\Core\Repositories\CleanCategoryRepository::class,
            function ($app) {
                return new \Clean\Core\Repositories\CleanCategoryRepository(
                    $app->make(\Clean\Core\Models\CleanCategory::class)
                );
            }
        );

        $this->app->bind(
            \Clean\Core\Repositories\CleanProductRepository::class,
            function ($app) {
                return new \Clean\Core\Repositories\CleanProductRepository(
                    $app->make(\Clean\Core\Models\CleanProduct::class)
                );
            }
        );

        $this->app->bind(
            \Clean\Core\Repositories\CleanIngredientRepository::class,
            function ($app) {
                return new \Clean\Core\Repositories\CleanIngredientRepository(
                    $app->make(\Clean\Core\Models\CleanIngredient::class)
                );
            }
        );
    }

    /**
     * Register package services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->bind(
            \Clean\Core\Services\CleanProductService::class,
            function ($app) {
                return new \Clean\Core\Services\CleanProductService(
                    $app->make(\Clean\Core\Repositories\CleanProductRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanBrandRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanCategoryRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanIngredientRepository::class)
                );
            }
        );
    }

    /**
     * Load configurations from config files.
     *
     * @return void
     */
    protected function loadConfigFrom()
    {
        //
    }
}