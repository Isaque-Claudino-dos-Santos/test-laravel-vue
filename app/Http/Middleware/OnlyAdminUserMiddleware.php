<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->isAdmin()) {
            return $next($request);
        };


        throw new PermissionDeniedException();
    }
}
