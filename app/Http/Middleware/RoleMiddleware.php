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

<<<<<<< HEAD
        // This app uses `user_type` to classify users.
        // Expected user_type values: 'staff' and 'renter'.
        // Admin/manager/supervisor should all map to 'staff' in user_type.
        $position = strtolower((string) ($user->user_type ?? ''));
=======
    if ($roles) {
        $allowed = array_map('trim', explode(',', $roles));
        $allowed = array_map('strtolower', $allowed);
    }
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4

    // CHECK user_type FIRST
    $userType = strtolower($user->user_type ?? '');

<<<<<<< HEAD

=======
    if (in_array($userType, $allowed, true)) {
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
        return $next($request);
    }

    // OPTIONAL fallback to staff position
    $position = null;

    if (method_exists($user, 'staff') && $user->staff) {
        $position = strtolower($user->staff->position);
    }

    if ($position && in_array($position, $allowed, true)) {
        return $next($request);
    }

    abort(Response::HTTP_FORBIDDEN, 'Unauthorized.');
}
}
