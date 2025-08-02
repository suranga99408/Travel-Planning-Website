<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
{
    if (! $request->user()->is_admin) {
        return redirect('/')->with('error', 'You are not authorized to access the admin panel.');
    }

    return $next($request);
}
}