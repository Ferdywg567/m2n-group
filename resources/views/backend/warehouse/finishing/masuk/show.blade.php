@extends('backend.master')

@section('title', 'Sortir')
@section('title-nav', 'Sortir')
@section('finishing', 'class=active-sidebar')

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
    </style>
    <style>
        textarea {
            width: 300px;
            height: 170px !important;
        }
    </style>
    <div id="non-printable">
        <section class="section">
            <div class="section-header ">
                <a class="btn btn-primary" href="{{ route('warehouse.finishing.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="ml-2">Detail Data | Produk Masuk</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('warehouse.finishing.cetak') }}" target="_blank" method="post">
                                @csrf
                                <input type="hidden" name="id" id="idbahan" value="{{ $finish->id }}">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode_transaksi">Kode Transaksi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $finish->cuci->jahit->potong->bahan->kode_transaksi }}"
                                                    readonly required id="kode_transaksi" name="kode_transaksi">


                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sku">Kode SKU</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $finish->cuci->jahit->potong->bahan->sku }}" required
                                                    id="sku" name="sku">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="no_surat">Nomor Surat Jalan</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $finish->no_surat }}" required id="no_surat" name="no_surat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_masuk">Tanggal Barang Masuk</label>
                                                <input type="date" class="form-control" readonly
                                                    value="{{ $finish->cuci->jahit->potong->bahan->tanggal_masuk }}"
                                                    required id="tanggal_masuk" name="tanggal_masuk">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_mulai_sortir">Tanggal Mulai Sortir</label>
                                                <input type="date" class="form-control" readonly
                                                    value="{{ $finish->tanggal_qc }}" required id="tanggal_mulai_sortir"
                                                    name="tanggal_mulai_sortir">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $finish->cuci->jahit->potong->bahan->nama_bahan }}"
                                                    id="nama_produk" name="nama_produk">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="warna">Warna</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $finish->cuci->jahit->potong->bahan->warna }}" required
                                                    id="warna" name="warna">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_kain">Jenis Kain</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $finish->cuci->jahit->potong->bahan->jenis_bahan }}" required
                                                    id="jenis_kain" name="jenis_kain">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barang_siap_qc">Stok Siap Sortir</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" readonly
                                                        value="{{ $finish->barang_siap_qc }}" required id="barang_siap_qc"
                                                        name="barang_siap_qc">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" id="ukuran" style="margin-bottom: -30px">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ukuran">Ukuran</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @forelse ($finish->detail_finish as $item)
                                            <div class="col-md-2">
                                                <input type="hidden" name="dataukuran[]" value="{{ $item->ukuran }}"
                                                    readonly>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ $item->ukuran }}</div>
                                                    </div>
                                                    <input type="number" class="form-control" required id="jumlah"
                                                        readonly name="jumlah[]" value="{{ $item->jumlah }}">
                                                </div>
                                            </div>

                                            @if ($loop->iteration % 6 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                    @empty
                                        @endforelse

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 text-center">
                                            <a type="button" class="btn btn-secondary"
                                                href="{{ route('warehouse.finishing.index') }}">Tutup</a>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="ri-printer-fill"></i>
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
