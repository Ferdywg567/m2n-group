@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('rekapitulasi.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Rekapitulasi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" action="{{route('rekapitulasi.cetak')}}" target="_blank">
                            @csrf

                            <input type="hidden" name="id" value="{{$rekap->id}}">
                            @if (!empty($rekap->cuci_id))
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required
                                                id="kode_transaksi" name="kode_transaksi"
                                                value="{{$rekap->cuci->jahit->potong->bahan->kode_transaksi}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$rekap->cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$rekap->cuci->jahit->potong->bahan->warna}}">
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan_keluar" name="jenis_bahan"
                                                value="{{$rekap->cuci->jahit->potong->bahan->jenis_bahan}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$rekap->cuci->jahit->potong->bahan->sku}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$rekap->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$rekap->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$rekap->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal">Asal</label>
                                            <input type="text" class="form-control" readonly required id="asal_keluar"
                                                name="asal" value="Cuci">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_cuci">Jumlah Berhasil</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->cuci->berhasil_cuci}}" id="berhasil_cuci"
                                                    name="berhasil_cuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_direpair">Jumlah Diperbaiki</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->jumlah_diperbaiki}}" id="barang_direpair"
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
                                <label for="ukurandirepair" class="text-dark">Ukuran yang Direpair</label>
                                <div class="row">

                                    @forelse ($rekap->detail_rekap as $item)
                                    @if ($item->status == 'direpair')
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

                                    @forelse ($rekap->detail_rekap as $item)
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
                                            href="{{route('rekapitulasi.index')}}">Close</a>
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
                                                value="{{$rekap->jahit->potong->bahan->kode_transaksi}}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan"
                                                value="{{$rekap->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                value="{{$rekap->jahit->potong->bahan->warna}}">
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan_keluar" name="jenis_bahan"
                                                value="{{$rekap->jahit->potong->bahan->jenis_bahan}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" value="{{$rekap->jahit->potong->bahan->sku}}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$rekap->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$rekap->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$rekap->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal">Asal</label>
                                            <input type="text" class="form-control" readonly required id="asal_keluar"
                                                name="asal" value="Jahit">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_jahit">Jumlah Berhasil</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->jahit->berhasil}}" id="berhasil_jahit"
                                                    name="berhasil_jahit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_direpair">Jumlah Diperbaiki</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$rekap->jumlah_diperbaiki}}" id="barang_direpair"
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
                                <label for="ukurandirepair" class="text-dark">Ukuran yang Direpair</label>
                                <div class="row">

                                    @forelse ($rekap->detail_rekap as $item)
                                    @if ($item->status == 'direpair')
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

                                    @forelse ($rekap->detail_rekap as $item)
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
                                            href="{{route('rekapitulasi.index')}}">Tutup</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Cetak</button>

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
