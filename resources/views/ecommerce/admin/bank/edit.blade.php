@extends('ecommerce.admin.master')
@section('title', 'Bank')
@section('title-nav', 'Bank')
@section('bank', 'class=active-sidebar')
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
            <a class="btn btn-primary" href="{{route('ecommerce.bank.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Bank</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formBank" method="post" action="{{route('ecommerce.bank.updatedata')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>

                                <div class="row">
                                    <input type="hidden" name="id" value="{{$bank->id}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bank">Nama Bank</label>
                                            <input type="text" class="form-control" required id="nama_bank"
                                                name="nama_bank" value="{{$bank->nama_bank}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nomor_rekening">Nomor Rekening</label>
                                            <input type="text" class="form-control" required id="nomor_rekening"
                                                name="nomor_rekening" value="{{$bank->nomor_rekening}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama_penerima">Nama Penerima</label>
                                            <input type="text" class="form-control" required id="nama_penerima"
                                                name="nama_penerima" value="{{$bank->nama_penerima}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File Logo Bank</label>

                                        </div>
                                        <div id="dropzoneDragArea" class="dropzone" style="margin-top: -20px">
                                            <div class="dz-message d-flex flex-column">
                                                <i class="ri-file-upload-line"></i>
                                                Seret Gambar disini
                                                <br>
                                                Maksimal Ukuran File 5 MB dan berekstensi .jpeg/ .jpg/ .png
                                                <br>
                                                <div class="dropzone-previews"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('ecommerce.bank.index')}}">Batal</a>
                                        <button type="submit" class="btn btn-primary btnmasuk"
                                            id="submit-all">Update</button>
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
            var maxImageWidth = 1200, maxImageHeight = 500;
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('ecommerce.bank.updatedata')}}",
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
                    // console.log(myDropzone.files);

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
                        var data = $('#formBank').serialize();
                        ajax()
                        $.ajax({
                            url:"{{route('ecommerce.bank.updatedata')}}",
                            method:"POST",
                            data:data,
                            success:function(response){
                                // console.log(response);
                                if(response.status){
                                    window.location.href="{{route('ecommerce.bank.index')}}"
                                }else{
                                    $('#data-alert').html(response.data)
                                }
                            }
                        })
                    }

                });
                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#formBank').serializeArray();
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
                        window.location.href="{{route('ecommerce.bank.index')}}"
                    }else{
                        $('#data-alert').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.bank.index')}}"
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                });

                this.on("successmultiple", function(files, response) {
                    console.log(response);

                    if(response.status){
                        window.location.href="{{route('ecommerce.bank.index')}}"
                    }else{
                        $('#data-alert').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.banner.index')}}"
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
