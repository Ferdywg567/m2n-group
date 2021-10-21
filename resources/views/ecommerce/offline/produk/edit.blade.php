@extends('ecommerce.offline.master')
@section('title', 'Produk')
@section('title-nav', 'Produk')
@section('produk', 'class=active-sidebar')
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

    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('ecommerce.produk.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Edit Data | Produk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formProduk" method="post" action="{{route('ecommerce.produk.store')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_produk">Kode Produk</label>
                                            <input type="text" class="form-control" readonly required id="kode_produk"
                                                name="kode_produk" value="{{$produk->kode_produk}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_sku">Kode Sku</label>
                                            <input type="text" class="form-control" readonly required id="kode_sku"
                                                name="kode_sku" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->warna}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                name="kategori" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                name="sub_kategori" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori" value="{{$produk->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->nama_kategori}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" readonly required id="stok"
                                                name="stok" value="{{$produk->stok}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" class="form-control" readonly required id="ukuran"
                                                name="ukuran" value="{{$ukuran}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga">Harga / Seri</label>
                                            <input type="text" class="form-control" required readonly id="harga"
                                                name="harga" value="{{$produk->harga}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="promo">Promo Terpasang</label>
                                            <select class="form-control" id="promo" name="promo">
                                                <option value="0" data-promo="0" @if($produk->promo_id==null) selected
                                                    @endif >Tidak Ada Promo</option>

                                                @forelse ($promo as $item)
                                                <option value="{{$item->id}}" data-promo="{{$item->potongan}}"
                                                    @if($produk->promo_id==$item->id) selected @endif>
                                                    {{$item->nama}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga_promo">Harga Setelah Promo</label>
                                            <input type="text" class="form-control" required readonly id="harga_promo"
                                                name="harga_promo" value="{{$produk->harga_promo}}">
                                        </div>
                                    </div>
                                </div>
                                <div id="dropzoneDragArea" class="dropzone">
                                    <div class="dz-message d-flex flex-column">
                                        <i class="ri-file-upload-line"></i>
                                        Seret Gambar disini

                                        <div class="dropzone-previews"></div>
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi_produk">Deskripsi Produk</label>
                                            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk"
                                                rows="3">{{$produk->deskripsi_produk}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('ecommerce.produk.index')}}">Batal</a>
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
            var id = "{{$produk->id}}"
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{route('ecommerce.produk.updatedata')}}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
            dictRemoveFile:"Hapus Gambar",
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            params: {
                _token: token,
                id:id
            },
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;
                var formUpload = new FormData();
                var oldimage = []

                //get detail
                var jumlahfile= [];
                $.ajax({
                    url:"{{route('ecommerce.produk.getdetailimage')}}",
                    method:"GET",
                    async:false,
                    data:{
                        'id':"{{$produk->id}}"
                    },
                    success:function(response){
                        if(response.status){
                            $.each(response.data, function (key, value) {
                                var mockfile = {name:value.filename, size:1024}
                                myDropzone.displayExistingFile(mockfile, "{{asset('uploads/images/produk/')}}/"+value.filename)
                                mockfile.previewElement.classList.add('dz-success');
                                mockfile.previewElement.classList.add('dz-complete');
                                jumlahfile.push(key)
                             })
                        }
                    }
                })

                //form submission code goes here
                document.getElementById("submit-all").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();

                    for (let index = 0; index < myDropzone.files.length; index++) {
                        const element = myDropzone.files[index];
                        var imagename = element.name.split('.').pop().toLowerCase();
                        if($.inArray(imagename,  ['png','jpg','jpeg']) == -1){
                            var dataalert = '<div class="alert alert-danger" role="alert"> Tipe gambar wajib png, jpg, jpeg</div>'
                            $('#data-alert').html(dataalert)
                            return false;
                        }
                    }
                    if(myDropzone.files.length && jumlahfile.length > 0){
                        myDropzone.processQueue();
                    }else if(jumlahfile.length > 0){
                        var data = $('#formProduk').serializeArray();
                            $.each(data, function(key, el) {
                                formUpload.append(el.name, el.value)
                            });
                        formUpload.append("oldimage",oldimage)
                        formUpload.append("id",id)
                            $.ajax({
                                url: "{{route('ecommerce.produk.updatedata')}}",
                                method:"POST",
                                data:formUpload,
                                processData: false,
                                contentType: false,
                                headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success:function(response){
                                    if(response.status){
                                        window.location.href="{{route('ecommerce.produk.index')}}"
                                    }else{
                                        $('#data-alert').html(response.data)
                                    }
                                }
                            })
                    }else if(myDropzone.files.length){
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
                    formData.append("oldimage",oldimage)
                });
                this.on("queuecomplete", function () {

                });

                this.on("removedfile", function (file) {
                    oldimage.push(file.name)
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                // this.on("sendingmultiple", function() {
                // // Gets triggered when the form is actually being sent.
                // // Hide the success button or the complete form.

                //      formUpload.append("promo", "assssae");
                // });

                this.on("success", function(files, response) {
                    // console.log(response);

                    if(response.status){
                        window.location.href="{{route('ecommerce.produk.index')}}"
                    }else{
                        $('#data-alert').html(response.data)
                    }
                    // location.href = "{{route('ecommerce.produk.index')}}"
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                });


                this.on("successmultiple", function(files, response) {
                    // console.log(response);

                    if(response.status){
                        window.location.href="{{route('ecommerce.produk.index')}}"
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
                console.log(response);
                });
            }
	        });




            function hitung_promo(harga, promo){
                var hitung = harga*(promo/100);
                var res = harga - hitung;
                return res;
            }

            $("#promo").on('change',function () {
                var harga = $('#harga').val()
                var promo = $(this).find(':selected').data('promo')
                var res = hitung_promo(harga, promo);
                $('#harga_promo').val(res)
             })
     })
</script>
@endpush
