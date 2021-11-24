<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::orderBy('created_at')->get();
        return view('ecommerce.admin.bank.index', ['bank' => $bank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.admin.bank.create');
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
            'nama_bank' => 'required|unique:banks,nama_bank',
            'nomor_rekening' => 'required|unique:banks,nomor_rekening',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $file = $request->file('file');
            $bank = new Bank();
            $bank->nama_bank = strtoupper($request->get('nama_bank'));
            $bank->nomor_rekening = $request->get('nomor_rekening');
            $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/bank/', $imageName);
            $bank->logo = $imageName;
            $bank->save();
            $request->session()->flash('success', 'Bank berhasil disimpan!');
            return response()->json([
                'status' => true,
                'message' => 'saved'
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
        $bank = Bank::findOrFail($id);
        return view('ecommerce.admin.bank.edit', ['bank' => $bank]);
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

    public function update_data(Request $request)
    {
        $id = $request->get('id');
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required|unique:banks,nama_bank,' . $id,
            'nomor_rekening' => 'required|unique:banks,nomor_rekening,' . $id,
            'file' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $bank = Bank::findOrFail($id);
            $bank->nama_bank = strtoupper($request->get('nama_bank'));
            $bank->nomor_rekening = $request->get('nomor_rekening');
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                unlink(public_path('uploads/images/bank/' . $bank->logo));
                $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/images/bank/', $imageName);
                $bank->logo = $imageName;
                $bank->save();
            }

            $request->session()->flash('success', 'Bank berhasil diupdate!');
            return response()->json([
                'status' => true,
                'message' => 'saved'
            ]);
        }
    }
}
