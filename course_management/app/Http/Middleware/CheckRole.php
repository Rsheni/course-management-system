<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role->name; // 'admin', 'instructor', 'student'

        // If user role is not in the allowed roles, redirect or abort
        if (! in_array($userRole, $roles)) {
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}