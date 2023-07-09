<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() === null) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => 'error'
            ], 401);
        }
        if ((auth()->user()->phone_verified_at === null && auth()->user()->is_admin === 0) && (auth()->user()->email_verified_at === null && auth()->user()->is_admin === 0)) {
            return response()->json([
                'message' => 'User not verified',
                'status' => 'error'
            ], 401);
        }
        return $next($request);
    }
}
