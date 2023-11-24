<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrSelfUser
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user id == id in request
        if (auth()->user()->id != $request->id && auth()->user()->is_admin == 0) {
            return response()
                ->json(['message' => 'Vous ne disposez pas des droits nécessaires pour effectuer cette action.'],
                    Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
