<?php

namespace App\Http\Middleware;

// First copy this file into your middleware directoy
use Closure;

class CheckRole {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        if (array_intersect(auth()->user()->roles(), $roles)) {
            return $next($request);
        }
        if ($request->ajax()) {
            return response([
                'error' => [
                    'code' => 'INSUFFICIENT_ROLE',
                    'description' => 'You are not authorized to access this  resource.'
                ]
                    ], 401);
        }
        return redirect()->back()->withError('You are not authorized to access this page.');
    }

    private function getRequiredRoleForRoute($route) {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : [];
    }

}
