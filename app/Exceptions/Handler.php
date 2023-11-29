<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseHttpFondation;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response. If the request wants JSON (AJAX), return JSON, otherwise return HTML.
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|ResponseHttpFondation
    {

        // check if the prefix is api and is CSRF token mismatch
        if (str_starts_with($request->getUri(), config('app.url') . '/api')&& $e instanceof \Illuminate\Session\TokenMismatchException) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => [
                    'token' => 'CSRF token mismatch'
                ]
            ], 419);
        }

        return parent::render($request, $e);
    }
}
