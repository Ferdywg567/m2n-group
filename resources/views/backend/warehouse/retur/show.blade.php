@extends('backend.master')

@section('title', 'Retur')
@section('title-nav', 'Retur')

@section('retur', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .left {
        text-align: left;
    }

    textarea {
        width: 300px;
        height: 150px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.retur.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Retur</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.retur.cetak')}}" target="_blank" method="post">
                            @csrf

                            <input type="hidden" name="id" id="idbahan" value="{{$retur->id}}">
                            <div class="card-body">
                                @include('backend.include.alert')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required
                                                id="kode_transaksi" name="kode_transaksi"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->kode_transaksi}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="text" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk" value="{{$retur->tanggal_masuk}}">
                                        </div>

                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan_keluar" name="jenis_bahan"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->jenis_bahan}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$retur->finishing->cuci->jahit->potong->bahan->sku}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$retur->finishing->cuci->jahit->potong->bahan->warna}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" readonly required id="jumlah_keluar"
                                                name="jumlah" value="{{$retur->total_barang}}">
                                        </div>

                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran</label>
                                <div class="row">

                                    @forelse ($retur->detail_retur as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandibuang[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlahdibuang"
                                                readonly name="jumlahdibuang[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 6 ==0)
                                </div>
                                <div class="row">
                                    @endif
                                    @empty

                                    @endforelse

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan</label>
                                            <textarea class="form-control" id="keterangan_dibuang" readonly
                                                name="keterangan_dibuang"
                                                rows="6">{{$retur->finishing->keterangan_diretur}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.retur.index')}}">Close</a>
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
