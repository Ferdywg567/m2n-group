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
            <h1 class="ml-2">Detail Data | Finishing</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control"
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}"
                                                readonly required id="kode_bahan" name="kode_bahan">


                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->sku}}"
                                                required id="sku" name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
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
                                            <label for="tanggal_masuk">Tanggal Barang Masuk</label>
                                            <input type="date" class="form-control" readonly
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->tanggal_masuk}}"
                                                required id="tanggal_masuk" name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_qc">Tanggal QC Barang</label>
                                            <input type="date" class="form-control" readonly
                                                value="{{$finish->tanggal_qc}}" required id="tanggal_qc"
                                                name="tanggal_qc">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}"
                                                id="nama_produk" name="nama_produk">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->warna}}"
                                                required id="warna" name="warna">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$finish->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                required id="jenis_kain" name="jenis_kain">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_siap_qc">Barang Siap QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly
                                                    value="{{$finish->rekapitulasi->total_barang}}" required
                                                    id="barang_siap_qc" name="barang_siap_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_lolos_qc">Barang Lolos QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    value="{{$finish->barang_lolos_qc}}" id="barang_lolos_qc" readonly
                                                    name="barang_lolos_qc">
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
                                <div class="row">
                                    @forelse ($finish->detail_finish as $item)
                                    @if ($item->ukuran == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetails">
                                            <input type="number" min="0" readonly value="{{$item->jumlah}}"
                                                class="form-control" required id="jumlahs" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailm">
                                            <input type="number" min="0" readonly value="{{$item->jumlah}}"
                                                class="form-control" required id="jumlahm" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetaill">
                                            <input type="number" min="0" readonly value="{{$item->jumlah}}"
                                                class="form-control" required id="jumlahl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XL')
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailxl">
                                            <input type="number" min="0" readonly value="{{$item->jumlah}}"
                                                class="form-control" required id="jumlahxl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XXL')
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailxxl">
                                            <input type="number" min="0" readonly value="{{$item->jumlah}}"
                                                class="form-control" required id="jumlahxxl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @endif
                                    @empty

                                    @endforelse

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gagal_qc">Barang Gagal QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    value="{{$finish->barang_gagal_qc}}" id="gagal_qc" name="gagal_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_diretur">Barang Diretur</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" required
                                                            value="{{$finish->barang_diretur}}" id="barang_diretur"
                                                            readonly name="barang_diretur">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang Diretur</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @forelse ($finish->finish_retur as $item)
                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-2">

                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="S">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturs">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdireturs" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'M')
                                            <div class="col-md-2" id="ukurandireturm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="M">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturm">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdireturm" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'L')

                                            <div class="col-md-2" id="ukurandireturl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="L">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturl">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdireturl" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'XL')

                                            <div class="col-md-2" id="ukurandireturxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XL</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="XL">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturxl">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdireturxl" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'XXL')
                                            <div class="col-md-2" id="ukurandireturxxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XXL</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="XXL">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturxxl">
                                                    <input type="text" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdireturxxl" name="jumlahdiretur[]">
                                                </div>
                                            </div>

                                            @endif
                                            @empty

                                            @endforelse



                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_diretur">Keterangan Barang Diretur</label>
                                            <textarea class="form-control" readonly id="keterangan_diretur"
                                                name="keterangan_diretur"
                                                rows="3">{{$finish->keterangan_diretur}}</textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Barang Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" readonly required
                                                            value="{{$finish->barang_dibuang}}" id="barang_dibuang"
                                                            name="barang_dibuang">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang Dibuang</label>
                                            </div>
                                        </div>
                                        <div class="row">


                                            @forelse ($finish->finish_dibuang as $item)
                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdibuangs" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'M')
                                            <div class="col-md-2" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdibuangm" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'L')
                                            <div class="col-md-2" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdibuangl" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'XL')

                                            <div class="col-md-2" id="ukurandibuangxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XL</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="XL">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangxl">
                                                    <input type="number" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdibuangxl" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif($item->ukuran == 'XXL')
                                            <div class="col-md-2" id="ukurandibuangxxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XXL</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="XXL">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangxxl">
                                                    <input type="text" min="0" value="{{$item->jumlah}}" readonly class="form-control" required
                                                        id="jumlahdibuangxxl" name="jumlahdibuang[]">
                                                </div>
                                            </div>

                                            @endif
                                            @empty

                                            @endforelse


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Barang Dibuang</label>
                                            <textarea class="form-control" readonly id="keterangan_dibuang"
                                                name="keterangan_dibuang"
                                                rows="6">{{$finish->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.finishing.index')}}">Close</a>
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
