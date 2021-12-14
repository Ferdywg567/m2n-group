<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        if (!empty($user->foto)) {
            $user->foto = asset('uploads/images/user/' . $user->foto);
        } else {
            $user->foto = asset('assets/img/avatar/avatar-3.png');
        }
        return response()->json([
            'status' => true,
            'data' => $user,
            'code' => Response::HTTP_OK
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::guard('api')->user();
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|file|mimes:png,jpg,jpeg',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'nomor_telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            DB::beginTransaction();
            try {
                $user = User::findOrFail($user->id);
                $user->name = $request->get('nama_lengkap');
                $user->jenis_kelamin = $request->get('jenis_kelamin');
                $user->tanggal_lahir = date('Y-m-d', strtotime($request->get('tanggal_lahir')));
                $user->email = $request->get('email');
                $user->no_hp = $request->get('nomor_telepon');

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    if (!empty($user->foto)) {
                        unlink(public_path() . '/uploads/images/user/' . $user->foto);
                    }
                    $file->move(public_path() . '/uploads/images/user/', $imageName);
                    $user->foto = $imageName;
                }
                $user->save();
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Profil berhasil di update',
                    'code' => Response::HTTP_OK
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_password(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user->password == 0) {
            $validator = Validator::make($request->all(), [
                'password_baru' => 'min:8|required_with:ulangi_password_baru|same:ulangi_password_baru',
                'ulangi_password_baru' => 'min:8'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'password_lama' => 'required',
                'password_baru' => 'min:8|required_with:ulangi_password_baru|same:ulangi_password_baru',
                'ulangi_password_baru' => 'min:8'
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {

            DB::beginTransaction();
            try {
                $user = User::findOrFail($user->id);
                $password_lama = $request->get('password_lama');
                if ($user->password == 0) {
                    $user->password = bcrypt($request->get('password_baru'));
                    $user->save();
                    $message =  'password berhasil di update';
                    $status = true;
                } else {
                    if (Hash::check($password_lama, $user->password)) {
                        $user->password = bcrypt($request->get('password_baru'));
                        $user->save();
                        $message =  'password berhasil di update';
                        $status = true;
                    } else {
                        $message = 'password lama salah';
                        $status = false;
                    }
                }

               
                DB::commit();
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'code' => Response::HTTP_OK
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]);
            }
        }
    }
}
