@extends('backend.master')

@section('title', 'Pembayaran')
@section('title-nav', 'Pembayaran')
@section('pembayaran', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: 10px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('pembayaran.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Pembayaran Jahit</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="#" method="POST" id="formPembayaran">
                            <div class="card-body">
                                @include('backend.include.alert')

                                <input type="hidden" name="status" value="cuci">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control"
                                                value="{{$cuci->jahit->potong->bahan->kode_transaksi}}" required
                                                id="kode_transaksi" readonly name="kode_transaksi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$cuci->no_surat}}"
                                                required id="no_surat" readonly name="no_surat">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                value="{{$cuci->jahit->potong->bahan->nama_bahan}}" name="nama_produk">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{$cuci->jahit->potong->bahan->sku}}" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$cuci->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{$cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                value="{{old('detail_sub_kategori')}}" id="detail_sub_kategori"
                                                name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly id="nama_vendor"
                                                name="nama_vendor" value="{{$cuci->nama_vendor}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly id="harga_vendor"
                                                        value="@rupiah($cuci->harga_vendor)" name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                        id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dijahit">Jumlah Bahan Yang Dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" required
                                                    value="{{$cuci->kain_siap_cuci}}" id="jumlah_bahan_yang_dijahit"
                                                    readonly name="jumlah_bahan_yang_dijahit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                value="{{$cuci->konversi}}" name="konversi">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_harga">Total Harga</label>
                                            <input type="text" class="form-control" required readonly id="total_harga"
                                                value="@rupiah($cuci->total_harga)"
                                                name="total_harga">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @php
                                $cek = false;
                                $status = '';
                                @endphp
                                @foreach ($cuci->pembayaran_cuci as $item)
                                @if ($item->status=='Lunas')
                                <div class="row" id="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required readonly id="tanggal"
                                                value="{{date('Y-m-d',strtotime($item->created_at))}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran1">Pembayaran</label>
                                            <input type="text" class="form-control" value="{{$item->status}}" readonly
                                                id="pembayaran1" name="pembayaran1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal1">Nominal</label>
                                            <input type="text" min="1" class="form-control" required id="nominal1"
                                                readonly value="@rupiah($item->nominal)" name="nominal1">
                                        </div>
                                    </div>
                                </div>
                                @elseif($item->status == 'Termin 1')
                                @php
                                $status = 'Termin 1';
                                $cek = true;
                                @endphp
                                <div class="row" id="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required readonly id="tanggal"
                                                value="{{date('Y-m-d',strtotime($item->created_at))}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran1">Pembayaran</label>
                                            <input type="text" class="form-control" value="{{$item->status}}" readonly
                                                id="pembayaran1" name="pembayaran1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal1">Nominal</label>
                                            <input type="text" min="1" class="form-control" required id="nominal1"
                                                readonly value="@rupiah($item->nominal)" name="nominal1">
                                        </div>
                                    </div>
                                </div>

                                @elseif($item->status == 'Termin 2')
                                @php
                                $status = 'Termin 2';
                                $cek = true;
                                @endphp
                                <div class="row" id="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required readonly id="tanggal"
                                                value="{{date('Y-m-d',strtotime($item->created_at))}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran2">Pembayaran</label>
                                            <input type="text" class="form-control" value="{{$item->status}}" readonly
                                                id="pembayaran2" name="pembayaran2">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal2">Nominal</label>
                                            <input type="text" min="1" class="form-control" required id="nominal2"
                                                readonly value="@rupiah($item->nominal)" name="nominal2">
                                        </div>
                                    </div>
                                </div>

                                @elseif($item->status == 'Termin 3')

                                <div class="row" id="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required readonly id="tanggal"
                                                value="{{date('Y-m-d',strtotime($item->created_at))}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran3">Pembayaran</label>
                                            <input type="text" class="form-control" value="{{$item->status}}" readonly
                                                id="pembayaran3" name="pembayaran3">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal3">Nominal</label>
                                            <input type="text" min="1" class="form-control" required id="nominal3"
                                                readonly value="@rupiah($item->nominal)" name="nominal3">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sisa_bayar">Sisa Bayar</label>
                                            <input type="text" class="form-control" readonly required id="sisa_bayar"
                                                value="@rupiah($cuci->sisa_bayar)" name="sisa_bayar">
                                        </div>
                                    </div>


                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('pembayaran.index')}}">Tutup</a>



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
