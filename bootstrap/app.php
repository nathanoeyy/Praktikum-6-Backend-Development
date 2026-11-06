<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

// Import Custom Exceptions Modul Library
use App\Modules\Library\Exceptions\BookNotAvailableException;
use App\Modules\Library\Exceptions\AuthorHasBooksException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Register Route Modul Library
            Route::middleware('web')
                ->group(base_path('app/Modules/Library/routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Mencegah auto-reporting / stack trace panjang di log untuk exception khusus ini
        $exceptions->dontReport([
            BookNotAvailableException::class,
            AuthorHasBooksException::class,
        ]);
    })->create();