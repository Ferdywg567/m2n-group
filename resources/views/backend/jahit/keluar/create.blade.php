@extends('backend.master')

@section('title', 'Jahit')
@section('title-nav', 'Jahit')
@section('jahit', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }

    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('jahit.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('jahit.store')}}"  method="post" id="formJahit">

                            <div class="card-body">
                                @include('backend.include.alert')
                                <div class="alert alert-danger" role="alert" id="dataalert">

                                </div>
                                @csrf
                                <input type="hidden" name="status" value="jahitan keluar">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanselectkeluar">
                                                <select class="form-control" id="kode_transaksiselectkeluar"
                                                    name="kode_transaksi">
                                                    <option value="">Pilih Kode Transaksi</option>
                                                    @forelse ($keluar as $item)
                                                    <option value="{{$item->id}}">
                                                        {{$item->potong->bahan->kode_transaksi}} |
                                                        {{$item->potong->bahan->nama_bahan}} |
                                                        {{$item->potong->bahan->detail_sub->nama_kategori}}
                                                    </option>
                                                    @empty

                                                    @endforelse


                                                </select>
                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required id="no_surat_keluar"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                name="nama_produk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku">
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="vendor_jahit">Vendor Jahit</label>
                                            <input type="text" class="form-control" required readonly id="vendor_jahit"
                                            name="vendor_jahit">

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="iddatavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control"  id="nama_vendor" readonly
                                                name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly
                                                        id="harga_vendor" name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="/ lusin" readonly class="form-control"
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bahan">Jumlah Bahan yang Dijahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="jumlah_bahan" name="jumlah_bahan">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="berhasil_jahit">Jumlah Berhasil Jahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="berhasil_jahit" name="berhasil_jahit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gagal_jahit">Jumlah Gagal Jahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="gagal_jahit" name="gagal_jahit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="barang_direpair">Jumlah Perbaikan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    id="barang_direpair" name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="data-ukuran-direpair">

                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="keterangan_direpair">Keterangan Diperbaiki</label>
                                                <textarea class="form-control" id="keterangan_direpair" readonly
                                                    name="keterangan_direpair" rows="3"></textarea>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="barang_dibuang">Jumlah Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" readonly required
                                                    id="barang_dibuang" name="barang_dibuang">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="data-ukuran-dibuang">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan  Dibuang</label>
                                            <textarea class="form-control" id="keterangan_dibuang" readonly
                                                name="keterangan_dibuang" rows="6"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('jahit.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary">Simpan</button>

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
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }
              $('#kdbahanreadonly').hide()
              $('#iddatavendor').hide()
              $('#idhargavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#datahapus').hide()
              $('#dataalert').hide()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('form[id=formJahit]').submit(function(){
                var jumlahdirepair =0;
                var jumlahdibuang =0;
                var jumlah_bahan = $("#jumlah_bahan").val()
                var berhasil_jahit = $('#berhasil_jahit').val()
                var barang_dibuang = $('#barang_dibuang').val()
                var hasil = $('#barang_direpair').val()
                $('input[name^="jumlahdirepair"]').each(function() {
                    jumlahdirepair = jumlahdirepair + parseInt($(this).val());
                });
                $('input[name^="jumlahdibuang"]').each(function() {
                    jumlahdibuang = jumlahdibuang + parseInt($(this).val());
                });
                if(parseInt(jumlah_bahan) <= parseInt(berhasil_jahit)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah Berhasil Jahit tidak boleh melebihi Jumlah Bahan yang Dijahit')
                    return false;
                }else if(parseInt(jumlahdirepair) != parseInt(hasil)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran perbaikan harus sesuai dengan jumlah perbaikan')
                    return false;
                }else if(parseInt(jumlahdibuang) != parseInt(barang_dibuang)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran dibuang harus sesuai dengan jumlah dibuang')
                    return false;
                } else{
                    $('#dataalert').hide()
                   return true;
                }
            });

              $('#vendor_jahit').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#iddatavendor').show()

                  }else{
                    $('#iddatavendor').hide()

                  }
               })

               $('#barang_direpair').on('keyup', function(){
                   var nilai = $(this).val()
                   var gagal = $('#gagal_jahit').val()
                   nilai = parseInt(nilai)
                   gagal = parseInt(gagal)
                   if(nilai > 0 && gagal > 0 && gagal >= nilai){
                        var res =gagal-nilai;
                        console.log(res);
                        $('#barang_dibuang').val(res)
                   }else{
                    $('#barang_dibuang').val(0)
                   }
               })

              $('#berhasil_jahit').on('keyup', function(){
                  var data = $(this).val()
                var jumlah_bahan = $('#jumlah_bahan').val()
                data = parseInt(data)
                jumlah_bahan = parseInt(jumlah_bahan)
                if(data <= jumlah_bahan){
                    var res = jumlah_bahan -  data;
                    $('#gagal_jahit').val(res)
                }else{
                    $('#gagal_jahit').val(0)
                }
              })


            $('#kode_transaksiselectkeluar').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('jahit.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var bahan = data.potong.bahan
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                var detail_jahit =data.detail_jahit
                                var jahit_dibuang =data.jahit_dibuang
                                var jahit_direpair =data.jahit_direpair

                                $('#sku_keluar').val(bahan.sku)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)
                                $('#vendor_jahit').val(data.vendor)
                                $('#jumlah_bahan').val(data.jumlah_bahan)
                                $('#gagal_jahit').val(data.gagal_jahit)
                                $('#barang_direpair').val(data.barang_direpair)
                                $('#barang_dibuang').val(data.barang_dibuang)
                                $('#keterangan_dibuang').val(data.keterangan_dibuang)
                                $('#keterangan_direpair').val(data.keterangan_direpair)
                                $('#berhasil_jahit').val(data.berhasil)
                                // $('#berhasil_jahit').prop('max',data.jumlah_bahan)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)

                                if(data.vendor == 'eksternal'){
                                    $('#iddatavendor').show()
                                    $('#nama_vendor').val(data.nama_vendor)
                                    $('#harga_vendor').val(data.harga_vendor)
                                }else{
                                    $('#iddatavendor').hide()
                                }

                                var content="";
                                content += ' <label for="ukurandirepair" class="text-dark">Ukuran yang Diperbaiki</label>'
                                jahit_direpair.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandirepair[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdirepair" readonly value="'+result.jumlah+'" name="jumlahdirepair[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#data-ukuran-direpair').html(content)


                                var content="";
                                content += ' <label for="ukurangdibuang" class="text-dark">Ukuran yang Dibuang</label>'
                                jahit_dibuang.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandibuang[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdibuang" readonly value="'+result.jumlah+'" name="jumlahdibuang[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#data-ukuran-dibuang').html(content)
                            }

                        })
                    }
            })


     })
</script>
@endpush
