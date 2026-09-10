<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Will be handled by Filament's Authenticate middleware
            return $next($request);
        }

        $user = Auth::user();
        
        // Allow access if is_admin is true OR user has any assigned role
        $hasAccess = $user->is_admin || $user->roles()->exists();
        
        if (!$hasAccess) {
            abort(403, 'Access denied. You do not have permission to access this area.');
        }

        return $next($request);
    }
}
