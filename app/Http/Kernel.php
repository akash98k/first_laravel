<?php

namespace App\Http\Kernel;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // ...existing code...
        ],

        'api' => [
            // ...existing code...
            \App\Http\Middleware\RequestResponseLogger::class,
        ],
    ];
    
    /**
     * The application's middleware aliases.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        // ...existing code...
        'log.api' => \App\Http\Middleware\RequestResponseLogger::class,
    ];
}
