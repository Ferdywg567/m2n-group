<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favorit;
use App\Produk;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser = auth()->user()->id;
        $favorit = Favorit::where('user_id', $iduser)->get();

        $produk = Produk::whereHas('favorit', function ($q) use ($iduser) {
            return $q->where('user_id', $iduser);
        })->get();

        return view('ecommerce.frontend.favorit.index', ['produk' => $produk]);
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
        if ($request->ajax()) {
            $iduser = auth()->user()->id;
            $id = $request->get('id');
            if ($request->get('status') == 'remove') {
                Favorit::where('user_id', $iduser)->where('produk_id', $id)->delete();
            } else {
                $cek = Favorit::where('user_id', $iduser)->where('produk_id', $id)->first();
                if (!$cek) {
                    $favorit = new Favorit();
                    $favorit->user_id = $iduser;
                    $favorit->produk_id = $id;
                    $favorit->save();
                }
            }

            return response()->json([
                'status' => true
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
