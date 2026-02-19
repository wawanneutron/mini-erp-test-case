<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Policy message (owner only)
        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'FORBIDDEN',
                    'message' => $e->getMessage() ?: 'Anda tidak memiliki izin melakukan aksi ini',
                ],
                403,
            );
        });

        $exceptions->render(function (ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'error' => 'VALIDATION_ERROR',
                'message' => 'Data tidak valid',
                'details' => $e->errors()
            ], 422);
        });
    })->create();
