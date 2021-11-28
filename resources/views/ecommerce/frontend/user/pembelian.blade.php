@extends('ecommerce.frontend.main')

@section('content')
<style>
    .text-gray {
        color: #8E8E93;
    }

    .badge-primary {
        background-color: #FF3B30;
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
                                        aria-selected="true">Biodata Diri</a>
                                    <a class="nav-item nav-link" id="nav-alamatnav-daftar-tab" data-toggle="tab"
                                        href="#nav-daftar" role="tab" aria-controls="nav-daftar"
                                        aria-selected="false">Daftar Alamat</a>

                                </div>
                            </nav>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-menunggu" role="tabpanel"
                                    aria-labelledby="nav-menunggu-tab">
                                    <div class="row mt-3">

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


    })
</script>
@endpush
