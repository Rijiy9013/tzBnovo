<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);

        $response = $next($request);

        $time = microtime(true) - $start;
        $memory = memory_get_usage() / 1024; // Память в КБ

        $response->headers->set('X-Debug-Time', $time);
        $response->headers->set('X-Debug-Memory', $memory);

        return $response;
    }
}
