<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustProxies
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Trust all proxies
        $request->setTrustedProxies(
            [$request->getClientIp()],
            Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO
        );

        return $next($request);
    }
}
