<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyCookieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( $request->cookie('company') ){
            return $next($request);
        }else{
            return redirect("company");
            return $next($request);
        }
    }
}
