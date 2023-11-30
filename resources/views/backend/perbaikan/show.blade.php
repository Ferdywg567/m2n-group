@extends('backend.master')

@section('title', 'Perbaikan')
@section('title-nav', 'Perbaikan')
@section('perbaikan', 'class=active-sidebar')

@section('content')
{{-- @php
    dd($repair)
@endphp --}}
    <style>
        textarea {
            width: 300px;
            height: 170px !important;
        }
    </style>
    <div id="non-printable">
        <section class="section">
            <div class="section-header ">
                <a class="btn btn-primary" href="{{ route('perbaikan.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="ml-2">Detail Perbaikan</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form method="POST" target="_blank" action="{{ route('perbaikan.cetak') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $repair->id }}">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="kode_bahan">Kode Bahan</label>
                                                <input type="text" class="form-control" readonly required id="kode_bahan"
                                                    name="kode_bahan" value="{{ $repair->bahan->kode_bahan }}">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <input type="text" class="form-control" readonly required id="sku_keluar"
                                                    name="sku" value="{{ $repair->bahan->sku }}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                                <input type="text" class="form-control" readonly required
                                                    id="no_surat_keluar" name="no_surat"
                                                    value="{{ $repair->bahan->no_surat }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_bahan">Nama Produk</label>
                                                <input type="text" class="form-control" readonly required id="nama_bahan"
                                                    name="nama_bahan" value="{{ $repair->bahan->nama_bahan }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ukuran_baju">Ukuran Baju</label>
                                                <input type="text" class="form-control" readonly required
                                                    id="ukuran_baju" name="ukuran_baju" value="{{ $jahit['ukuran'] }}">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="warna_baju">Warna Baju</label>
                                                <input type="text" class="form-control" readonly required
                                                    id="warna_baju_keluar" name="warna_baju"
                                                    value="{{ $repair->bahan->warna }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="text-dark font-weight-bold">Asal Barang</label>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tailoring">Jahit</label>
                                                <div class="input-group mb-2">
                                                    <input type="hidden" name="jahit_direpair_id"
                                                        value="{{ $jahit['jahit_direpair_id'] }}">
                                                    <input type="number" class="form-control" readonly
                                                        value="{{ $jahit['jumlah'] }}" required id="tailoring"
                                                        name="tailoring">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="washing">Cuci</label>
                                                <div class="input-group mb-2">
                                                    <input type="hidden" name="cuci_direpair_id"
                                                        value="{{ $cuci['cuci_direpair_id'] }}">
                                                    <input type="number" class="form-control" readonly
                                                        value="{{ $cuci['jumlah'] }}" required id="washing"
                                                        name="washing">
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
                                                <label for="keterangan_tailoring">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_tailoring" name="keterangan_tailoring" readonly rows="3">{{ $jahit['keterangan'] }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan_washing">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_washing" name="keterangan_washing" readonly rows="3">{{ $cuci['keterangan'] }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="total_barang">Total Barang</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" readonly required
                                                        id="total_barang" name="total_barang"
                                                        value="{{ $repair->total }}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!count($repair->detail_jahit_repair))
                                        <div class="form-group">
                                            <label for="ukurandirepair" class="text-dark">Ukuran Jahitan yang
                                                Diperbaiki</label>
                                            <div class="row">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @forelse ($repair->detail_jahit_repair as $item)
                                                    <div class="col-md-2">
                                                        <input type="hidden" name="dataukurandirepair[]"
                                                            value="{{ $item->ukuran }}">
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{ $item->ukuran }}</div>
                                                            </div>
                                                            <input type="number" class="form-control" required
                                                                id="jumlahdirepair" name="jumlahdirepair[]"
                                                                value="{{ $item->jumlah }}" readonly>
                                                        </div>
                                                    </div>
                                                    @if ($loop->iteration % 6 == 0)
                                            </div>
                                            <div class="row">
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @empty
                                    @endforelse

                                </div>
                        </div>
                        @endif
                        @if (!count($repair->detail_cuci_repair))
                            <div class="form-group">
                                <label for="ukurandirepair" class="text-dark">Ukuran Cuci yang
                                    Diperbaiki</label>
                                <div class="row">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse ($repair->detail_cuci_repair as $item)
                                        <div class="col-md-2">
                                            <input type="hidden" name="dataukurandirepair[]"
                                                value="{{ $item->ukuran }}">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">{{ $item->ukuran }}</div>
                                                </div>
                                                <input type="number" class="form-control" required id="jumlahdirepair"
                                                    name="jumlahdirepair[]" value="{{ $item->jumlah }}" readonly>
                                            </div>
                                        </div>
                                        @if ($loop->iteration % 6 == 0)
                                </div>
                                <div class="row">
                        @endif
                        @php
                            $i++;
                        @endphp
                    @empty
                        @endforelse

                    </div>
                </div>

                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai Perbaikan </label>
                            <input type="date" class="form-control" readonly value="{{ $repair->tanggal_selesai }}"
                                required id="tanggal_selesai" name="tanggal_selesai">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a type="button" class="btn btn-secondary" href="{{ route('perbaikan.index') }}">Tutup</a>
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
