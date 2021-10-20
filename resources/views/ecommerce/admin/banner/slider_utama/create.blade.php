@extends('ecommerce.admin.master')
@section('title', 'Banner')
@section('title-nav', 'Banner')
@section('banner', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -20px;
    }


    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i {
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0, 0, 0, .54);
        font-weight: 500;
        font-size: initial;
        /* text-transform: uppercase; */
    }

    textarea {
        width: 300px;
        height: 150px !important;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('ecommerce.produk.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Slider Utama</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formProduk" method="post" action="{{route('ecommerce.banner.store')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>
                                <input type="hidden" name="status_banner" value="Slider Utama">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama_promo">Nama Promo</label>
                                            <input type="text" class="form-control" required id="nama_promo"
                                                name="nama_promo" value="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_mulai">Promo Mulai</label>
                                            <input type="date" class="form-control" required id="promo_mulai"
                                                name="promo_mulai" value="{{old('promo_mulai')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_berakhir">Promo Berakhir</label>
                                            <input type="date" class="form-control" required id="promo_berakhir"
                                                name="promo_berakhir" value="{{old('promo_berakhir')}}">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File Gambar Promo</label>

                                        </div>
                                        <div id="dropzoneDragArea" class="dropzone" style="margin-top: -20px">
                                            <div class="dz-message d-flex flex-column">
                                                <i class="ri-file-upload-line"></i>
                                                Seret Gambar disini
                                                <br>
                                                Maksimal Ukuran File 5 MB dan berekstensi .jpeg/ .jpg/ .png
                                                <br>
                                                Resolusi 1200 x 500 pixel
                                                <div class="dropzone-previews"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="syarat">Syarat dan Ketentuan</label>
                                            <textarea class="form-control" id="syarat" name="syarat"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('ecommerce.produk.index')}}">Batal</a>
                                        <button type="submit" class="btn btn-primary btnmasuk"
                                            id="submit-all">Simpan</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

@endsection
@push('scripts')
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }
            $('#barang').select2()
            $('#promo').select2()
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            let token = $('meta[name="csrf-token"]').attr('content');

            var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('ecommerce.banner.store')}}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            dictRemoveFile:"Hapus Gambar",
            params: {
                _token: token
            },
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;
                var formUpload = new FormData();
                //form submission code goes here
                document.getElementById("submit-all").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    console.log(myDropzone.files);

                    for (let index = 0; index < myDropzone.files.length; index++) {
                        const element = myDropzone.files[index];
                        var imagename = element.name.split('.').pop().toLowerCase();
                        if($.inArray(imagename,  ['png','jpg','jpeg']) == -1){
                            var dataalert = '<div class="alert alert-danger" role="alert"> Tipe gambar wajib png, jpg, jpeg</div>'
                            $('#data-alert').html(dataalert)
                            return false;
                        }
                    }

                    if(myDropzone.files.length > 1){
                        var dataalert = '<div class="alert alert-danger" role="alert"> Gambar maksimal 1</div>'
                        $('#data-alert').html(dataalert)
                        return false;
                    }

                    if(myDropzone.files.length){
                        myDropzone.processQueue();
                    }else{
                        var dataalert = '<div class="alert alert-danger" role="alert"> Gambar wajib diisi</div>'
                        $('#data-alert').html(dataalert)
                    }

                });
                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#formProduk').serializeArray();
                    $.each(data, function(key, el) {
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

                this.on("success", function(files, response) {

                    if(response.status){
                        window.location.href="{{route('ecommerce.banner.index')}}"
                    }else{
                        $('#data-alert').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.produk.index')}}"
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                });

                this.on("successmultiple", function(files, response) {
                    console.log(response);

                    if(response.status){
                        window.location.href="{{route('ecommerce.banner.index')}}"
                    }else{
                        $('#data-alert').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.produk.index')}}"
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                });

                this.on("errormultiple", function(files, response) {
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error

                });
            }
	        });



     })
</script>
@endpush
