<?php

namespace Clean\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class CleanAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'clean-admin');
        
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/clean/admin'),
        ], 'clean-admin-assets');
        
        $this->registerMenuItems();
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
     * Register admin services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->bind(
            \Clean\Admin\Services\AdminService::class,
            function ($app) {
                return new \Clean\Admin\Services\AdminService(
                    $app->make(\Clean\Core\Repositories\CleanProductRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanBrandRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanCategoryRepository::class),
                    $app->make(\Clean\Core\Repositories\CleanIngredientRepository::class),
                    $app->make(\Clean\Core\Services\CleanProductService::class)
                );
            }
        );
    }

    /**
     * Register admin menu items.
     *
     * @return void
     */
    protected function registerMenuItems()
    {
        // This would integrate with Bagisto's admin menu system
        // For now, we'll use our own routes
    }
}