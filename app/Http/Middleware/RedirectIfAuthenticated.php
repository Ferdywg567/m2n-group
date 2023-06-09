<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if ($user->hasRole('production')) {
                return redirect()->route('dashboard.index');
            }elseif($user->hasRole('warehouse')){
                return redirect()->route('warehouse.dashboard.index');
            }elseif($user->hasRole('admin-online')){
                return redirect()->route('ecommerce.dashboard.index');
            }elseif($user->hasRole('admin-offline')){
                return redirect()->route('offline.transaksi.create');
            }
        }

        return $next($request);
    }
}
