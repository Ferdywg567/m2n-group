@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav{
       margin-left:-25px;
    }
</style>
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.cetak')}}" target="_blank" method="post">
                            @csrf
                            <input type="hidden" name="id" id="idcuci" value="{{$cuci->id}}">
                            <div class="card-body">
                                @include('backend.include.alert')
                                <input type="hidden" name="status" value="cucian keluar">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <div id="">
                                                <input type="text" class="form-control"
                                                    value="{{$cuci->jahit->potong->bahan->kode_transaksi}}" readonly
                                                    id="kdbahanreadkeluar" name="kdbahanreadkeluar">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$cuci->no_surat}}"
                                                readonly required id="no_surat_keluar" name="no_surat">
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
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
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
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>


                                <div class="row" id="iddatavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" id="nama_vendor" readonly
                                                value="{{$cuci->nama_vendor}}" name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{$cuci->harga_vendor}}" id="harga_vendor"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="/ lusin" readonly class="form-control"
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bahan">Jumlah Bahan yang Dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$cuci->kain_siap_cuci}}" id="jumlah_bahan"
                                                    name="jumlah_bahan">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="berhasil_cuci">Jumlah Berhasil Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$cuci->berhasil_cuci}}" id="berhasil_cuci" max="{{$cuci->kain_siap_cuci}}"
                                                    name="berhasil_cuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gagal_cuci">Jumlah Gagal Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$cuci->gagal_cuci}}" id="gagal_cuci" name="gagal_cuci">
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
                                            <label for="barang_direpair">Jumlah Perbaikan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$cuci->barang_direpair}}" id="barang_direpair"
                                                    name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="ukurandirepair" class="text-dark">Ukuran yang Direpair</label>
                                <div class="row">

                                    @forelse ($cuci->cuci_direpair as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandirepair[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" readonly required id="jumlahdirepair"
                                                name="jumlahdirepair[]" value="{{$item->jumlah}}">
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
                                            <label for="keterangan_direpair">Keterangan Direpair</label>
                                            <textarea class="form-control" id="keterangan_direpair" readonly
                                                name="keterangan_direpair"
                                                rows="3">{{$cuci->keterangan_direpair}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="barang_dibuang">Jumlah Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" readonly required
                                                    value="{{$cuci->barang_dibuang}}" id="barang_dibuang"
                                                    name="barang_dibuang">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran yang Dibuang</label>
                                <div class="row">

                                    @forelse ($cuci->cuci_dibuang as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandibuang[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlahdibuang" readonly
                                                name="jumlahdibuang[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 6 ==0)
                                </div><div class="row">
                                    @endif
                                    @empty

                                    @endforelse

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Dibuang</label>
                                            <textarea class="form-control" id="keterangan_dibuang" readonly
                                                name="keterangan_dibuang"
                                                rows="6">{{$cuci->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Tutup</a>

                                            <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                                Cetak</button>

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
