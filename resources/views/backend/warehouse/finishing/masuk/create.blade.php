@extends('backend.master')

@section('title', 'Sortir')
@section('title-nav', 'Sortir')
@section('finishing', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .left {
        text-align: left;
    }
</style>
<style>
    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.finishing.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Produk Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.finishing.store')}}"  method="post">

                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="finishing masuk">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanselectkeluar">
                                                <select class="form-control" id="kode_transaksiselectkeluar"
                                                    name="kode_transaksi">
                                                    <option value="">Pilih Kode Transaksi</option>
                                                    @forelse ($rekap as $item)
                                                        <option value="{{$item->id}}">{{$item->jahit->potong->bahan->kode_transaksi}}</option>
                                                    @empty

                                                    @endforelse


                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" required id="no_surat" readonly
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Barang Masuk</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_mulai_sortir">Tanggal Mulai Sortir</label>
                                            <input type="date" class="form-control" required id="tanggal_mulai_sortir"
                                                name="tanggal_mulai_sortir">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                name="nama_produk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required id="jenis_kain"
                                                name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_siap_qc">Stok Siap Sortir</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="barang_siap_qc" name="barang_siap_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="title-ukuran">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran Yang Dijahit</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="data-ukuran">

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.finishing.index')}}">Batal</a>

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
            //   $('#ukurandireturm').hide()
            //   $('#ukurandireturl').hide()
            //   $('#ukurandireturxl').hide()
            //   $('#ukurandireturxxl').hide()
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
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksiselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#title-ukuran').hide()

              $('#vendor_jahit').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#iddatavendor').show()

                  }else{
                    $('#iddatavendor').hide()

                  }
               })

               $('#barang_lolos_qc').on('keyup', function(){
                   var nilai = $(this).val()
                   var siap = $('#barang_siap_qc').val()
                   nilai = parseInt(nilai)
                   siap = parseInt(siap)
                   if(nilai > 0 && siap > 0 && siap >= nilai){
                        var res =siap-nilai;
                        console.log(res);
                        $('#gagal_qc').val(res)
                   }
               })

               $('#barang_diretur').on('keyup', function(){
                   var nilai = $(this).val()
                   var dibuang = $('#gagal_qc').val()
                   nilai = parseInt(nilai)
                   dibuang = parseInt(dibuang)
                   if(nilai > 0 && dibuang > 0 && dibuang >= nilai){
                        var res =dibuang-nilai;
                        console.log(res);
                        $('#barang_dibuang').val(res)
                   }
               })

              $('#berhasil_jahit').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })

            // $(document).on('click','#btnsize', function(){
            //     var ukuranm = $('#ukuranm').is(':visible')
            //     var ukuranl = $('#ukuranl').is(':visible')
            //     var ukuranxl = $('#ukuranxl').is(':visible')
            //     var ukuranxxl = $('#ukuranxxl').is(':visible')

            //     if(!ukuranm){
            //         $('#ukuranm').show()
            //         $('#ukurandireturm').show()
            //         $('#ukurandibuangm').show()
            //         return false;
            //     }else if(!ukuranl){
            //         $('#ukuranl').show()
            //         $('#ukurandireturl').show()
            //         $('#ukurandibuangl').show()
            //         return false;
            //     }else if(!ukuranxl){
            //         $('#ukuranxl').show()
            //         $('#ukurandireturxl').show()
            //         $('#ukurandibuangxl').show()
            //         return false;
            //     }else if(!ukuranxxl){
            //         $('#ukuranxxl').show()
            //         $('#ukurandireturxxl').show()
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
                            url:"{{route('warehouse.finishing.getdatarekap')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;

                                var bahan = data.jahit.potong.bahan
                                var detail_cuci = data.detail_cuci
                                $('#sku').val(bahan.sku)
                                $('#no_surat').val(data.no_surat)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain').val(bahan.jenis_bahan)
                                $('#warna').val(bahan.warna)
                                $('#tanggal_masuk').val(bahan.tanggal_masuk)
                                $('#barang_siap_qc').val(data.berhasil_cuci)
                                var content="";
                                detail_cuci.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="ukuran[]" value="'+result.size+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.size+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlah" name="jumlah[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                $('#title-ukuran').show()
                                $('#data-ukuran').html(content)
                            }

                        })
                    }
            })


     })
</script>
@endpush
