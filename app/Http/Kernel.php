<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    protected $routeMiddleware = [
        
        // ✅ Your custom admin middleware
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    ];
}
