<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guard)
    {
        try {
            if ($guard != null) {
                if (Auth::guard('api')->check()) {
                    auth()->shouldUse("api");
                    return $next($request);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated.',
                        'code' => Response::HTTP_UNAUTHORIZED
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated.',
                    'code' => Response::HTTP_UNAUTHORIZED
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
