<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if( $request->cookie('company') && count( Auth::user()->ownsCompany( $request->cookie('company') ) ) > 0  ){
            return $next($request);
        }else{
            return redirect("company");
            return $next($request);
        }
    }
}
