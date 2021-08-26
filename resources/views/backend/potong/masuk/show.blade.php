@extends('backend.master')

@section('title', 'Potong')
@section('title-nav', 'Potong')
@section('potong', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('potong.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('potong.cetak')}}" target="_blank" method="post">
                                @csrf
                                <input type="hidden" name="id" id="idpotong" value="{{$potong->id}}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanmasuk">
                                                <input type="text" class="form-control"
                                                    value="{{$potong->bahan->kode_transaksi}}" readonly
                                                    id="kdbahanreadmasuk" name="kdbahanreadmasuk">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly value="{{$potong->no_surat}}"
                                                required id="no_surat" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_cutting">Tanggal Cutting</label>
                                            <input type="date" class="form-control" readonly value="{{$potong->tanggal_cutting}}"
                                                required id="tanggal_cutting" name="tanggal_cutting">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control" readonly value="{{$potong->tanggal_selesai}}"
                                                required id="tanggal_selesai" name="tanggal_selesai">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control"
                                                value="{{$potong->bahan->skus->jenis_bahan}}" readonly required
                                                id="jenis_kain" name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$potong->bahan->sku}}" required id="sku" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="panjang_kain">Panjang kain</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"
                                                    value="{{$potong->bahan->panjang_bahan}}" readonly required
                                                    id="panjang_kain" name="panjang_kain">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$potong->bahan->skus->nama_produk}}" required id="nama_produk"
                                                name="nama_produk">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$potong->bahan->skus->warna}}" required id="warna" name="warna">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                        href="{{route('potong.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i> Print</button>
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
