<?php

namespace App\Http\Middleware;

use Closure;

class isDefaultPassword
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
        if ($request->user()->defaultPassword) {
            return redirect()->route('user.first');
        } else {
            return $next($request);
        }
    }
}
