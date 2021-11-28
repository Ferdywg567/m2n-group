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

    h5,
    h6,
    h4 {
        font-family: 'Heebo', sans-serif;
    }

    .card {
        width: 100%;

    }

    .btn-wa {
        background-color: #34C759;
        border-radius: 8px;
        height: 60px;
        width: 58%
    }

    .btn-belanja {
        border-radius: 8px;
        height: 60px;
        width: 40%
    }

    @media (min-width: 576px) {
        .card {
            width: 100%;
        }
    }


    @media (min-width: 768px) {
        .card {
            width: 100%;
        }
    }

    @media (min-width: 992px) {
        .card {
            width: 100%;
        }
    }


    @media (min-width: 1200px) {
        .card {
            width: 40%;
        }

        .btn-wa {
            background-color: #34C759;
            border-radius: 8px;
            height: 45px;
            width: 28%
        }

        .btn-belanja {
            border-radius: 8px;
            height: 45px;
            width: 11%;
            padding-top: 10px;
        }

        .catatan {
            width: 40%
        }
    }
</style>

<div class="cart-main-area  pb-120">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card" style="border-radius:10px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="font-weight-bold"> Transfer Manual</h5>
                            </div>
                            <div class="col-md-4 text-right">
                                <img style="width: 60px" src="{{asset('uploads/images/bank/'.$bank->logo)}}"
                                    alt="" srcset="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 data-alert-salin">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 style="color:#8E8E93">No. Rekening</h6>
                                {{-- <br> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="font-weight-bold" id="nomor_rekening">{{$bank->nomor_rekening}}</h4>

                                    </div>
                                    <div class="col-md-8 mt-1">

                                        <h6 style="color:#8E8E93; cursor: pointer" id="btncopy"><i
                                                class="ri-file-copy-line"></i> Salin Rekening</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6 style="color:#8E8E93">Atas Nama</h6>
                                {{-- <br> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-weight-bold">{{$bank->nama_penerima}}</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6 style="color:#8E8E93">Total Pembayaran</h6>
                                {{-- <br> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 style="color:#FF3B30" class="font-weight-bold">@rupiah($transaksi['total_harga'])</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center">
                <a type="button" class="btn btn-outline-dark btn-belanja" href="{{route('landingpage.index')}}" >Belanja Lagi</a>
                <a type="button" target="blank" href="https://api.whatsapp.com/send?phone=6281939123456" class="btn btn-success ml-2 btn-wa" ><i class="ri-whatsapp-fill"></i>
                    Lanjutkan
                    Pembayaran di WhatsApp</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center ">
                <h6 class="font-weight-bold catatan">Catatan</h6>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center ">
                {{-- <h6 class="font-weight-bold catatan">Catatan</h6> --}}
                <p style="display: block;  font-size:10px">
                    - Simpan bukti pembayaran yang sewaktu-waktu diperlukan jika terjadi kendala transaksi

                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center ">
                {{-- <h6 class="font-weight-bold catatan">Catatan</h6> --}}
                <p style="display: block; font-size:10px; margin-left:-20px">

                    - Pesanan otomatis dibatalkan apabila tidak melakukan pembayaran lebih dari 2 hari
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center ">
                {{-- <h6 class="font-weight-bold catatan">Catatan</h6> --}}
                <p style="display: block; font-size:10px; margin-left:-255px">
                    setelah kode pembayaran diberikan
                </p>

            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
    $(document).ready(function(){
            $('#btncopy').click(function(){
               var data = $('#nomor_rekening').text();
               navigator.clipboard.writeText(data).then(function () {
                    var datahtml = `<div class="alert alert-success">Nomor rekening berhasil di salin</div>`

                    $('.data-alert-salin').html(datahtml)
                    setTimeout(function () { $('.data-alert-salin').empty() },2000)
                }, function () {
                    alert('Failure to copy. Check permissions for clipboard')
            });
            });



        })
</script>
@endpush
