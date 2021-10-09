@extends('backend.master')

@section('title', 'Bahan')
@section('title-nav', 'Bahan')
@section('cssnav', 'cssnav')
@section('bahan', 'class=active-sidebar')


@section('content')
<style>
    .cssnav {
        margin-left: -20px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('bahan.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <div class="alert alert-danger" role="alert" id="dataalert">

                            </div>
                            <form  method="post" action="{{route('bahan.store')}}" id="formBahan">
                                @csrf
                                <input type="hidden" name="status" value="bahan keluar">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" value="{{$kode}}" readonly required
                                                id="kode_transaksi" name="kode_transaksi">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <div class="kdbahanselect">
                                                <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                                    <option value="">Pilih Kode Bahan</option>
                                                    @forelse ($masuk as $item)
                                                    <option value="{{$item->id}}">{{$item->kode_bahan}}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" required id="no_surat_keluar"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Bahan</label>
                                            <input type="text" class="form-control" required readonly id="nama_bahan"
                                                name="nama_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" required readonly id="jenis_bahan"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" required readonly id="warna"
                                                name="warna">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor">Vendor</label>
                                            <input type="text" class="form-control" required readonly id="vendor_keluar"
                                                name="vendor">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Bahan Masuk</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">Tanggal Bahan Keluar</label>
                                            <input type="date" class="form-control" required id="tanggal_keluar"
                                                name="tanggal_keluar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_bahan">Panjang Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="panjang_bahan" name="panjang_bahan" readonly>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_bahan_diambil">Panjang Bahan Diambil</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="panjang_bahan_diambil" name="panjang_bahan_diambil" >
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sisa_bahan">Sisa Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="sisa_bahan" name="sisa_bahan" >
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" id="kategori" name="kategori">
                                                <option value="">Pilih Kategori</option>
                                                @forelse ($kategori as $item)
                                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                                @empty

                                                @endforelse
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <select class="form-control" id="sub_kategori" name="sub_kategori">
                                                <option value="">Pilih Sub Kategori</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <select class="form-control" id="detail_sub_kategori" name="detail_sub_kategori">
                                                <option value="">Pilih Detail Sub Kategori</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sku_bahan">SKU Bahan</label>
                                            <input type="text" class="form-control" required readonly id="sku_bahan"
                                                name="sku_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btnmasuk">Simpan</button>

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
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }

              $('#kode_bahanselect').select2()
              $('#kategori').select2()
              $('#sub_kategori').select2()
              $('#detail_sub_kategori').select2()
              $('#sku').select2()
              $('#dataalert').hide()
              $('form[id=formBahan]').submit(function(){
                var bahan = $('#panjang_bahan').val();
                var diambil = $('#panjang_bahan_diambil').val()
                if(parseInt(diambil) > parseInt(bahan)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah bahan diambil harus sesuai dengan panjang bahan')
                    return false;
                }else{
                   return true;
                }
                //add stuff here
            });

              $('#kode_bahanselect').on('change', function () {
                    var id = $(this).find(':selected').val()
                    if(id != ''){
                        $.ajax({
                            url:"{{route('bahan.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {
                            if(response.status){
                                var data = response.data
                                $('#vendor_keluar').val(data.vendor)
                                if(data.sisa_bahan!= null && data.sisa_bahan > 0){
                                    $('#panjang_bahan').val(data.sisa_bahan)
                                }else{
                                    $('#panjang_bahan').val(data.panjang_bahan)
                                }
                                $('#tanggal_masuk').val(data.tanggal_masuk)
                                $('#nama_bahan').val(data.nama_bahan)
                                $('#jenis_bahan').val(data.jenis_bahan)
                                $('#warna').val(data.warna)
                            }
                        })
                    }
            })


            $('#panjang_bahan_diambil').on('keyup keypress', function () {
                    var diambil = $(this).val();
                    var panjang_bahan = $('#panjang_bahan').val()
                    var res = 0
                    if(parseInt(diambil) <= parseInt(panjang_bahan)){
                        res = panjang_bahan - diambil
                    }else{
                        res = panjang_bahan - diambil
                    }
                    $('#sisa_bahan').val(res)
             })


            $('#kategori').on('change', function () {
                var kategori = $(this).val()
                $('#sub_kategori').empty()
                $.ajax({
                    url:"{{route('kategori.getkategori')}}",
                    method:"GET",
                    data:{
                        'kategori':kategori
                    }
                }).done(function (response) {
                     if(response.status){
                         var sku = response.data.sku
                         var sub = response.data.sub_kategori
                         $('#sku_utama').val(sku)
                         $('#sub_kategori').append('<option value="">Pilih Sub Kategori</option>')
                         for (let index = 0; index < sub.length; index++) {
                             const element = sub[index];
                            $('#sub_kategori').append('<option  value="'+element.id+'">'+element.nama_kategori+'</option>')
                         }
                     }
                })
         })



        $('#sub_kategori').on('change', function () {
                var kategori = $(this).val()
                $('#detail_sub_kategori').empty()
                $.ajax({
                    url:"{{route('kategori.getSubKategori')}}",
                    method:"GET",
                    data:{
                        'kategori':kategori
                    }
                }).done(function (response) {
                     if(response.status){
                            var detail_sub = response.data.detail_sub
                            $('#detail_sub_kategori').append('<option value="">Pilih Detail Sub Kategori</option>')
                            for (let index = 0; index < detail_sub.length; index++) {
                                const element = detail_sub[index];
                                $('#detail_sub_kategori').append('<option  value="'+element.id+'">'+element.nama_kategori+'</option>')
                            }
                     }
                })
         })


         $('#detail_sub_kategori').on('change', function () {
                var kategori = $(this).val()
                $.ajax({
                    url:"{{route('kategori.getDetailSubKategori')}}",
                    method:"GET",
                    data:{
                        'kategori':kategori
                    }
                }).done(function (response) {
                     if(response.status){

                          $('#sku_bahan').val(response.data.sku)
                     }
                })
         })

     })
</script>
@endpush
