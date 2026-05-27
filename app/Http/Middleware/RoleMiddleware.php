<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin,Manager')
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $roles
     */
    public function handle(Request $request, Closure $next, ?string $roles = null)
{
    $user = $request->user();

    if (! $user) {
        abort(403);
    }

    $allowed = [];

    if ($roles) {
        $allowed = array_map('strtolower', array_map('trim', explode(',', $roles)));
    }

    // ONE clean source of truth
    $position =
        strtolower(optional($user->staff)->position)
        ?: strtolower($user->user_type ?? '');

    if (! empty($allowed) && ! in_array($position, $allowed, true)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}
