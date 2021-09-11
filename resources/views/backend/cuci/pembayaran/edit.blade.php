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

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Pembayaran Vendor</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.pembayaran.update',[$cuci->id])}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')

                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly required id="nama_vendor"
                                                value="{{$cuci->nama_vendor}}" name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly required
                                                        id="harga_vendor" value="{{$cuci->harga_vendor}}"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dicuci">Jumlah Bahan Yang Dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$cuci->kain_siap_cuci}}" id="jumlah_bahan_yang_dicuci"
                                                    name="jumlah_bahan_yang_dicuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                value="{{$cuci->konversi}}" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_bayar">Total yang Harus Dibayar</label>
                                            <input type="number" class="form-control" required readonly
                                                value="{{$cuci->total_bayar}}" id="total_bayar" name="total_bayar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sisa_bayar">Sisa yang Harus Dibayar</label>
                                            <input type="text" class="form-control" required readonly id="sisa_bayar"
                                                value="{{$cuci->sisa_bayar}}" name="sisa_bayar">
                                        </div>
                                    </div>
                                </div>

                                @if ($cuci->pembayaran_pertama == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" min="0" required
                                                value="{{$cuci->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif ($cuci->pembayaran_pertama > 0 && $cuci->pembayaran_kedua == null &&
                                $cuci->pembayaran_ketiga == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" required min="0"
                                                value="{{$cuci->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif ($cuci->pembayaran_pertama > 0 && $cuci->pembayaran_kedua > 0 &&
                                $cuci->pembayaran_ketiga == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" required min="0"
                                                value="{{$cuci->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif($cuci->status_pembayaran == 'Lunas')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$cuci->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Batal</a>
                                        @if ($cuci->status_pembayaran != 'Lunas')
                                            <button type="submit" class="btn btn-primary btnmasuk">Simpan</button>
                                        @endif


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
@push('scripts')
<script>
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }



     })
</script>
@endpush
