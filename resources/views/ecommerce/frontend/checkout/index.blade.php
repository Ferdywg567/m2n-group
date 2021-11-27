@extends('ecommerce.frontend.main')

@section('content')
<style>
    .btn-outline-primary {
        color: #FF3B30;
        border-color: #FF3B30;
    }

    .btn-outline-primary:hover {
        background: #FF3B30;
        color: white;
        border-color: #FF3B30;
    }
</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a onclick="GoBackWithRefresh();return false;" href="#" class="text-left"><i
                        class="ri-arrow-left-line"></i> Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -80px !important;">
                <h3 class="text-center">Checkout</h3>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area  pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if ($alamat)
                <h5>Alamat Pengiriman</h5>
                <hr>
                <h5>{{$alamat->nama_penerima}}</h5>
                <h6>{{$alamat->no_telp}}</h6>
                <h5>{{$alamat->alamat_detail}}, {{$alamat->kecamatan}}, {{$alamat->kota}}, {{$alamat->kode_pos}}</h5>
                {{-- <h5>Perumahan Pabean Asri BLOK F8, Sedati, Sidoarjo, Jawa Timur, 61257</h5> --}}
                <hr>
                <a type="button" class="btn btn-outline-primary"
                    href="{{route('frontend.user.index').'#nav-alamat'}}">Pilih Alamat Lain</a>
                @else
                <a type="button" class="btn btn-outline-primary"
                    href="{{route('frontend.user.index').'#nav-alamat'}}">Isi Alamat Terlebih Dahulu</a>
                @endif

            </div>

            <div class="col-lg-4 col-md-12">
                <div class="grand-totall">
                    <h5 style="margin-top: -15px">Ringkasan Pembelian</h5>
                    <h6>Total Produk ({{count($data)}}) <span>@rupiah($totalharga)</span></h6>
                    <h6>Biaya Admin <span>@rupiah($admin)</span></h6>
                    <h5>Total Tagihan <span>@rupiah($totaltagihan)</span></h5>
                    <button type="button" class="btn btn-primary btn-block btnBayar" @if(!$alamat) disabled @endif><i
                            class="ri-shield-check-line"></i> Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="modalBayarLabel">Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="font-weight-bold">Total Bayar</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="grand-totall" style="padding-bottom:30px;padding-top:35px;color:#8E8E93">
                            <h4 style="color:#FF3B30" class="font-weight-bold">@rupiah($totaltagihan)</h4>
                            <hr>
                            <h6 style="color:#8E8E93">Total Produk ({{count($data)}}) <span>@rupiah($totalharga)</span>
                            </h6>
                            <h6 style="color:#8E8E93">Biaya Admin <span>@rupiah($admin)</span></h6>
                            <span style="float: right; color:#8E8E93">* Harga diluar ongkos kirim</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="grand-totall" style="padding-bottom:30px;padding-top:35px;  ">
                            <h6 class="font-weight-bold">Transfer Manual</h6>
                            <hr>
                            <div class="form-group">
                                <select class="form-control" id="bank">
                                    @forelse ($bank as $item)
                                    <option value="{{$item->id}}">{{$item->nama_bank}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary btn-block">Konfirmasi Pesanan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        var perfEntries = performance.getEntriesByType("navigation");
        // $('#bank').select2()
        if (perfEntries[0].type === "back_forward") {
            location.reload(true);
        }
        function GoBackWithRefresh(event) {
            if ('referrer' in document) {
                window.location = document.referrer;
                /* OR */
                //location.replace(document.referrer);
            } else {
                window.history.back();
            }
        }

        $('.btnBayar').on('click', function () {
            $('#modalBayar').modal('show')
         })
        //  $('#bank').msDropdown()
    })
</script>
@endpush
