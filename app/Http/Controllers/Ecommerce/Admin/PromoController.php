<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Promo;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = Promo::all();
        return view('ecommerce.admin.promo.index', ['promo' => $promo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ecommerce.admin.promo.create");
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
            'nama_promo' => 'required',
            'kode_promo' => 'required|unique:promos,kode',
            'potongan' => 'required',
            'promo_mulai' => 'required|date_format:"Y-m-d"',
            'promo_berakhir' => 'required|date_format:"Y-m-d"|after_or_equal:promo_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            DB::beginTransaction();
            try {
                $promo = new Promo();
                $promo->nama = $request->get('nama_promo');
                $promo->kode = $request->get('kode_promo');
                $promo->potongan = $request->get('potongan');
                $promo->promo_mulai = $request->get('promo_mulai');
                $promo->promo_berakhir = $request->get('promo_berakhir');
                $promo->save();

                DB::commit();

                return redirect()->route('ecommerce.promo.index')->with('success', 'promo berhasil disimpan');
            } catch (\Exception $th) {
                DB::rollBack();
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
        $promo = Promo::findOrFail($id);
        return view("ecommerce.admin.promo.edit", ['promo' => $promo]);
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
        $promo = Promo::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_promo' => 'required',
            'kode_promo' => 'required|unique:promos,kode,'.$promo->kode.',kode',
            'potongan' => 'required',
            'promo_mulai' => 'required|date_format:"Y-m-d"',
            'promo_berakhir' => 'required|date_format:"Y-m-d"|after_or_equal:promo_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            DB::beginTransaction();

            try {

                $promo = Promo::findOrFail($id);
                $promo->nama = $request->get('nama_promo');
                $promo->kode = $request->get('kode_promo');
                $promo->potongan = $request->get('potongan');
                $promo->promo_mulai = $request->get('promo_mulai');
                $promo->promo_berakhir = $request->get('promo_berakhir');
                $promo->save();

                DB::commit();

                return redirect()->route('ecommerce.promo.index')->with('success', 'promo berhasil diupdate');
            } catch (\Exception $th) {
                DB::rollBack();
                dd($th);
            }
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
