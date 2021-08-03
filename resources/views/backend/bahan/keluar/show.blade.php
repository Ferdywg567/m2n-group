@extends('backend.master')

@section('title', 'Bahan')

@section('bahan', 'class=active')

@section('content')

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
                            <form>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kode_bahan">Kode Bahan</label>

                                                    <div id="kdbahanreadonly">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" readonly
                                                                id="kode_bahanreadonly" value="{{$bahan->kode_bahan}}" name="kode_bahanreadonly">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sku">SKU</label>
                                                    <input type="text" class="form-control" readonly value="{{$bahan->sku}}" required id="sku"
                                                        name="sku">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$bahan->no_surat}}" required readonly
                                                id="no_surat_keluar" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" value="{{$bahan->nama_bahan}}" required readonly
                                                id="nama_bahan_keluar" name="nama_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" value="{{$bahan->jenis_bahan}}" required readonly
                                                id="jenis_bahan_keluar" name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" value="{{$bahan->warna}}" required readonly id="warna_keluar"
                                                name="warna">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="panjang_bahan">Panjang Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" value="{{$bahan->panjang_bahan}}" required readonly
                                                    id="panjang_bahan_keluar" name="panjang_bahan">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor">Vendor</label>
                                            <input type="text" class="form-control" value="{{$bahan->vendor}}" required readonly id="vendor_keluar"
                                                name="vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" value="{{$bahan->tanggal_keluar}}" readonly required id="tanggal_keluar"
                                                name="tanggal">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                        href="{{route('bahan.index')}}">Close</a>
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
