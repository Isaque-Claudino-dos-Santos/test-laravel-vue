<?php

use App\Constants\ErrorCodeEnum;
use App\Http\Middleware\OnlyAdminUserMiddleware;
use App\Http\Middleware\RedirectOnPermissionDeniedMiddleware;
use App\Http\Resources\ErrorResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'onlyAdmin' => OnlyAdminUserMiddleware::class,
            'redirectOnPermissionDenied' => RedirectOnPermissionDeniedMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $exception) {
            $error = ErrorResource::make([
                'title' => $exception->getMessage(),
                'statusCode' => Response::HTTP_UNAUTHORIZED,
                'errorCode' => ErrorCodeEnum::UNAUTHENTICATED
            ]);

            return response()->json($error, $error['statusCode']);
        });
    })->create();
