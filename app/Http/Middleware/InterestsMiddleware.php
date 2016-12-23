<?php

namespace App\Http\Middleware;

use Closure;

class InterestsMiddleware
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
        if (auth()->user()->interests()->count() < 1) {
            return redirect()->route('home.user.select-interests');
        }
        return $next($request);
    }
}
