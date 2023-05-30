@extends('backend.master')

@section('title', 'Kategori')
@section('title-nav', 'Kategori')
@section('kategori', 'class=active-sidebar')
@section('content')
    <style>
        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;

        }

        .left {
            text-align: left;
        }
    </style>
    <div id="non-printable">
        <section class="section">
            <div class="section-header ">
                <a class="btn btn-primary" href="{{ route('kategori.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="ml-2">Input Kategori</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="#" id="formKategori" method="post">
                                @csrf

                                <div class="card-body">
                                    @include('backend.include.alert')
                                    <input type="hidden" name="status" id="status" value="kategori">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_kategori">Nama Kategori</label>
                                                <input type="text" class="form-control" required id="nama_kategori"
                                                    name="nama_kategori">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <input type="text" class="form-control" required id="sku"
                                                    name="sku">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="file">File Gambar Kategori</label>

                                            </div>
                                            <div id="dropzoneDragArea" class="dropzone" style="margin-top: -20px">
                                                <div class="dz-message d-flex flex-column">
                                                    <i class="ri-file-upload-line"></i>
                                                    Seret Gambar disini
                                                    <br>
                                                    Maksimal Ukuran File 1 MB dan berekstensi .jpeg/ .jpg/ .png
                                                    <br>
                                                    Resolusi 500 x 500
                                                    <br>
                                                    <div class="dropzone-previews"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12 text-center">
                                            <a type="button" class="btn btn-secondary"
                                                href="{{ route('kategori.index') }}">Batal</a>

                                            <button type="button" id="simpan" class="btn btn-primary">Simpan</button>

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
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
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
            var maxImageWidth = 500,
                maxImageHeight = 500;
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('kategori.save_kategori') }}",
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
                init: function() {
                    var myDropzone = this;
                    var formUpload = new FormData();
                    //form submission code goes here
                    document.getElementById("simpan").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        // console.log(myDropzone.files);

                        for (let index = 0; index < myDropzone.files.length; index++) {
                            const element = myDropzone.files[index];
                            var imagename = element.name.split('.').pop().toLowerCase();
                            if ($.inArray(imagename, ['png', 'jpg', 'jpeg']) == -1) {
                                // var dataalert =
                                //     '<div class="alert alert-danger" role="alert"> Tipe gambar wajib png, jpg, jpeg</div>'
                                // $('#data-alert').html(dataalert)
                                Swal.fire({
                                    title: 'Maaf...',
                                    text: "Tipe gambar wajib png, jpg, jpeg",
                                    icon: 'error',
                                    // confirmButtonColor: '#3085d6',
                                    // cancelButtonColor: '#d33',
                                    // confirmButtonText: 'Ya, Simpan Kategori'
                                })
                                return false;
                            }


                        }

                        if (myDropzone.files.length > 1) {
                            var dataalert =
                                '<div class="alert alert-danger" role="alert"> Gambar maksimal 1</div>'
                            $('#data-alert').html(dataalert)
                            return false;
                        }

                        if (myDropzone.files.length) {
                            myDropzone.processQueue();
                        } else {
                            var dataalert =
                                '<div class="alert alert-danger" role="alert"> Gambar wajib diisi</div>'
                            $('#data-alert').html(dataalert)
                        }

                    });
                    this.on('sending', function(file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $('#formKategori').serializeArray();
                        $.each(data, function(key, el) {
                            formData.append(el.name, el.value);
                        });
                    });
                    this.on("queuecomplete", function() {

                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    // this.on("sendingmultiple", function() {
                    // // Gets triggered when the form is actually being sent.
                    // // Hide the success button or the complete form.

                    //      formUpload.append("promo", "assssae");
                    // });

                    this.on("success", function(files, response) {

                        if (response.status) {
                            window.location.href = "{{ route('kategori.index') }}"
                        } else {
                            $('#data-alert').html(response.data)
                        }
                        // location.href = "{{ route('ecommerce.bank.index') }}"
                        // Gets triggered when the files have successfully been sent.
                        // Redirect user or notify of success.
                    });

                    this.on("successmultiple", function(files, response) {
                        console.log(response);

                        if (response.status) {
                            window.location.href = "{{ route('kategori.index') }}"
                        } else {
                            $('#data-alert').html(response.data)
                        }
                        // location.href = "{{ route('ecommerce.banner.index') }}"
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
