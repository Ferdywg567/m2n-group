<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $response = Http::withHeaders([
                'key' => config('app.key_rajaongkir')
            ])->accept('application/json')->get('https://pro.rajaongkir.com/api/province');

            // $response = $response->getBody();
            $data = $response->getBody()->getContents();
            $data = json_decode($data);
            if(isset($data['rajaongkir']['results'])){
                $data = $data['rajaongkir']['results'];

            }else{
                $data = [];
            }
            return response()->json([
            'status' => true,
            'data' => $data,
            'code' => Response::HTTP_OK
        ]);

        } catch (\Exception $th) {
            //throw $th;
        }


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
        $response = Http::withHeaders([
            'key' => config('app.key_rajaongkir')
        ])->accept('application/json')->get('https://pro.rajaongkir.com/api/province?id='.$id);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        return response()->json($data);
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
