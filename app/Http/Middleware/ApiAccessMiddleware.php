<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (env('API_ACCESS') !== $request->header('api-access')) {
            return response([
                'message' => 'Unauthorized',
            ], 403);

        }
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
