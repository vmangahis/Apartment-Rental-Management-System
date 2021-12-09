<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LandlordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct()
    {

    }

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
