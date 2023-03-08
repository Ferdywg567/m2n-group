<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bahan extends Model
{
    use SoftDeletes;

    protected $fillable = ['kode_bahan', 'tanggal_masuk','sisa_bahan','no_surat','nama_bahan','jenis_bahan','warna'
    ,'vendor','status','kode_transaksi','sku','detail_sub_kategori_id','panjang_bahan_diambil','tanggal_keluar','panjang_bahan'];
    
    protected $dates = ['deleted_at'];
    
    public function potong()
    {
        return $this->hasOne(Potong::class)->withTrashed();
    }

    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class)->withTrashed();
    }

    public function sampah()
    {
        return $this->hasMany(Sampah::class)->withTrashed();
    }

    public function skus()
    {
        return $this->belongsTo(Sku::class,'sku_id','id')->withTrashed();
    }

    public function detail_sub()
    {
        return $this->belongsTo(DetailSubKategori::class,'detail_sub_kategori_id','id')->withTrashed();
    }
}
