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
            <h1 class="ml-2">Detail Data | Masuk</h1>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control" readonly id="kode_bahan"
                                                name="kode_bahan" value="{{$bahan->kode_bahan}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required id="no_surat"
                                                name="no_surat" value="{{$bahan->no_surat}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan" value="{{$bahan->nama_bahan}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                name="jenis_bahan" value="{{$bahan->jenis_bahan}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly value="{{$bahan->warna}}"
                                                required id="warna" name="warna">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor">Vendor</label>
                                            <input type="text" class="form-control" readonly value="{{$bahan->vendor}}"
                                                required id="vendor" name="vendor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" readonly
                                                value="{{$bahan->tanggal_masuk}}" required id="tanggal_masuk"
                                                name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="panjang_bahan">Panjang Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"
                                                    value="{{$bahan->panjang_bahan}}" readonly required
                                                    id="panjang_bahan" name="panjang_bahan">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
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
