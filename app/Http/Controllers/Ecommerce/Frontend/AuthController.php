<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                auth()->login($user, true);
                return redirect()->route('landingpage.index');
            }else{
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);
                $create->assignRole('ecommerce');

                auth()->login($create, true);
                return redirect()->route('landingpage.index');
            }

        } catch (\Exception $e) {
            return redirect()->route('frontend.auth.login');
        }


    }
}
