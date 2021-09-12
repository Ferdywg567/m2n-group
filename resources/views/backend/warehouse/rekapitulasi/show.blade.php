@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.rekapitulasi.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Rekapitulasi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.rekapitulasi.cetak')}}" target="_blank" method="post">
                            @csrf

                            <input type="hidden" name="id" id="idbahan" value="{{$rekap->id}}">
                            <div class="card-body">

                                <input type="hidden" name="detail_id" id="detail_id" value="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control"
                                                value="{{$rekap->warehouse->finishing->cuci->jahit->potong->bahan->kode_bahan}}"
                                                readonly required id="kode_bahan" name="kode_bahan">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control"
                                                value="{{$rekap->warehouse->finishing->cuci->jahit->potong->bahan->sku}}"
                                                readonly required id="sku_keluar" name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                value="{{$rekap->warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                value="{{$rekap->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}"
                                                name="nama_bahan">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$rekap->warehouse->finishing->cuci->jahit->potong->bahan->warna}}"
                                                id="warna_baju_keluar" name="warna_baju">
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_direpair">Jumlah Diretur</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->jumlah_diretur}}" id="barang_direpair"
                                                    name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_direpair">Jumlah Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->jumlah_dibuang}}" id="barang_direpair"
                                                    name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label for="ukurandirepair" class="text-dark">Ukuran yang Diretur</label>
                                <div class="row">

                                    @forelse ($rekap->detail_rekap_warehouse as $item)
                                    @if ($item->status == 'diretur')
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandirepair[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" readonly required
                                                id="jumlahdirepair" name="jumlahdirepair[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>

                                    @endif

                                    @empty

                                    @endforelse

                                </div>
                                <label for="ukurandirepair" class="text-dark">Ukuran yang Dibuang</label>
                                <div class="row">

                                    @forelse ($rekap->detail_rekap_warehouse as $item)
                                    @if ($item->status == 'dibuang')
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandirepair[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" readonly required
                                                id="jumlahdirepair" name="jumlahdirepair[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>

                                    @endif

                                    @empty

                                    @endforelse

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.rekapitulasi.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Print</button>
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
