<?php 

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // memuat migrasi modul
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');

        // memuat route modul
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}