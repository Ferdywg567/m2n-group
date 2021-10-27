<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAuth
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
        if (auth()->check()) {
            if (auth()->user()->hasRole('ecommerce')) {
                return $next($request);
            } else {
                return redirect()->route('frontend.auth.login');
            }
        } else {
            return redirect()->route('frontend.auth.login');
        }
    }
}
