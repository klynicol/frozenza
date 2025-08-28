<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roleCodes Multiple role codes passed as separate parameters
     */
    public function handle(Request $request, Closure $next, string ...$roleCodes): Response
    {        
        // Check if user is in any of the required groups (OR logic)
        $userHasRole = false;
        foreach ($roleCodes as $roleCode) {
            $userRole = $request->user()->roles()->where('code', $roleCode)->first();
            if ($userRole) {
                $userHasRole = true;
                break;
            }
        }
        
        if (!$userHasRole) {
            return response()->json([
                'message' => 'You do not have permission to access this resource.',
            ], 403);
        }

        return $next($request);
    }
}
