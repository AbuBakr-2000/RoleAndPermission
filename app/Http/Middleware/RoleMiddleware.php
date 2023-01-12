<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next,$role)
    {
        if ($request->user()->userHasRole($role) !== true)
        {
            abort(403,'Sorry, You are not authorized');
        }
        return $next($request);
    }
}
