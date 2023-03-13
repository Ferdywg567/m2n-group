<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $fillable = ['kode_bahan', 'tanggal_masuk','sisa_bahan','no_surat','nama_bahan','jenis_bahan','warna'
    ,'vendor','status','kode_transaksi','sku','detail_sub_kategori_id','panjang_bahan_diambil','tanggal_keluar','panjang_bahan'];
    public function potong()
    {
        return $this->hasOne('App\Potong');
    }

    public function perbaikan()
    {
        return $this->hasMany('App\Perbaikan');
    }

    public function sampah()
    {
        return $this->hasMany('App\Sampah');
    }

    public function skus()
    {
        return $this->belongsTo('App\Sku','sku_id','id');
    }

    public function detail_sub()
    {
        return $this->belongsTo('App\DetailSubKategori','detail_sub_kategori_id','id');
    }
}
