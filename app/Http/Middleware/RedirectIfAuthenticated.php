<?php

namespace App\Http\Middleware;

use App\Responses\UserResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $Response = new UserResponse($request->user()->toArray());

                return response()->json($Response->toArray(), Response::HTTP_OK);
            }
        }

        return $next($request);
    }
}
