<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;
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
        $alamat = Alamat::where('user_id',auth()->user()->id)->orderBy('status','DESC')->get();
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
}
