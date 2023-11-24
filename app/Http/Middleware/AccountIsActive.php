<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountIsActive
{
    /**
     * Check if the user account is actif
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->status == 0) {

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json(['message' => 'Votre compte à été désactivé.'], 403);
        }
        return $next($request);
    }
}
