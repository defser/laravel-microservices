<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Http\Request;

class LogExecutionTime
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        Log::info(
            sprintf(
                '%s: %s %s %s finished in: %f ms',
                env('APP_NAME', 'Application'),
                $request->getMethod(),
                $request->getRequestUri(),
                $response->getStatusCode(),
                (microtime(true) - LARAVEL_START) * 1000
            )
        );
    }
}
