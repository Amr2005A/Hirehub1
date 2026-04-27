<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RequestLog;
use Illuminate\Support\Facades\Auth;


class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('health') || $request->is('debugbar/*')) {
        return $next($request);
        }

        // before
        $start = microtime(true);

       try {
    $response = $next($request);
    } catch (\Throwable $e) {
        RequestLog::create([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => 500,
            'duration' => 0,
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
        ]);

        throw $e;
    }

        // after
        $duration = microtime(true) - $start;

        RequestLog::create([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => $response->getStatusCode(),
            'duration' => $duration,
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
        ]);

        return $response;

    }
}
