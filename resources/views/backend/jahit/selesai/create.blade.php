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
            <h1 class="ml-2">Input Data | Selesai</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('jahit.store')}}" novalidate method="post">

                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="jahitan selesai">
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
                                                        {{$item->potong->bahan->kode_transaksi}}
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
                                                <input type="number" class="form-control" required
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
                                                <input type="number" class="form-control" required
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
                                                <label for="keterangan_direpair">Keterangan Direpair</label>
                                                <textarea class="form-control" id="keterangan_direpair"
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
                                            <textarea class="form-control" id="keterangan_dibuang"
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
            //   $('#ukuranm').hide()
            //   $('#ukuranl').hide()
            //   $('#ukuranxl').hide()
            //   $('#ukuranxxl').hide()
            //   $('#ukurandirepairm').hide()
            //   $('#ukurandirepairl').hide()
            //   $('#ukurandirepairxl').hide()
            //   $('#ukurandirepairxxl').hide()
            //   $('#ukurandibuangm').hide()
            //   $('#ukurandibuangl').hide()
            //   $('#ukurandibuangxl').hide()
            //   $('#ukurandibuangxxl').hide()
              $('#iddatavendor').hide()
              $('#idhargavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#datahapus').hide()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')


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
                   }
               })

              $('#berhasil_jahit').on('keyup', function(){
                  var data = $(this).val()
                var jumlah_bahan = $('#jumlah_bahan').val()

                if(data <= jumlah_bahan){
                    var res = jumlah_bahan -  data;
                    $('#gagal_jahit').val(res)
                }else{
                    $('#gagal_jahit').val(0)
                }
              })

            // $(document).on('click','#btnsize', function(){
            //     var ukuranm = $('#ukuranm').is(':visible')
            //     var ukuranl = $('#ukuranl').is(':visible')
            //     var ukuranxl = $('#ukuranxl').is(':visible')
            //     var ukuranxxl = $('#ukuranxxl').is(':visible')

            //     if(!ukuranm){
            //         $('#datahapus').show()
            //         $('#ukuranm').show()
            //         $('#ukurandirepairm').show()
            //         $('#ukurandibuangm').show()
            //         return false;
            //     }else if(!ukuranl){
            //         $('#ukuranl').show()
            //         $('#ukurandirepairl').show()
            //         $('#ukurandibuangl').show()
            //         return false;
            //     }else if(!ukuranxl){
            //         $('#ukuranxl').show()
            //         $('#ukurandirepairxl').show()
            //         $('#ukurandibuangxl').show()
            //         return false;
            //     }else if(!ukuranxxl){
            //         $('#ukuranxxl').show()
            //         $('#ukurandirepairxxl').show()
            //         $('#ukurandibuangxxl').show()
            //         return false;
            //     }
            // })


            // $(document).on('click','#btnhapus', function(){
            //     var ukuranm = $('#ukuranm').is(':visible')
            //     var ukuranl = $('#ukuranl').is(':visible')
            //     var ukuranxl = $('#ukuranxl').is(':visible')
            //     var ukuranxxl = $('#ukuranxxl').is(':visible')

            //     if(ukuranxxl){
            //         $('#ukuranxxl').hide()
            //         $('#ukurandirepairxxl').hide()
            //         $('#ukurandibuangxxl').hide()
            //         $('#jumlahxxl').val('')
            //         $('#jumlahdirepairxxl').val('')
            //         $('#jumlahdibuangxxl').val('')

            //         return false;
            //     }else if(ukuranxl){
            //         $('#ukuranxl').hide()
            //         $('#ukurandirepairxl').hide()
            //         $('#ukurandibuangxl').hide()
            //         $('#jumlahxl').val('')
            //         $('#jumlahdirepairxl').val('')
            //         $('#jumlahdibuangxl').val('')
            //         return false;
            //     }else if(ukuranl){
            //         $('#ukuranl').hide()
            //         $('#ukurandirepairl').hide()
            //         $('#ukurandibuangl').hide()
            //         $('#jumlahl').val('')
            //         $('#jumlahdirepairl').val('')
            //         $('#jumlahdibuangl').val('')
            //         return false;
            //     }else if(ukuranm){
            //         $('#ukuranm').hide()
            //         $('#ukurandirepairm').hide()
            //         $('#ukurandibuangm').hide()
            //         $('#datahapus').hide()
            //         $('#jumlahm').val('')
            //         $('#jumlahdirepairm').val('')
            //         $('#jumlahdibuangm').val('')
            //         return false;
            //     }
            // })

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

                                $('#sku_keluar').val(bahan.sku)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)
                                $('#vendor_jahit').val(data.vendor)
                                $('#jumlah_bahan').val(data.jumlah_bahan)
                                $('#berhasil_jahit').prop('max',data.jumlah_bahan)
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
                                content += ' <label for="ukurandirepair" class="text-dark">Ukuran yang Direpair</label>'
                                detail_jahit.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandirepair[]" value="'+result.size+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.size+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdirepair" name="jumlahdirepair[]" >'+
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
                                detail_jahit.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandibuang[]" value="'+result.size+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.size+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdibuang" name="jumlahdibuang[]" >'+
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