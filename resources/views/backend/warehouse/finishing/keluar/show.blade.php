@extends('backend.master')

@section('title', 'Finishing')

@section('finishing', 'class=active-sidebar')

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
            <a class="btn btn-primary" href="{{route('warehouse.finishing.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Produk Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.finishing.cetak')}}" target="_blank" method="post">
                            @csrf
                            <input type="hidden" name="id" id="idbahan" value="{{$finish->id}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control"
                                                value="{{$finish->cuci->jahit->potong->bahan->kode_transaksi}}"
                                                readonly required id="kode_transaksi" name="kode_transaksi">


                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$finish->no_surat}}" required id="no_surat" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai">Tanggal Selesai Sortir</label>
                                            <input type="date" class="form-control"  required id="tanggal_selesai" readonly
                                                name="tanggal_selesai"  value="{{$finish->tanggal_selesai}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"  value="{{$finish->cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="barang_siap_qc">Stok Siap Sortir</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required  value="{{$finish->cuci->berhasil_cuci}}"
                                                    id="barang_siap_qc" name="barang_siap_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stok_lolos_sortir">Stok Lolos Sortir</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly  required value="{{$finish->barang_lolos_qc}}"
                                                    id="stok_lolos_sortir"  name="stok_lolos_sortir">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gagal_qc">Produk Gagal QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"  required readonly value="{{$finish->barang_gagal_qc}}"
                                                    id="gagal_qc" name="gagal_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <label for="ukurandiretur" class="text-dark">Ukuran lolos sortir</label>
                                <div class="row">
                                    @forelse ($finish->detail_finish as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukuran[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlah" readonly
                                                name="jumlah[]" value="{{$item->jumlah}}">
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
                                            <label for="barang_diretur">Produk Diretur</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly value="{{$finish->barang_diretur}}"
                                                    id="barang_diretur"  name="produk_diretur">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label for="ukurandiretur" class="text-dark">Ukuran yang Diretur</label>
                                <div class="row">
                                    @forelse ($finish->finish_retur as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandiretur[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlahdiretur" readonly
                                                name="jumlahdiretur[]" value="{{$item->jumlah}}">
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
                                            <label for="keterangan_diretur">Keterangan Produk Diretur</label>
                                            <textarea class="form-control"   id="keterangan_diretur" readonly
                                                name="keterangan_diretur"  rows="3">{{$finish->keterangan_diretur}}</textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="barang_dibuang">Produk Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required value="{{$finish->barang_dibuang}}"
                                                    id="barang_dibuang"  name="produk_dibuang">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran yang Dibuang</label>
                                <div class="row">
                                    @forelse ($finish->finish_dibuang as $item)
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
                                            <label for="keterangan_dibuang">Keterangan Produk Dibuang</label>
                                            <textarea class="form-control"   id="keterangan_dibuang" readonly
                                                name="keterangan_dibuang" rows="6">{{$finish->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.finishing.index')}}">Tutup</a>
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
