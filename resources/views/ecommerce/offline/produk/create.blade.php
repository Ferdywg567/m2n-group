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
            <h1 class="ml-2">Input Data | Produk</h1>
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
                                                name="kode_produk" value="{{$kode}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang">Plih Barang</label>
                                            <select class="form-control" id="barang" name="barang">
                                                <option value="">Pilih Barang</option>
                                                @forelse ($produk as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->finishing->cuci->jahit->potong->bahan->kode_transaksi}} |
                                                    {{$item->finishing->cuci->jahit->potong->bahan->nama_bahan}}
                                                </option>
                                                @empty

                                                @endforelse

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_sku">Kode Sku</label>
                                            <input type="text" class="form-control" readonly required id="kode_sku"
                                                name="kode_sku" value="{{old('kode_sku')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna" value="{{old('warna')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" readonly required id="stok"
                                                name="stok" value="{{old('stok')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" class="form-control" readonly required id="ukuran"
                                                name="ukuran" value="{{old('ukuran')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga">Harga / Seri</label>
                                            <input type="text" class="form-control" required readonly id="harga"
                                                name="harga">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="promo">Promo Terpasang</label>
                                            <select class="form-control" id="promo" name="promo">
                                                <option value="0" data-promo="0">Tidak Ada Promo</option>

                                                @forelse ($promo as $item)
                                                <option value="{{$item->id}}" data-promo="{{$item->potongan}}">
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
                                                name="harga_promo">
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
            url: "{{ route('ecommerce.produk.store')}}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
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

                this.on("successmultiple", function(files, response) {
                    console.log(response);

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

                });
            }
	        });


            $('#barang').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('ecommerce.produk.getdetail')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);

                                var data = response.data;
                                var bahan = data.finishing.cuci.jahit.potong.bahan
                                // var cuci = data.cuci
                                // var detail_finish = data.detail_finish
                                // var finish_retur = data.finish_retur
                                // var finish_dibuang = data.finish_dibuang
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                var sub_kategori = bahan.detail_sub.sub_kategori.nama_kategori
                                var detail_sub_kategori = bahan.detail_sub.nama_kategori
                                var detail = data.detail_warehouse;
                                var jumlah = 0;
                                var ukuran = "";
                                for (let index = 0; index < detail.length; index++) {
                                    const element = detail[index];
                                    jumlah = jumlah + parseInt(element.jumlah)
                                    ukuran += element.ukuran + ", ";

                                }

                                ukuran =  ukuran.replace(/,\s*$/, "");
                                $('#kode_sku').val(bahan.sku)
                                $('#warna').val(bahan.warna)
                                $('#harga').val(data.harga_produk)
                                $('#harga_promo').val(data.harga_produk)
                                $('#stok').val(jumlah)
                                $('#ukuran').val(ukuran)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(sub_kategori)
                                $('#detail_sub_kategori').val(detail_sub_kategori)
                                // $('#no_surat').val(data.no_surat)
                                // $('#nama_bahan').val(bahan.nama_bahan)
                                // $('#jenis_bahan').val(bahan.jenis_bahan)
                                // $('#warna_baju_keluar').val(bahan.warna)
                                // $('#siap_jual').val(data.barang_lolos_qc)




                            }

                        })
                    }
            })

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
