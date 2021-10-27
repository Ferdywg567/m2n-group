<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('ecommerce.frontend.auth.login');
    }
    public function getRegister()
    {
        return view('ecommerce.frontend.auth.register');
    }

    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $credentials = $request->only('email', 'password');
            // cek role
            $user = User::where('email', $request->get('email'))->first();
            if ($user->hasRole('ecommerce')) {
                if (Auth::attempt($credentials)) {
                    // Authentication passed...
                    return redirect('/');
                } else {
                    return redirect()->back()->withErrors(['Email atau password salah']);
                }
            } else {
                return redirect()->back()->withErrors(['Email atau password salah']);
            }
        }
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $user = new User();
            $user->name = $request->get('nama_lengkap');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->assignRole('ecommerce');
            $user->save();

            return redirect()->route('frontend.auth.login')->with('alert-success', 'Berhasil daftar, silahkan login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('frontend.auth.login')->with('alert-info', 'Anda telah keluar, Sampai ketemu lagi!');
    }
}
