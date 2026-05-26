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
            abort(Response::HTTP_FORBIDDEN);
        }

        $allowed = [];
        if ($roles) {
            $allowed = array_map('trim', explode(',', $roles));
            $allowed = array_map('strtolower', $allowed);
        }

        // This app uses `user_type` to classify users.
        // Expected user_type values: 'staff' and 'renter'.
        // Admin/manager/supervisor should all map to 'staff' in user_type.
        $position = strtolower((string) ($user->user_type ?? ''));

        if (empty($allowed) || ! $position || ! in_array($position, $allowed, true)) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized.');
        }


        return $next($request);
    }
}
