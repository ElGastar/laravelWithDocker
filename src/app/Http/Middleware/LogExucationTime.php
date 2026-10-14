<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogExucationTime
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $startTime =microtime(true);

        $res= $next($request);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        Log::info("Execution time: {$executionTime} seconds");
        return $res;
    }
}
