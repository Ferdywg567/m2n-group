<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Banner::whereDate('promo_berakhir', '>=', date('Y-m-d'))->update([
            'status' => 'Aktif'
        ]);
        Banner::whereDate('promo_berakhir', '<', date('Y-m-d'))->update([
            'status' => 'Tidak Aktif'
        ]);

        if ($request->get('status') == 'Slider Utama') {
            $data = Banner::where('status_banner', 'Slider Utama')->get();
            $arr = [];
            foreach ($data as $key => $value) {
                $value->gambar = asset('uploads/images/banner/' . $value->gambar);
            }

            $status = 'Slider Utama';
        } else {
            $data = Banner::where('status_banner', 'Promo Tambahan')->first();
            if ($data) {
                $data->gambar = asset('uploads/images/banner/' . $data->gambar);
            } else {
                $data = null;
            }

            $status = 'Promo Tambahan';
        }

        return response()->json([
            'status' => true,
            'status_banner' => $status,
            'data' => $data,
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
