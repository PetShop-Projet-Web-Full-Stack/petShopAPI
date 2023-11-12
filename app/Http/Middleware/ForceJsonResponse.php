<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{

    /**
     * Handle an incoming request. Force the Accept header to application/json.
     *
     * @param Request $request The incoming request.
     * @param Closure $next The next middleware in the chain.
     *
     * @return Response The response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
