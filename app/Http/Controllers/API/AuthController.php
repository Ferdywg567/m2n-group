<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        }
        $credentials = request(['email', 'password']);
        if (Auth::guard('api')->attempt($credentials)) {
            //check role
            $user = User::where('email', $request->get('email'))->first();
            if ($user->hasRole('ecommerce')) {
                $token = JWTAuth::fromUser($user);
                return $this->respondWithToken($token);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'email atau password salah',
                    'code' => Response::HTTP_UNAUTHORIZED
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'email atau password salah',
                'code' => Response::HTTP_UNAUTHORIZED
            ]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|same:konfirmasi_password',
            'konfirmasi_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $user = new User();
            $user->name = $request->get('nama_lengkap');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
            $user->assignRole('ecommerce');
            Auth::guard('api')->login($user);
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['status' => true, 'message' => 'Berhasil keluar', 'code' => Response::HTTP_OK]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'code' => Response::HTTP_OK
        ]);
    }
}
