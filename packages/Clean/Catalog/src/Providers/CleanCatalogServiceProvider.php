<?php

namespace Clean\Catalog\Providers;

use Illuminate\Support\ServiceProvider;

class CleanCatalogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'clean-catalog');
        
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/clean/catalog'),
        ], 'clean-catalog-assets');
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
     * Register catalog services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->bind(
            \Clean\Catalog\Services\CatalogService::class,
            function ($app) {
                return new \Clean\Catalog\Services\CatalogService(
                    $app->make(\Clean\Core\Repositories\CleanProductRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanBrandRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanCategoryRepository::class),
                    $app->make(\Clean\Core\Services\CleanProductService::class)
                );
            }
        );
    }
}