@extends('ecommerce.frontend.main')

@section('content')
<style>
    .text-gray {
        color: #8E8E93;
    }

    .badge-primary {
        background-color: #FF3B30;
    }

    h5,
    h6,
    h4 {
        font-family: 'Heebo', sans-serif;
    }
</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a onclick="GoBackWithRefreshUrl();return false;" href="#" class="text-left"><i
                        class="ri-arrow-left-line"></i> Kembali</a>

            </div>

        </div>
    </div>
</div>
<div class="my-account-wrapper  pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-menunggu-tab" data-toggle="tab"
                                        href="#nav-menunggu" role="tab" aria-controls="nav-menunggu"
                                        aria-selected="true">Menunggu Pembayaran</a>
                                    <a class="nav-item nav-link" id="nav-daftar-tab" data-toggle="tab"
                                        href="#nav-daftar" role="tab" aria-controls="nav-daftar"
                                        aria-selected="false">Daftar Transaksi</a>

                                </div>
                            </nav>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-menunggu" role="tabpanel"
                                    aria-labelledby="nav-menunggu-tab">
                                    <div class="row mt-3">
                                        @forelse ($menunggu as $item)
                                        <div class="col-md-6">
                                            <div class="card shadow  bg-white" style="border-radius: 10px">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <h6 class="card-title font-weight-bold"
                                                                style="font-size: 12px">Pembelian {{date('j F
                                                                Y',strtotime($item->created_at))}}</h6>
                                                        </div>
                                                        <div class="col-md-3 text-left">
                                                            <h6 class="card-title font-weight-bold"
                                                                style="font-size: 12px; color:#FF3B30">
                                                                {{$item->kode_transaksi}}</h6>
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <h6 class="card-title font-weight-bold"
                                                                style="font-size: 10px">Bayar Sebelum 2 Dec 16:27</h6>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="{{asset('uploads/images/bank/'.$item->bank->logo)}}"
                                                                        style="width: 100%" alt="" srcset="">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h6 class="text-secondary mt-1"
                                                                        style="font-size: 11px">
                                                                        Metode Pembayaran</h6>
                                                                    <h6 class="font-weight-bold"
                                                                        style="font-size: 11px">
                                                                        Transfer Manual {{$item->bank->nama_bank}}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-left">
                                                            <div class="row"
                                                                style="border-left: 1px solid #C7C7CC; border-right:1px solid #C7C7CC">
                                                                <div class="col-md-12">
                                                                    <h6 class="text-secondary mt-1"
                                                                        style="font-size: 11px">
                                                                        No. Rekening</h6>
                                                                    <h6 class="font-weight-bold"
                                                                        style="font-size: 11px">
                                                                        {{$item->bank->nomor_rekening}}</h6>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <div class="row">
                                                                <div class="col-md-12 text-left">
                                                                    <h6 class="text-secondary mt-1"
                                                                        style="font-size: 11px">
                                                                        Total Pembayaran</h6>
                                                                    <h6 class="font-weight-bold"
                                                                        style="font-size: 11px; color:#FF3B30">
                                                                        @rupiah($item->total_harga)
                                                                    </h6>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <a href="http://"
                                                                style="font-size: 12px;color:#FF3B30">Lihat Detail</a>
                                                            <button type="button" class="btn btn-primary btn-sm ml-2"
                                                                style="font-size: 12px;">Upload Bukti
                                                                Pembayaran</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($loop->iteration % 2 ==0)
                                    </div>
                                    <div class="row mt-2">
                                        @endif
                                        @empty

                                        @endforelse
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="nav-daftar" role="tabpanel"
                                    aria-labelledby="nav-daftar-tab">
                                    <div class="row mt-3">
                                        <div class="col-md-12">

                                            {{-- <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card mt-2">
                                                        <div class="card-body">
                                                            <div>
                                                                <div style="display:inline-block">
                                                                    <h3>Kantor Sidoarjo </h3>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <h5>Utama</h5>
                                                                </div>

                                                            </div>
                                                            <div class="pt-20">
                                                                <div style="display:inline-block">
                                                                    <h3>Ryan Ardito </h3>
                                                                </div>

                                                            </div>
                                                            <div class="pt-5">
                                                                <p>628123456789</p>
                                                                <p style="margin-top:-5px">Dusun Balongbiru Desa Sadang
                                                                    RT. 08 RW. 03 Gang 8X No. 5,
                                                                    Sidoarjo</p>
                                                            </div>
                                                            <div class="pt-10">
                                                                <div style="display:inline-block">
                                                                    <a href="http://">Ubah Alamat</a>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <a href="http://">Hapus Alamat</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
    Dropzone.autoDiscover = false;
    // console.log();
    function GoBackWithRefreshUrl(event) {
        history.go(-1)
    }
    $(document).ready(function(){
        function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        }

                 $('#nav-menunggu-tab').css('background-color','black')
                  $('#nav-menunggu-tab').css('color','white')
                  $('#nav-daftar-tab').css('background-color','')
                  $('#nav-daftar-tab').css('color','black')

              $('#nav-menunggu-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-daftar-tab').css('background-color','')
                  $('#nav-daftar-tab').css('color','black')
               })

               $('#nav-daftar-tab').click(function () {
                  $('#nav-menunggu-tab').css('background-color','')
                  $('#nav-menunggu-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })


    })
</script>
@endpush
