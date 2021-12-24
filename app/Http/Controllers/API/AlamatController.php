<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;
use Illuminate\Http\Response;


class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::guard('api')->user()->id;
        $alamat = Alamat::where('user_id', $userid)->get();

        return response()->json([
            'status' => true,
            'data' => $alamat,
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
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_telp' => 'required',
            'jenis_alamat' => 'required|in:Kantor,Rumah,Sekolah',
            'status_alamat' => 'required|in:Utama,Tidak Utama',
            'alamat_detail' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $userid = Auth::guard('api')->user()->id;
            DB::beginTransaction();
            try {
                $alamat = new Alamat();
                $alamat->user_id = $userid;
                $alamat->nama_penerima = $request->get('nama_penerima');
                $alamat->no_telp = $request->get('no_telp');
                $alamat->jenis_alamat = $request->get('jenis_alamat');
                $alamat->alamat_detail = $request->get('alamat_detail');
                $alamat->kota = $request->get('kota');
                $alamat->kecamatan = $request->get('kecamatan');
                $alamat->kode_pos = $request->get('kode_pos');
                $alamat->status = $request->get('status_alamat');
                $alamat->save();

                //cek
                if ($alamat->status == 'Utama') {
                    Alamat::where('status', 'Utama')->where('id', '!=', $alamat->id)->where('user_id', auth()->user()->id)->update([
                        'status' => 'Tidak Utama'
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'saved',
                    'code' => Response::HTTP_OK
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]);
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
    public function edit(Request $request, $id)
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
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_telp' => 'required',
            'jenis_alamat' => 'required|in:Kantor,Rumah,Sekolah',
            'status_alamat' => 'required|in:Utama,Tidak Utama',
            'alamat_detail' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            DB::beginTransaction();
            try {
                $alamat = Alamat::findOrFail($id);
                $alamat->nama_penerima = $request->get('nama_penerima');
                $alamat->no_telp = $request->get('no_telp');
                $alamat->jenis_alamat = $request->get('jenis_alamat');
                $alamat->alamat_detail = $request->get('alamat_detail');
                $alamat->kota = $request->get('kota');
                $alamat->kecamatan = $request->get('kecamatan');
                $alamat->kode_pos = $request->get('kode_pos');
                $alamat->status = $request->get('status_alamat');
                $alamat->save();

                if ($alamat->status == 'Utama') {
                    Alamat::where('status', 'Utama')->where('id', '!=', $alamat->id)->where('user_id', auth()->user()->id)->update([
                        'status' => 'Tidak Utama'
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'updated',
                    'code' => Response::HTTP_OK
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]);
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
        $userid = Auth::guard('api')->user()->id;
        DB::beginTransaction();
        try {
            $alamat = Alamat::where('user_id', $userid)->where('id', $id)->first();

            if ($alamat) {
                if ($alamat->status == 'Utama') {
                    $pesan = 'maaf, alamat utama tidak boleh dihapus';
                    $status = false;
                } else {
                    Alamat::where('user_id', $userid)->where('id', $id)->delete();
                    $pesan = 'deleted';
                    $status = true;
                }
            }

            DB::commit();
            return response()->json([
                'status' => $status,
                'message' => $pesan,
                'code' => Response::HTTP_OK
            ]);
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Maaf ada yang error',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
