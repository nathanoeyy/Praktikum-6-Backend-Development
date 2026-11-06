<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Shared\Contracts\ProductServiceInterface;
use Modules\Product\Services\ProductService;
use Modules\Products\Services\ProductService as ServicesProductService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductServiceInterface::class,
            ServicesProductService::class
        );
    }

    public function boot(): void
    {
        // Namespace View untuk modul Library
        View::addNamespace('Library', base_path('app/Modules/Library/Views'));

        // Load Migrations dari setiap Modul secara otomatis
        $this->loadMigrationsFrom(app_path('Modules/Catalog/Migrations'));
        $this->loadMigrationsFrom(app_path('Modules/Membership/Migrations'));
        $this->loadMigrationsFrom(app_path('Modules/Circulation/Migrations'));
    }
}