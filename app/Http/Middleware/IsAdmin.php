<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 1) {
            return $next($request);
        }
        App::abort(404);
    }
}
