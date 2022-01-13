<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_telp' => 'required',
            'jenis_alamat' => 'required',
            'status_alamat' => 'required',
            'alamat_detail' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
        ]);

        if ($validator->fails()) {
            $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            //cari alamat
            $provinsi = $this->getKeyData(public_path().'/ecommerce/assets/alamat/data_provinsi.json', $request->get('provinsi'), 'province_id');
            $kota = $this->getKeyData(public_path().'/ecommerce/assets/alamat/kota.json', $request->get('kota'), 'id');
            $kecamatan = $this->getKeyData(public_path().'/ecommerce/assets/alamat/kecamatan.json', $request->get('kecamatan'), 'id');

            $alamat = new Alamat();
            $alamat->user_id = auth()->user()->id;
            $alamat->nama_penerima = $request->get('nama_penerima');
            $alamat->no_telp = $request->get('no_telp');
            $alamat->jenis_alamat = $request->get('jenis_alamat');
            $alamat->alamat_detail = $request->get('alamat_detail');
            $alamat->provinsi_id = $request->get('provinsi');
            $alamat->kota_id = $request->get('kota');
            $alamat->kecamatan_id = $request->get('kecamatan');
            $alamat->provinsi = $provinsi['province'];
            $alamat->kota = $kota['name'];
            $alamat->kecamatan = $kecamatan['name'];
            $alamat->kode_pos = $request->get('kode_pos');
            $alamat->status = $request->get('status_alamat');
            $alamat->save();

            //cek
            if ($alamat->status == 'Utama') {
                Alamat::where('status', 'Utama')->where('id', '!=', $alamat->id)->where('user_id', auth()->user()->id)->update([
                    'status' => 'Tidak Utama'
                ]);
            }
            $html = ' <div class="alert alert-success" role="alert"> Alamat berhasil disimpan </div>';
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            Alamat::where('user_id', auth()->user()->id)->where('id', $id)->delete();
            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function update_alamat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_telp' => 'required',
            'jenis_alamat' => 'required',
            'status_alamat' => 'required',
            'alamat_detail' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
        ]);

        if ($validator->fails()) {
            $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $provinsi = $this->getKeyData(public_path().'/ecommerce/assets/alamat/data_provinsi.json', $request->get('provinsi'), 'province_id');
            $kota = $this->getKeyData(public_path().'/ecommerce/assets/alamat/kota.json', $request->get('kota'), 'id');
            $kecamatan = $this->getKeyData(public_path().'/ecommerce/assets/alamat/kecamatan.json', $request->get('kecamatan'), 'id');

            $alamat = Alamat::findOrFail($request->get('id'));
            $alamat->nama_penerima = $request->get('nama_penerima');
            $alamat->no_telp = $request->get('no_telp');
            $alamat->jenis_alamat = $request->get('jenis_alamat');
            $alamat->alamat_detail = $request->get('alamat_detail');
            $alamat->provinsi_id = $request->get('provinsi');
            $alamat->kota_id = $request->get('kota');
            $alamat->kecamatan_id = $request->get('kecamatan');
            $alamat->provinsi = $provinsi['province'];
            $alamat->kota = $kota['name'];
            $alamat->kecamatan = $kecamatan['name'];
            $alamat->kode_pos = $request->get('kode_pos');
            $alamat->status = $request->get('status_alamat');
            $alamat->save();
            if ($alamat->status == 'Utama') {
                Alamat::where('status', 'Utama')->where('id', '!=', $alamat->id)->where('user_id', auth()->user()->id)->update([
                    'status' => 'Tidak Utama'
                ]);
            }
            $html = ' <div class="alert alert-success" role="alert"> Alamat berhasil diupdate </div>';
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
        }
    }


    public function getAlamat(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $alamat = Alamat::where('id', $id)->where('user_id', auth()->user()->id)->first();

            return response()->json([
                'status' => true,
                'data' => $alamat
            ]);
        }
    }

    public function getKeyData($path, $cari,$kolom)
    {
        $dataarr = $path;
        $dataarr = file_get_contents($dataarr);
        $dataarr = json_decode($dataarr,true);
        $key = array_search($cari, array_column($dataarr, $kolom));
        $res = $dataarr[$key];
        return $res;
    }
}
