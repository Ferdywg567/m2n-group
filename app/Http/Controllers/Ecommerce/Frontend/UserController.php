<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamat = Alamat::where('user_id', auth()->user()->id)->orderBy('status', 'DESC')->get();
        return view('ecommerce.frontend.user.index', ['alamat' => $alamat]);
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
        $id = $request->get('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'nomor_hp' => 'required',
        ]);

        if ($validator->fails()) {
            $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $user = User::findOrFail($id);
            $user->name = $request->get('nama');
            $user->tanggal_lahir = $request->get('tanggal_lahir');
            $user->jenis_kelamin = $request->get('jenis_kelamin');
            $user->email = $request->get('email');
            $user->no_hp = $request->get('nomor_hp');
            $user->save();
            $html = ' <div class="alert alert-success" role="alert"> Biodata berhasil di update </div>';
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
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

    public function UpdatePassword(Request $request)
    {
        if ($request->ajax()) {

            $id = auth()->user()->id;
            $user = User::findOrFail($id);

            if($user->password == 0){
                $validator = Validator::make($request->all(), [
                    'kata_sandi_baru' => 'min:6|required_with:ulangi_kata_sandi_baru|same:ulangi_kata_sandi_baru',
                    'ulangi_kata_sandi_baru' => 'min:6'
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'kata_sandi_sekarang' => 'required',
                    'kata_sandi_baru' => 'min:6|required_with:ulangi_kata_sandi_baru|same:ulangi_kata_sandi_baru',
                    'ulangi_kata_sandi_baru' => 'min:6'
                ]);
            }



            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {

                //check password
                $kata_sandi_sekarang = $request->get('kata_sandi_sekarang');
                if($user->password == 0){
                    $user->password = bcrypt($request->get('kata_sandi_baru'));
                    $user->save();
                    $html = ' <div class="alert alert-success" role="alert"> Kata sandi berhasil di update </div>';
                    $status = true;
                }else{
                    if (Hash::check($kata_sandi_sekarang, $user->password)) {
                        $user->password = bcrypt($request->get('kata_sandi_baru'));
                        $user->save();
                        $html = ' <div class="alert alert-success" role="alert"> Kata sandi berhasil di update </div>';
                        $status = true;
                    } else {
                        $html = ' <div class="alert alert-danger" role="alert"> Kata sandi sekarang salah </div>';
                        $status = false;
                    }
                }


                return response()->json([
                    'status' => $status,
                    'data' => $html
                ]);
            }
        }
    }

    public function UpdateFoto(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'file' => 'required',
            ]);

            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {
                $id = auth()->user()->id;
                $user = User::findOrFail($id);
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    if (!empty($user->foto)) {
                        unlink(public_path() . '/uploads/images/user/' . $user->foto);
                    }
                    $file->move(public_path() . '/uploads/images/user/', $imageName);
                    $user->foto = $imageName;
                    $user->save();
                    $html = ' <div class="alert alert-success" role="alert"> Foto berhasil di update </div>';
                    $status = true;
                } else {
                    $html = ' <div class="alert alert-danger" role="alert"> Maaf ada salah </div>';
                    $status = false;
                }

                return response()->json([
                    'status' => $status,
                    'data' => $html
                ]);
            }
        }
    }
}
