<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Banner::whereDate('promo_berakhir', '>=', date('Y-m-d'))->update([
            'status' => 'Aktif'
        ]);
        Banner::whereDate('promo_berakhir', '<', date('Y-m-d'))->update([
            'status' => 'Tidak Aktif'
        ]);
        $slider = Banner::where('status_banner', 'Slider Utama')->get();
        $tambahan = Banner::where('status_banner', 'Promo Tambahan')->get();
        
        return view('ecommerce.admin.banner.index', ['slider' => $slider, 'tambahan' => $tambahan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $status = $request->get('status');
        if ($status == 'Slider Utama') {
            return view('ecommerce.admin.banner.slider_utama.create');
        } else {
            return view('ecommerce.admin.banner.promo_tambahan.create');
        }
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
            'promo_mulai' => 'required|date_format:"Y-m-d"',
            'promo_berakhir' => 'required|date_format:"Y-m-d"',
            'file' => 'required',
            'syarat' => 'required',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $file = $request->file('file');
            $banner = new Banner();
            $banner->nama = $request->get('nama_promo');
            $banner->status = "Aktif";
            $banner->status_banner = $request->get('status_banner');
            $banner->promo_mulai = $request->get('promo_mulai');
            $banner->promo_berakhir = $request->get('promo_berakhir');
            $banner->syarat = $request->get('syarat');
            $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/banner/', $imageName);
            $banner->gambar = $imageName;
            $banner->save();
            $request->session()->flash('success', 'Promo tambahan berhasil disimpan!');
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
        $banner = Banner::findOrFail($id);
        if ($banner->status_banner == 'Slider Utama') {
            return view('ecommerce.admin.banner.slider_utama.show', ['banner' => $banner]);
        } else {
            return view('ecommerce.admin.banner.promo_tambahan.show', ['banner' => $banner]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->status_banner == 'Slider Utama') {
            return view('ecommerce.admin.banner.slider_utama.edit', ['banner' => $banner]);
        } else {
            return view('ecommerce.admin.banner.promo_tambahan.edit', ['banner' => $banner]);
        }
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
        $validator = Validator::make($request->all(), [
            'nama_promo' => 'required',
            'promo_mulai' => 'required|date_format:"Y-m-d"',
            'promo_berakhir' => 'required|date_format:"Y-m-d"',
            'syarat' => 'required',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $file = $request->file('file');
            $id = $request->get('id');
            $banner = Banner::findOrFail($id);
            $banner->nama = $request->get('nama_promo');
            $banner->status = "Aktif";
            $banner->promo_mulai = $request->get('promo_mulai');
            $banner->promo_berakhir = $request->get('promo_berakhir');
            $banner->syarat = $request->get('syarat');
            $path =  public_path('uploads/images/banner/' . $banner->gambar);
            if ($request->has('file')) {
                if(is_file($path) && @unlink($path)){
                    unlink(public_path('uploads/images/banner/' . $banner->gambar));
                }
                $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/images/banner/', $imageName);
                $banner->gambar = $imageName;
            }

            $banner->save();
            $request->session()->flash('success', 'Promo tambahan berhasil diupdate!');
            return response()->json([
                'status' => true,
                'message' => 'saved'
            ]);
        }
    }
}
