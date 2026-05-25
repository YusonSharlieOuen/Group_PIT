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

        $allowed = $roles ? array_map('strtolower', array_map('trim', explode(',', $roles))) : [];

        $userType = strtolower($user->user_type ?? '');

        $staffPosition = $user->staff ? strtolower($user->staff->position) : null;

        // check BOTH systems
        if (!empty($allowed)) {

            if (
                in_array($userType, $allowed, true) ||
                in_array($staffPosition, $allowed, true)
            ) {
                return $next($request);
            }

            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
