@extends('backend.master')

@section('title', 'Jahit')
@section('title-nav', 'Jahit')
@section('jahit', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav{
       margin-left:-25px;
    }
</style>
<style>
    textarea {
        width: 300px;
        height: 150px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('jahit.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Edit Data | Selesai</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('jahit.update',[$jahit->id])}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="jahitan selesai">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <div id="kdbahankeluar">
                                                <input type="text" class="form-control"
                                                    value="{{$jahit->potong->bahan->kode_transaksi}}" readonly
                                                    id="kdbahanreadkeluar" name="kdbahanreadkeluar">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$jahit->potong->bahan->sku}}" required id="sku_keluar"
                                                name="sku">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_jahit">Tanggal Jahit</label>
                                            <input type="date" class="form-control" value="{{$jahit->tanggal_jahit}}" readonly required id="tanggal_jahit"
                                                name="tanggal_jahit">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_keluar">Tanggal Selesai</label>
                                            <input type="date" class="form-control" readonly required
                                                value="{{$jahit->tanggal_selesai}}" id="tanggal_selesai_keluar"
                                                name="tanggal_selesai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required id="no_surat_keluar"
                                                value="{{$jahit->no_surat}}" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="vendor_jahit">Vendor Jahit</label>
                                            <input type="text" class="form-control" readonly value="{{$jahit->vendor}}"
                                            value="" id="vendor_jahit" name="vendor_jahit">
                                        </div>
                                    </div>
                                    @if ($jahit->vendor == 'eksternal')
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly value="{{$jahit->nama_vendor}}"
                                                value="" id="nama_vendor" name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor_keluar">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        value="{{$jahit->harga_vendor}}"  id="harga_vendor_keluar"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="/ lusin" readonly class="form-control"
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_jahit">Berhasil Jahit</label>
                                            <input type="number" value="{{$jahit->berhasil}}"
                                                class="form-control"  required id="berhasil_jahit"
                                                name="berhasil_jahit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" readonly value="{{$jahit->konversi}}"
                                                class="form-control" required id="konversi" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: -30px">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    @forelse ($jahit->detail_jahit as $item)
                                    @if ($item->size == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetails">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahs" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailm">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahm" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetaill">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahl" name="jumlah[]">
                                        </div>
                                    </div>

                                    @endif
                                    @empty

                                    @endforelse
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gagal_jahit">Gagal Jahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"
                                                    value="{{$jahit->gagal_jahit}}"  required id="gagal_jahit"
                                                    name="gagal_jahit">
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
                                                    <label for="barang_direpair">Barang Akan Direpair</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control"
                                                            value="{{$jahit->barang_direpair}}" required
                                                            id="barang_direpair"  name="barang_direpair">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang di repair</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            @forelse ($jahit->jahit_direpair as $item)

                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="S">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairs" value="{{$item->id}}">
                                                    <input type="number" min="0"  value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairs"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'M')
                                            <div class="col-md-4" id="ukurandirepairm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="M">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairm" value="{{$item->id}}">
                                                    <input type="number" min="0"  value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairm"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'L')
                                            <div class="col-md-4" id="ukurandirepairl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="L">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairl" value="{{$item->id}}">
                                                    <input type="number" min="0"  value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairl"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>


                                            @endif

                                            @empty

                                            @endforelse

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="keterangan_direpair">Keterangan Barang Direpair</label>
                                            <textarea class="form-control"  id="keterangan_direpair"
                                                name="keterangan_direpair"
                                                rows="3">{{$jahit->keterangan_direpair}}</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Barang Akan Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control"
                                                            value="{{$jahit->barang_dibuang}}" readonly required
                                                            id="barang_dibuang" name="barang_dibuang">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang di buang</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            @forelse ($jahit->jahit_dibuang as $item)

                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control"  required id="jumlahdibuangs"
                                                        name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'M')
                                            <div class="col-md-4" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control"  required id="jumlahdibuangm"
                                                        name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'L')
                                            <div class="col-md-4" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control"  required id="jumlahdibuangl"
                                                        name="jumlahdibuang[]">
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
                                            <textarea class="form-control"  id="keterangan_dibuang"
                                                name="keterangan_dibuang"
                                                rows="6">{{$jahit->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('jahit.index')}}">Close</a>
                                            <button type="submit" class="btn btn-primary">Update</button>
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
