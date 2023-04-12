<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::with(['sub_kategori' => function ($q) {
            $q->with('detail_sub');
        }])->get();

        foreach ($kategori as $key => $value) {
           $value->gambar = asset('uploads/images/kategori/'.$value->gambar);
        }
        return response()->json([
            'status' => true,
            'data' => $kategori,
            'code' => Response::HTTP_OK
        ]);
    }
}
