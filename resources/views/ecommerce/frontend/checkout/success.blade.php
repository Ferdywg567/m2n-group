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

        .btnupload {
            width: 40%;
            border-radius: 10px;
            height: 45px;
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
                                <img style="width: 60px" src="{{asset('uploads/images/bank/'.$bank->logo)}}" alt=""
                                    srcset="">
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
                                        <h4 style="color:#FF3B30" class="font-weight-bold">
                                            @rupiah($transaksi['total_harga'])</h4>
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
                <a type="button" class="btn btn-outline-dark btn-belanja" href="{{route('landingpage.index')}}">Belanja
                    Lagi</a>
                <a type="button" target="blank" href="https://api.whatsapp.com/send?phone=6281939123456"
                    class="btn btn-success ml-2 btn-wa"><i class="ri-whatsapp-fill"></i>
                    Lanjutkan
                    Pembayaran di WhatsApp</a>
            </div>
        </div>
        @if (!session()->has('bukti_bayar'))
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center ">
                <button type="button" class="btn btn-primary btnupload">Upload Bukti Pembayaran</button>
            </div>
        </div>
        @endif

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
@endsection
@push('scripts')
<script>
      Dropzone.autoDiscover = false;
    $(document).ready(function () {
        $('#btncopy').click(function () {
            var data = $('#nomor_rekening').text();
            navigator.clipboard.writeText(data).then(function () {
                var datahtml =
                    `<div class="alert alert-success">Nomor rekening berhasil di salin</div>`

                $('.data-alert-salin').html(datahtml)
                setTimeout(function () {
                    $('.data-alert-salin').empty()
                }, 2000)
            }, function () {
                alert('Failure to copy. Check permissions for clipboard')
            });
        });


        $(document).on('click', '.btnupload', function () {

            $('#modalBayar').modal('show')
            $('#data-alert-upload').empty()
        })


        let token = $('meta[name="csrf-token"]').attr('content');
        var maxImageWidth = 1200,
            maxImageHeight = 500;
        var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('frontend.checkout.upload_bukti')}}",
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
                    }
                    $('#data-alert-upload').html(response.data)
                    // location.href = "{{route('ecommerce.banner.index')}}"
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });

                this.on("successmultiple", function (files, response) {


                    if (response.status) {
                        setTimeout(function () {
                            $('#modalBayar').modal('hide');
                            window.location.reload(true)
                        }, 1500)
                    }
                    $('#data-alert-upload').html(response.data)
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
    })

</script>
@endpush
