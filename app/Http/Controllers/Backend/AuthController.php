<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except(["login", "getLogin"]);
    }
    public function getLogin()
    {
        if (Auth::guard("web")->check()) {
            return redirect()->route('dashboard.index');
        } else {
            return view("auth.new_login");
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->back()->withErrors("wrong email or password");
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Session::flush();

        return redirect('/login')
            ->with('alert-info', 'Anda telah keluar, Sampai ketemu lagi!');
    }
}
