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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}"
                                                required id="kode_bahan" name="kode_bahan">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{$retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                value="{{$retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                value="{{$retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}"
                                                name="nama_bahan">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna}}"
                                                id="warna_baju_keluar" name="warna_baju">
                                        </div>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_retur">Tanggal Barang Direturn</label>
                                            <div class="input-group mb-2">
                                                <input type="date" class="form-control" readonly required
                                                    value="{{$retur->finishing->tanggal_masuk}}" id="tanggal_retur"
                                                    name="tanggal_retur">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_barang">Total Barang Direturn</label>
                                            <div class="input-group mb-2">

                                                <input type="number" class="form-control" required id="total_barang"
                                                    value="{{$retur->total_barang}}" name="total_barang" readonly>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row" id="ukuran">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="idukuran">
                                    @forelse ($retur->detail_retur as $item)
                                    @if ($item->ukuran == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahs" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahm" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XL')

                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XXL')
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxxl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @endif
                                    @empty
                                    @endforelse
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_retur">Keterangan Retur</label>
                                            <textarea class="form-control" readonly id="keterangan_retur"
                                                name="keterangan_retur"
                                                rows="6">{{$retur->keterangan_diretur}}</textarea>
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
