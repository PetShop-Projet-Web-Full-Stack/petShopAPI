<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Check if user is logged and if user is admin
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        } elseif (!auth()->user()->is_admin) {
            auth()->logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Vous n\'avez pas les droits pour accéder à cette page']);
        }

        return $next($request);
    }
}
