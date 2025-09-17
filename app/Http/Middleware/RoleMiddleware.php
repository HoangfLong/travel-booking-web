<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     $user = $request->user();
        
    //     if (!$user) {
    //         return $next($request);
    //     }

    //     if (!in_array($user->role, $roles)) {
    //         return abort(404);
    //     }

    //     return $next($request); 
    // }

    public function handle($request, Closure $next, $role)
    {
        if (!Auth::user()->roles->pluck('name')->contains($role)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return $next($request);
    }
}
