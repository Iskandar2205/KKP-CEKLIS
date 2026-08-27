<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))


    /*
    |--------------------------------------------------------------------------
    | Routing Configuration
    |--------------------------------------------------------------------------
    |
    | Menghubungkan file route Laravel.
    |
    */

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )



    /*
    |--------------------------------------------------------------------------
    | Middleware Configuration
    |--------------------------------------------------------------------------
    |
    | Register middleware custom.
    |
    | Security:
    | RoleMiddleware digunakan untuk membatasi akses:
    | admin
    | panelis
    | pimpinan
    |
    */

    ->withMiddleware(function (Middleware $middleware) {


        $middleware->alias([

            'role' => \App\Http\Middleware\RoleMiddleware::class,

        ]);


    })



    /*
    |--------------------------------------------------------------------------
    | Exception Handling
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions) {


    })



    ->create();