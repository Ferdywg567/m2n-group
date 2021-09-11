@extends('backend.master')

@section('title', 'Sampah')
@section('title-nav', 'Sampah')
@section('sampah', 'class=active-sidebar')

@section('content')
<style>
    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('sampah.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Sampah</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="post" target="_blank" action="{{route('sampah.cetak')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$sampah->id}}">
                            @if ($sampah->asal == 'cuci')
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required
                                                id="kode_transaksi" name="kode_transaksi"
                                                value="{{$sampah->cuci->jahit->potong->bahan->kode_transaksi}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$sampah->cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="text" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk" value="{{$sampah->tanggal_masuk}}">
                                        </div>

                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan_keluar" name="jenis_bahan"
                                                value="{{$sampah->cuci->jahit->potong->bahan->jenis_bahan}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$sampah->cuci->jahit->potong->bahan->warna}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$sampah->cuci->jahit->potong->bahan->sku}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$sampah->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$sampah->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$sampah->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal">Asal</label>
                                            <input type="text" class="form-control" readonly required id="asal_keluar"
                                                name="asal" value="{{$sampah->asal}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" readonly required id="jumlah_keluar"
                                                name="jumlah" value="{{$sampah->total}}">
                                        </div>

                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran</label>
                                <div class="row">

                                    @forelse ($sampah->cuci->cuci_dibuang as $item)
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
                                                rows="6">{{$sampah->cuci->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('sampah.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Print</button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required
                                                id="kode_transaksi" name="kode_transaksi"
                                                value="{{$sampah->jahit->potong->bahan->kode_transaksi}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$sampah->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="text" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk" value="{{$sampah->tanggal_masuk}}">
                                        </div>

                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan_keluar" name="jenis_bahan"
                                                value="{{$sampah->jahit->potong->bahan->jenis_bahan}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$sampah->jahit->potong->bahan->warna}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$sampah->jahit->potong->bahan->sku}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$sampah->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$sampah->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$sampah->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal">Asal</label>
                                            <input type="text" class="form-control" readonly required id="asal_keluar"
                                                name="asal" value="{{$sampah->asal}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" readonly required id="jumlah_keluar"
                                                name="jumlah" value="{{$sampah->total}}">
                                        </div>

                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran</label>
                                <div class="row">

                                    @forelse ($sampah->jahit->jahit_dibuang as $item)
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
                                                rows="6">{{$sampah->jahit->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('sampah.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Print</button>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
