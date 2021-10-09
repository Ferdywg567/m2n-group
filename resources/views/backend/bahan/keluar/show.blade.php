@extends('backend.master')

@section('title', 'Bahan')
@section('title-nav', 'Bahan')
@section('cssnav', 'cssnav')
@section('bahan', 'class=active-sidebar')

@section('content')
<style>
    .cssnav {
        margin-left: -20px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('bahan.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('bahan.cetak')}}" target="_blank" method="post">
                                <input type="hidden" name="id" id="idbahan" value="{{$bahan->id}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" value="{{$bahan->kode_transaksi}}"
                                                required readonly id="kode_transaksi_keluar" name="kode_transaksi">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>

                                            <div id="kdbahanreadonly">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" readonly
                                                        id="kode_bahanreadonly" value="{{$bahan->kode_bahan}}"
                                                        name="kode_bahanreadonly">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$bahan->no_surat}}"
                                                readonly required id="no_surat_keluar" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" value="{{$bahan->nama_bahan}}"
                                                required readonly id="nama_bahan_keluar" name="nama_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" value="{{$bahan->jenis_bahan}}"
                                                required readonly id="jenis_bahan_keluar" name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" value="{{$bahan->warna}}" required
                                                readonly id="warna_keluar" name="warna">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor">Vendor</label>
                                            <input type="text" class="form-control" value="{{$bahan->vendor}}" required
                                                readonly id="vendor_keluar" name="vendor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Bahan Masuk</label>
                                            <input type="date" class="form-control" value="{{$bahan->tanggal_masuk}}"
                                                required id="tanggal_masuk" name="tanggal_masuk" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">Tanggal Bahan Keluar</label>
                                            <input type="date" class="form-control" value="{{$bahan->tanggal_keluar}}"
                                                readonly required id="tanggal_keluar" name="tanggal_keluar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_bahan">Panjang Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"
                                                    value="{{$bahan->panjang_bahan}}" required readonly
                                                    id="panjang_bahan" name="panjang_bahan">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_bahan_diambil">Panjang Bahan Diambil</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="panjang_bahan_diambil" name="panjang_bahan_diambil" readonly
                                                    value="{{$bahan->panjang_bahan_diambil}}"
                                                    max="{{$bahan->panjang_bahan}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sisa_bahan">Sisa Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="sisa_bahan" name="sisa_bahan" value="{{$bahan->sisa_bahan}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control"
                                                value="{{$bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                required readonly id="kategori" name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control"
                                                value="{{$bahan->detail_sub->sub_kategori->nama_kategori}}" required
                                                readonly id="sub_kategori" name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control"
                                                value="{{$bahan->detail_sub->nama_kategori}}" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sku_bahan">SKU</label>
                                            <input type="text" class="form-control" readonly value="{{$bahan->sku}}"
                                                required id="sku_bahan" name="sku_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('bahan.index')}}">Tutup</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Cetak</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

@endsection
