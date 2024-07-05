<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
       if (request()->is('api/*')) {
           $exceptions->renderable(function (\Illuminate\Database\QueryException $e) {
               return response()->json([
                   'message' => 'Not Found',
               ], 404);
           });
           $exceptions->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
               return response()->json([
                   'message' => $e->getMessage(),
               ], $e->getCode());
           });
           $exceptions->renderable(function (\Illuminate\Validation\ValidationException $e) {
               return response()->json([
                   'message' => $e->getMessage(),
                   'errors' => $e->errors(),
               ], 422);
           });
           $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e) {
               return response()->json([
                   'message' => $e->getMessage(),
               ], 401);
           });
           $exceptions->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e) {
               return response()->json([
                   'message' => 'You are not authorized to access this resource',
               ], 403);
           });
           $exceptions->renderable(function (NotFoundHttpException $e) {
               return response()->json([
                   'message' => 'Not Found',
               ], 403);
           });
        }
    })->create();
