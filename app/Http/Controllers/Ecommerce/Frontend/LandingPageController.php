<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(!auth()->user()->hasRole('ecommerce')){
                return redirect()->to('/garment/login');
            };
        }
        $limit = Produk::limit(4)->get();
        $banner = Banner::where('status_banner', 'Slider Utama')->where('status', 'Aktif')->get();
        $promo = Banner::where('status_banner', 'Promo Tambahan')->where('status', 'Aktif')->get();
        $rekomendasi = Produk::limit(20)->get();
        return view("ecommerce.frontend.index", ['promo' => $promo,'limit' => $limit, 'banner' => $banner, 'rekomendasi' => $rekomendasi]);
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
        //
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
