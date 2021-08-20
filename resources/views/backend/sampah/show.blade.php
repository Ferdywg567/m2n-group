@extends('backend.master')

@section('title', 'Sampah')
@section('title-nav', 'Sampah')
@section('sampah', 'class=active-sidebar')

@section('content')
<style>
    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('sampah.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Sampah</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control" readonly required id="kode_bahan"
                                                name="kode_bahan" value="{{$sampah->bahan->kode_bahan}}">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$sampah->bahan->sku}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required
                                                id="no_surat_keluar" name="no_surat"
                                                value="{{$sampah->bahan->no_surat}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan" value="{{$sampah->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ukuran_baju">Ukuran Baju</label>
                                            <input type="text" class="form-control" readonly required id="ukuran_baju"
                                                name="ukuran_baju" value="{{$sampah->ukuran}}">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$sampah->bahan->warna}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="text-dark font-weight-bold">Asal Barang</label>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tailoring">Tailoring</label>
                                            <div class="input-group mb-2">
                                                <input type="hidden" name="jahit_dibuang_id"
                                                    value="{{$jahit['jahit_dibuang_id']}}">
                                                <input type="number" class="form-control" readonly
                                                    value="{{$jahit['jumlah']}}" required id="tailoring"
                                                    name="tailoring">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="washing">Washing</label>
                                            <div class="input-group mb-2">
                                                <input type="hidden" name="cuci_dibuang_id"
                                                    value="{{$cuci['cuci_dibuang_id']}}">
                                                <input type="number" class="form-control" readonly
                                                    value="{{$cuci['jumlah']}}" required id="washing" name="washing">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="total_barang">Total Barang Rusak</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="total_barang" name="total_barang" value="{{$sampah->total}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('sampah.index')}}">Close</a>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
