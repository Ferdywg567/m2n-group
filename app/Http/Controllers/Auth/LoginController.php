<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function showLoginForm()
    {
        return view('auth.new_login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('backend.login')->with('alert-info', 'Anda telah keluar, Sampai ketemu lagi!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('production')) {
            return redirect()->route('dashboard.index');
        }elseif($user->hasRole('warehouse')){
            return redirect()->route('warehouse.dashboard.index');
        }elseif($user->hasRole('admin-online')){
            return redirect()->route('ecommerce.dashboard.index');
        }elseif($user->hasRole('admin-offline')){
            return redirect()->route('offline.transaksi.create');
        }else{
            Auth::logout();
          return redirect()->back()->withErrors(['Email atau password salah']);
        }
    }
}
