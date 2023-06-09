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
                                    @if (count($menunggu) > 0)
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
                                                                style="font-size: 10px">Bayar Sebelum
                                                                {{\AppHelper::instance()->tanggal_add($item->created_at)}}
                                                            </h6>
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
                                                            <a href="{{route('frontend.user.pembelian.show',[$item->id])}}" style="font-size: 12px;color:#FF3B30">Lihat
                                                                Detail</a>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm ml-2 btnupload"
                                                                style="font-size: 12px;" data-id="{{$item->id}}">Upload
                                                                Bukti
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
                                    @else
                                    <div class="row pt-15">
                                        <div class="col-md-12 text-center">
                                            <h4>Data Masih Kosong</h4>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <div class="tab-pane fade show" id="nav-daftar" role="tabpanel"
                                    aria-labelledby="nav-daftar-tab">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            @forelse ($transaksi as $item)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card shadow mt-2" style="border-radius: 10px">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5 class="card-title font-weight-bold ">
                                                                        <span class="mr-4"> Pembelian
                                                                            {{date('j F
                                                                            Y',strtotime($item->created_at))}}</span>
                                                                        <span class="mr-4"
                                                                            style="color:#FF3B30">{{$item->kode_transaksi}}</span>
                                                                        @if ($item->status_bayar == 'sudah di upload')
                                                                        <span class="badge badge-warning p-2">MENUNGGU
                                                                            VERIFIKASI</span>
                                                                        @elseif ($item->status_bayar == 'sudah dibayar'
                                                                        && $item->status == 'dikirim' )
                                                                        <span
                                                                            class="badge badge-warning p-2">DIKIRIM</span>
                                                                        @elseif ($item->status == 'telah tiba')
                                                                        <span
                                                                            class="badge badge-success p-2">SELESAI</span>
                                                                        @elseif ($item->status_bayar == 'sudah dibayar')
                                                                        <span class="badge badge-warning p-2">PROSES
                                                                            KIRIM</span>
                                                                        @elseif ($item->status_bayar == 'dibatalkan')
                                                                        <span
                                                                            class="badge badge-danger p-2">DIBATALKAN</span>
                                                                        @endif

                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    @forelse ($item->detail_transaksi as $row)
                                                                    <div class="row mt-1">
                                                                        <div class="col-md-4">
                                                                            <img src="{{asset('uploads/images/produk/'.$row->produk->detail_gambar[0]->filename)}}"
                                                                                class="rounded" alt=""
                                                                                style="width: 100%" srcset="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                {{$row->produk->nama_produk}}</h5>
                                                                            <h5 class="font-weight-bold text-secondary">
                                                                                Qty {{$row->jumlah}} seri</h5>
                                                                            <h5 class="font-weight-bold text-secondary">
                                                                                @rupiah($row->total_harga)</h5>
                                                                        </div>
                                                                    </div>
                                                                    @empty

                                                                    @endforelse

                                                                </div>
                                                                <div class="col-md-4"
                                                                    style="border-left: 1px solid #C7C7CC; border-right:1px solid #C7C7CC">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <img src="{{asset('uploads/images/bank/'.$item->bank->logo)}}"
                                                                                style="width: 100%" class="mt-3" alt=""
                                                                                srcset="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <h5 class="text-secondary mt-3">
                                                                                Metode Pembayaran</h5>
                                                                            <h5 class="font-weight-bold">
                                                                                Transfer Manual
                                                                                {{$item->bank->nama_bank}}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5 class="text-secondary mt-3">
                                                                                Total Belanja</h5>
                                                                            <h5 class="font-weight-bold"
                                                                                style="color:#FF3B30">

                                                                                @rupiah($item->total_harga)</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                    <a href="{{route('frontend.user.pembelian.show',[$item->id])}}"
                                                                        style="font-size: 12px;color:#FF3B30">Lihat
                                                                        Detail</a>
                                                                    @if ($item->status == 'dikirim')
                                                                    <button type="button"
                                                                        class="btn btn-primary ml-2 konfirmasi-selesai"
                                                                        data-id="{{$item->id}}">Konfirmasi
                                                                        Selesai</button>
                                                                    @endif

                                                                    @if ($item->status == 'telah tiba')
                                                                    <button type="button"
                                                                        class="btn btn-primary ml-2 add_review"
                                                                        data-id="{{$item->id}}">Review</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="row pt-15">
                                                <div class="col-md-12 text-center">
                                                    <h4>Data Masih Kosong</h4>
                                                </div>
                                            </div>
                                            @endforelse

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
<!-- Modal Upload bukti bayar Foto -->
<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="modalBayarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalBayarLabel">Upload Bukti Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUpload">
                <div class="modal-body">
                    <div id="data-alert-upload" class="pb-5">

                    </div>
                    <input type="hidden" name="id" id="id_transaksi">

                    <div class="row mt-2">
                        <div class="col-md-12">

                            <div id="dropzoneDragArea" class="dropzone" style="margin-top: -20px">
                                <div class="dz-message d-flex flex-column">
                                    <i class="ri-file-upload-line"></i>
                                    Seret atau pilih bukti bayar disini
                                    <br>
                                    Maksimal ukuran file 5 MB dan berekstensi .jpeg / .jpg / .png
                                    <div class="dropzone-previews"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary " id="btnSimpanUpload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 40%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Submit Ulasan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="formReview">
                <div class="modal-body">
                    <div id="data-alert-ulasan">

                    </div>
                    <input type="hidden" name="id" id="id_transaksi_review">
                    <input type="hidden" name="rating" id="rating">
                    <h3 class="text-center mt-2 mb-4">

                        <i class="icon_star submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="icon_star submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="icon_star submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="icon_star submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="icon_star submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h3>

                    <div class="form-group">
                        <textarea name="ulasan" id="ulasan" class="form-control"
                            placeholder="Tulis ulasan disini"></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </div>
            </form>

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
    $(document).ready(function () {
        function ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        var rating_data = 0;
        $('#nav-menunggu-tab').css('background-color', 'black')
        $('#nav-menunggu-tab').css('color', 'white')
        $('#nav-daftar-tab').css('background-color', '')
        $('#nav-daftar-tab').css('color', 'black')

        $('#nav-menunggu-tab').click(function () {
            $(this).css('background-color', 'black')
            $(this).css('color', 'white')
            $('#nav-daftar-tab').css('background-color', '')
            $('#nav-daftar-tab').css('color', 'black')
        })

        $('#nav-daftar-tab').click(function () {
            $('#nav-menunggu-tab').css('background-color', '')
            $('#nav-menunggu-tab').css('color', 'black')
            $(this).css('color', 'white')
            $(this).css('background-color', 'black')
        })

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('icon_star');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }
        $(document).on('mouseenter', '.submit_star', function () {

            var rating = $(this).data('rating');
            $('#rating').val(rating)
            reset_background();

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');

            }

        });
        $(document).on('click', '.submit_star', function () {

            rating_data = $(this).data('rating');
            $('#rating').val(rating_data)

        });

        $(document).on('mouseleave', '.submit_star', function () {

            // reset_background();

            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('icon_star');

                $('#submit_star_' + count).addClass('text-warning');
            }

        });
        $('#review_modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });
        $(document).on('click', '.btnupload', function () {
            var id = $(this).data('id');
            $('#id_transaksi').val(id)
            $('#modalBayar').modal('show')
            $('#data-alert-upload').empty()
        })

        $('.add_review').click(function () {
            reset_background();
            var id = $(this).data('id')
            $('#id_transaksi_review').val(id)
            $('#review_modal').modal('show');
        });

        $('#save_review').on('click', function () {
            var form = $('#formReview').serialize()

            ajax()
            $.ajax({
                url: "{{route('frontend.ulasan.store')}}",
                method: "POST",
                data: form,
                success: function (response) {
                    if (response.status) {
                        setTimeout(function () {
                            window.location.reload(true)
                        }, 1500)
                    }
                    $('#data-alert-ulasan').html(response.data)
                }
            })
        })

        let token = $('meta[name="csrf-token"]').attr('content');
        var maxImageWidth = 1200,
            maxImageHeight = 500;
        var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('frontend.user.pembelian.store')}}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            dictRemoveFile: "Hapus Gambar",
            params: {
                _token: token
            },
            // The setting up of the dropzone
            init: function () {
                var myDropzone = this;
                var formUpload = new FormData();
                //form submission code goes here
                document.getElementById("btnSimpanUpload").addEventListener("click", function (e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    // console.log(myDropzone.files);

                    for (let index = 0; index < myDropzone.files.length; index++) {
                        const element = myDropzone.files[index];
                        var imagename = element.name.split('.').pop().toLowerCase();
                        if ($.inArray(imagename, ['png', 'jpg', 'jpeg']) == -1) {
                            var dataalert =
                                '<div class="alert alert-danger" role="alert"> Tipe gambar wajib png, jpg, jpeg</div>'
                            $('#data-alert-upload').html(dataalert)
                            return false;
                        }

                        // if(element.width != maxImageWidth || element.height != maxImageHeight){
                        //     var dataalert = '<div class="alert alert-danger" role="alert">Resolusi gambar wajib 1200 x 500 pixel</div>'
                        //     $('#data-alert-upload').html(dataalert)
                        //     return false;
                        // }
                    }

                    if (myDropzone.files.length > 1) {
                        var dataalert =
                            '<div class="alert alert-danger" role="alert"> Gambar maksimal 1</div>'
                        $('#data-alert-upload').html(dataalert)
                        return false;
                    }

                    if (myDropzone.files.length) {
                        myDropzone.processQueue();
                    } else {
                        var dataalert =
                            '<div class="alert alert-danger" role="alert"> Gambar wajib diisi</div>'
                        $('#data-alert-upload').html(dataalert)
                    }

                });
                this.on('sending', function (file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#formUpload').serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });
                this.on("queuecomplete", function () {

                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                // this.on("sendingmultiple", function() {
                // // Gets triggered when the form is actually being sent.
                // // Hide the success button or the complete form.

                //      formUpload.append("promo", "assssae");
                // });

                this.on("success", function (files, response) {

                    if (response.status) {
                        setTimeout(function () {
                            $('#modalBayar').modal('hide');
                            window.location.reload(true)
                        }, 1500)
                    } else {
                        $('#data-alert-upload').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.banner.index')}}"
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });

                this.on("successmultiple", function (files, response) {
                    console.log(response);

                    if (response.status) {
                        setTimeout(function () {
                            $('#modalBayar').modal('hide');
                            window.location.reload(true)
                        }, 1500)
                    } else {
                        $('#data-alert-upload').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.banner.index')}}"
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });

                this.on("errormultiple", function (files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error

                });
            }
        });

        function activaTab(tab) {
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };

        $(document).on('click', '.konfirmasi-selesai', function () {
            var id = $(this).data('id')
            swal({
                    text: "Apa anda yakin konfirmasi selesai transaksi ini ?",
                    icon: "warning",
                    buttons: ["Batal", "Ya"],
                    dangerMode: true,
                })
                .then((willUpdate) => {
                    if (willUpdate) {
                        ajax()
                        $.ajax({
                            url: "{{route('frontend.user.pembelian.update_selesai')}}",
                            method: "POST",
                            data: {
                                id: id
                            },
                            success: function (response) {
                                if (response.status) {

                                    swal("Success!",
                                        "Transaksi berhasil di konfirmasi!",
                                        "success");
                                    setTimeout(function () {
                                        window.location.reload(true)
                                    }, 1500)
                                }
                            }
                        })
                    }
                });
        })
    })

</script>
@endpush
