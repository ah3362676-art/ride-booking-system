<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        abort(403);
    }

    $user = auth()->user();

    foreach ($roles as $role) {
        if (
            ($role === 'rider' && $user->isRider()) ||
            ($role === 'driver' && $user->isDriver()) ||
            ($role === 'admin' && $user->isAdmin())
        ) {
            return $next($request);
        }
    }

    abort(403);
}
}
