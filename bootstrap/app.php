<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\checkcustomerMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'admin'])
                ->group(base_path('routes/admin.php'));
            Route::middleware(['web', 'seller'])
                ->group(base_path('routes/seller.php'));
        },

    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append([
        //     checkcustomer::class,
        // ]);
        $middleware->alias([
            'checkcustomer' => checkcustomerMiddleware::class,
            'admin' => AdminMiddleware::class,
            'seller' => SellerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
