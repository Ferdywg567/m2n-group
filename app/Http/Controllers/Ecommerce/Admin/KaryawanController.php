<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $karyawan = User::role(['warehouse','production','admin-online','admin-offline'])->where('id','!=',auth()->user()->id)->get();
       return view('ecommerce.admin.karyawan.index',['karyawan' => $karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.admin.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'hak_akses' => 'required',
            'kata_sandi' => 'required|string|min:6||required_with:ulangi_kata_sandi|same:ulangi_kata_sandi',
            'ulangi_kata_sandi' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $user = new User();
            $user->name = $request->get('nama_lengkap');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('kata_sandi'));
            $user->save();
            $user->assignRole($request->get('hak_akses'));
            return redirect()->route('ecommerce.karyawan.index')->with('success', 'Data karyawan berhasil disimpan');
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
        $karyawan = User::findOrFail($id);
        return view('ecommerce.admin.karyawan.detail', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('ecommerce.admin.karyawan.edit',['karyawan' => $karyawan]);
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
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'hak_akses' => 'required',
            'kata_sandi' => 'nullable|string|min:6||required_with:ulangi_kata_sandi|same:ulangi_kata_sandi',
            'ulangi_kata_sandi' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $user = User::findOrFail($id);
            $user->name = $request->get('nama_lengkap');
            $user->email = $request->get('email');
            if($request->has('kata_sandi')){
                $user->password = bcrypt($request->get('kata_sandi'));
            }
            $user->save();
            $user->roles()->detach();
            $user->assignRole($request->get('hak_akses'));
            return redirect()->route('ecommerce.karyawan.index')->with('success', 'Data karyawan berhasil diupdate');
        }
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
