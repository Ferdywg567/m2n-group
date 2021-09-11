@extends('backend.master')

@section('title', 'Jahit')
@section('title-nav', 'Jahit')
@section('jahit', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('jahit.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Pembayaran Vendor</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('jahit.pembayaran.update',[$jahit->id])}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')

                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly required id="nama_vendor"
                                                value="{{$jahit->nama_vendor}}" name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly required
                                                        id="harga_vendor" value="{{$jahit->harga_vendor}}"
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
                                            <label for="jumlah_bahan_yang_dijahit">Jumlah Bahan Yang Dijahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$jahit->jumlah_bahan}}" id="jumlah_bahan_yang_dijahit"
                                                    name="jumlah_bahan_yang_dijahit">
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
                                                value="{{$jahit->konversi}}" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_bayar">Total yang Harus Dibayar</label>
                                            <input type="number" class="form-control" required readonly
                                                value="{{$jahit->total_bayar}}" id="total_bayar" name="total_bayar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sisa_bayar">Sisa yang Harus Dibayar</label>
                                            <input type="text" class="form-control" required readonly id="sisa_bayar"
                                                value="{{$jahit->sisa_bayar}}" name="sisa_bayar">
                                        </div>
                                    </div>
                                </div>

                                @if ($jahit->pembayaran_pertama == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" min="0" required
                                                value="{{$jahit->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif ($jahit->pembayaran_pertama > 0 && $jahit->pembayaran_kedua == null &&
                                $jahit->pembayaran_ketiga == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" required min="0"
                                                value="{{$jahit->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif ($jahit->pembayaran_pertama > 0 && $jahit->pembayaran_kedua > 0 &&
                                $jahit->pembayaran_ketiga == null)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" required min="0"
                                                value="{{$jahit->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @elseif($jahit->status_pembayaran == 'Lunas')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_pertama">Pembayaran Pertama</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_pertama}}" id="pembayaran_pertama"
                                                name="pembayaran_pertama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_kedua">Pembayaran Kedua</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_kedua}}" id="pembayaran_kedua"
                                                name="pembayaran_kedua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran_ketiga">Pembayaran Ketiga</label>
                                            <input type="number" class="form-control" disabled
                                                value="{{$jahit->pembayaran_ketiga}}" id="pembayaran_ketiga"
                                                name="pembayaran_ketiga">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('jahit.index')}}">Batal</a>
                                        @if ($jahit->status_pembayaran != 'Lunas')
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
