@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('rekapitulasi.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Rekapitulasi</h1>
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
                                            <input type="text" class="form-control" readonly value="{{$rekap->cuci->jahit->potong->bahan->kode_bahan}}" required id="kode_bahan"
                                                name="kode_bahan">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly value="{{$rekap->cuci->jahit->potong->bahan->sku}}" required id="sku_keluar"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan" value="{{$rekap->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan" value="{{$rekap->cuci->jahit->potong->bahan->nama_bahan}}"
                                                name="nama_bahan">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ukuran_baju">Ukuran Baju</label>
                                            <input type="text" class="form-control" readonly required id="ukuran_baju" value="{{$rekap->ukuran}}"
                                                name="ukuran_baju">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required value="{{$rekap->cuci->jahit->potong->bahan->warna}}"
                                                id="warna_baju_keluar" name="warna_baju">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Barang Masuk </label>
                                            <input type="date" class="form-control" readonly required id="tanggal_masuk" value="{{$rekap->tanggal_masuk}}"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_kirim">Tanggal Kirim Barang</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_kirim" value="{{$rekap->tanggal_kirim}}"
                                                name="tanggal_kirim">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="total_barang">Total Barang Siap QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required value="{{$rekap->total_barang}}"
                                                    id="total_barang" name="total_barang">
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
                                            href="{{route('rekapitulasi.index')}}">Close</a>


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
