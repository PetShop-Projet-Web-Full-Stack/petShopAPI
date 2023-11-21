<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveUserScope
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user id == id in request
        if (auth()->user()->id != $request->id) {
            if (auth()->user()->is_admin == 0) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }
        return $next($request);
    }
}
