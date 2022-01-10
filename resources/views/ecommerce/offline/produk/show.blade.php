@extends('ecommerce.offline.master')
@section('title', 'Produk')
@section('title-nav', 'Produk')
@section('produk', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>


    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i {
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0, 0, 0, .54);
        font-weight: 500;
        font-size: initial;

    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('offline.produk.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Produk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formProduk" method="post" action="#" enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_produk">Kode Produk</label>
                                            <input type="text" class="form-control" readonly required id="kode_produk"
                                                name="kode_produk" value="{{$produk->kode_produk}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_sku">Kode Sku</label>
                                            <input type="text" class="form-control" readonly required id="kode_sku"
                                                name="kode_sku"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->warna}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                name="kategori"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                name="sub_kategori"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori"
                                                value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" readonly required id="stok"
                                                name="stok" value="{{$produk->stok}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" class="form-control" readonly required id="ukuran"
                                                name="ukuran" value="{{$ukuran}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga">Harga / Seri</label>
                                            <input type="text" class="form-control" required readonly id="harga"
                                                name="harga" value="{{$produk->harga}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="promo">Promo Terpasang</label>
                                            <input type="text" class="form-control" required readonly id="promo"
                                                name="promo" readonly
                                                value="@if($produk->promo_id == null) Tidak ada promo @else {{$produk->promo->nama}} @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga_promo">Harga Setelah Promo</label>
                                            <input type="text" class="form-control" required readonly id="harga_promo"
                                                name="harga_promo" value="{{$produk->harga_promo}}">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file_gambar">File Gambar</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: -25px">
                                    @foreach ($produk->detail_gambar as $item)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body" style="position: relative; ">
                                                <img src="{{asset('uploads/images/produk/'.$item->filename)}}" alt=""
                                                    class="rounded" style="width: 100%; ">
                                            </div>
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 3 == 0)
                                </div>
                                <div class="row">
                                    @endif
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi_produk">Deskripsi Produk</label>
                                            <textarea class="form-control" id="deskripsi_produk" readonly
                                                name="deskripsi_produk"
                                                rows="3">{{$produk->deskripsi_produk}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('offline.produk.index')}}">Tutup</a>

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
