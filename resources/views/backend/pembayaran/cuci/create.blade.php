@extends('backend.master')

@section('title', 'Pembayaran')
@section('title-nav', 'Pembayaran')
@section('pembayaran', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: 10px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('pembayaran.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Pembayaran Cuci</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('pembayaran.store')}}" method="POST" id="formPembayaran">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <div class="alert" role="alert" id="dataalert">

                                </div>
                                <input type="hidden" name="total_bayar" id="total_bayar" >
                                <input type="hidden" name="status" value="cuci">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <select class="form-control" id="kode_transaksiselect"
                                                name="kode_transaksi">
                                                <option value="">Pilih Kode Transaksi</option>
                                                @forelse ($cuci as $item)
                                                <option value="{{$item->id}}" @if($item->id ==
                                                    old('kode_transaksi')) selected
                                                    @endif>{{$item->jahit->potong->bahan->kode_transaksi}} |
                                                    {{$item->jahit->potong->bahan->nama_bahan}}
                                                </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{old('no_surat')}}" required
                                                id="no_surat" readonly name="no_surat">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                value="{{old('nama_produk')}}" name="nama_produk">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{old('sku')}}" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{old('kategori')}}" name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{old('sub_kategori')}}" name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{old('detail_sub_kategori')}}" id="detail_sub_kategori"
                                                name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly id="nama_vendor"
                                                name="nama_vendor" value="{{old('nama_vendor')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly id="harga_vendor"
                                                        value="{{old('harga_vendor')}}" name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                        id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dicuci">Jumlah Bahan Yang dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" required
                                                    value="{{old('jumlah_bahan_yang_dicuci')}}"
                                                    id="jumlah_bahan_yang_dicuci" readonly
                                                    name="jumlah_bahan_yang_dicuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                value="{{old('konversi')}}" name="konversi">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_harga">Total Harga</label>
                                            <input type="text" class="form-control" required readonly id="total_harga"
                                                value="{{old('total_harga')}}" name="total_harga">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" id="datapembayaran">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required value="{{date('Y-m-d')}}"
                                                readonly id="tanggal" value="{{old('tanggal')}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran1">Pembayaran</label>
                                            <select class="form-control" id="pembayaran1" name="pembayaran1">
                                                <option value="Lunas">Lunas</option>
                                                <option value="Termin 1">Termin 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal1">Nominal</label>
                                            <input type="text" min="1" class="form-control" required id="nominal1"
                                                value="{{old('nominal1')}}" name="nominal1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="datapembayaran2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required value="{{date('Y-m-d')}}"
                                                readonly id="tanggal" value="{{old('tanggal')}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran">Pembayaran</label>
                                            <input type="text" class="form-control" value="Termin 2" readonly
                                                id="pembayaran2" name="pembayaran2">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="text" min="1" class="form-control" id="nominal2"
                                                value="{{old('nominal2')}}" name="nominal2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="datapembayaran3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required value="{{date('Y-m-d')}}"
                                                readonly id="tanggal" value="{{old('tanggal')}}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaran">Pembayaran</label>
                                            <input type="text" class="form-control" value="Termin 3" readonly
                                                id="pembayaran3" name="pembayaran3">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nominal3">Nominal</label>
                                            <input type="text" min="1" class="form-control" id="nominal3"
                                                value="{{old('nominal3')}}" name="nominal3">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                                    Pembayaran Baru</button>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sisa_bayar">Sisa Bayar</label>
                                            <input type="text" class="form-control" readonly required id="sisa_bayar"
                                                value="{{old('sisa_bayar')}}" name="sisa_bayar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('pembayaran.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary btnmasuk">Simpan</button>

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

              var nominal1 = $('#nominal1').val();
                var nominal2 = $('#nominal2').val();
                var nominal3 = $('#nominal3').val();

                  if(nominal1 == ''){
                    $('#nominal1').mask('000.000.000.000', {
                        reverse: true
                    });
                  }
                  if(nominal2 == ''){
                    $('#nominal2').mask('000.000.000.000', {
                        reverse: true
                    });
                  }
                  if(nominal3 == ''){
                    $('#nominal3').mask('000.000.000.000', {
                     reverse: true
                    });
                  }
              $('#kdbahanreadonly').hide()
              $('#ukuranm').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
              $('#dataalert').hide()
              $('#datapembayaran2').hide()
              $('#datapembayaran3').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksiselect').select2()
              $('#title-ukuran').hide()
              $('#jumlah_bahan_yang_dijahit').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })
              $('#nominal1, #nominal2, #nominal3').on('keyup', function () {
                  var nominal1 = $('#nominal1').val();
                  var nominal2 = $('#nominal2').val();
                  var nominal3 = $('#nominal3').val();
                  nominal1 = convertToAngka(nominal1)
                  nominal2 = convertToAngka(nominal2)
                  nominal3 = convertToAngka(nominal3)
                  var total_harga = $('#total_harga').val()
                  total_harga = convertToAngka(total_harga)
                  var sisa_bayar = 0;
                  if(nominal2 > 0 && nominal1 > 0 && nominal3 > 0){
                        var total = parseInt(nominal1) + parseInt(nominal2) + parseInt(nominal3)
                        if(total <= total_harga){
                            sisa_bayar = total_harga - total;
                        }


                    }else if(nominal2 > 0 && nominal1 > 0){
                        var total = parseInt(nominal1) + parseInt(nominal2)
                        if(total <= total_harga){
                            sisa_bayar = total_harga - total;
                        }


                    }else if(nominal1 > 0){
                        if(parseInt(nominal1) <  parseInt(total_harga)){
                            sisa_bayar = total_harga - nominal1;
                        }


                    }
                    console.log(sisa_bayar);
                    $('#sisa_bayar').val("Rp. "+convertToRupiah(sisa_bayar))
               })
               $('form[id=formPembayaran]').submit(function(){
                var data = $('#pembayaran1').val();
                var hasil = $('#total_harga').val()
                var total_bayar = $('#total_bayar').val()
                total_bayar = convertToAngka(total_bayar)
                hasil = convertToAngka(hasil)
                if(data == 'Lunas'){
                    var nominal = $('#nominal1').val()
                    if(parseInt(hasil) != parseInt(nominal)){
                        $('#dataalert').addClass('alert-danger')
                    $('#dataalert').show()
                    $('#dataalert').text('Nominal pembayaran harus sesuai dengan sisa bayar')
                     return false;
                    }else{

                        return true;
                    }
                }else if(data == 'Termin 1'){
                    var nominal = $('#nominal1').val()
                    var nominal2 = $('#nominal2').val()
                    var nominal3 = $('#nominal3').val()
                    if(nominal2 > 0 && nominal > 0 && nominal3 > 0){
                        var total = parseInt(nominal) + parseInt(nominal2) + parseInt(nominal3)
                        if(parseInt(hasil) != parseInt(total)){
                            $('#dataalert').addClass('alert-danger')
                            $('#dataalert').show()
                            $('#dataalert').text('Nominal pembayaran harus sesuai dengan total pembayaran')
                            return false;
                        }else{
                            return true;
                        }
                    }else if(nominal2 > 0 && nominal > 0){
                        var total = parseInt(nominal) + parseInt(nominal2)
                        if(parseInt(total) > parseInt(total_bayar) ){
                            $('#dataalert').addClass('alert-danger')
                            $('#dataalert').show()
                            $('#dataalert').text('Nominal pembayaran harus kurang dari sama dengan total pembayaran')
                            return false;
                        }else{
                            return true;
                        }
                    }else if(nominal > 0){
                        if(parseInt(nominal) > parseInt(total_bayar) ){
                            $('#dataalert').addClass('alert-danger')
                            $('#dataalert').show()
                            $('#dataalert').text('Nominal pembayaran tidak boleh melebihi total pembayaran')
                            return false;
                        }if(parseInt(nominal) <= 0){
                            $('#dataalert').addClass('alert-danger')
                            $('#dataalert').show()
                            $('#dataalert').text('Nominal pembayaran harus lebih dari 0')
                            return false;
                        }else{
                            return true;
                        }
                    }
                }
            });


              $('#hasil_cutting').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })

              $('.btntambah').hide()
              $('#pembayaran1').on('change', function () {
                  var data = $(this).val();

                  if(data == 'Lunas'){
                    $('#datapembayaran2').hide()
                     $('#datapembayaran3').hide()
                     $('.btntambah').hide()
                  }else{
                    $('.btntambah').show()
                  }

              })

              $('.btntambah').on('click', function () {
                var data = $('#pembayaran1').val();
                var datapembayaran2 = $('#datapembayaran2').is(':visible')
                var datapembayaran3 = $('#datapembayaran3').is(':visible')
                if(data != 'Lunas'){
                    if(!datapembayaran2){
                        $('#datapembayaran2').show()
                    }else if(!datapembayaran3){
                        $('#datapembayaran3').show()
                        $('.btntambah').hide()
                    }
                }

            })

            function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++) {
                    if (i%3 == 0) {
                    rupiah += angkarev.substr(i,3)+'.';
                    }
                }

                    var res = rupiah.split('',rupiah.length-1).reverse().join('');
                    return res;
         }

         function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        }


             $('#kode_transaksiselect').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('cuci.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var jahit = data.jahit
                                var bahan = data.jahit.potong.bahan
                                var potong =data.jahit.potong
                                var detail_cuci = data.detail_cuci
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                var total_harga = data.harga_vendor * data.jumlah_bahan;
                                $('#total_harga').val("Rp. "+ convertToRupiah(data.total_harga))
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#nama_vendor').val(data.nama_vendor)
                                $('#harga_vendor').val(data.harga_vendor)
                                $('#sisa_bayar').val("Rp. "+ convertToRupiah(data.sisa_bayar))
                                $('#total_bayar').val(data.sisa_bayar)
                                $('#no_surat').val(data.no_surat)
                                $('#sku').val(bahan.sku)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#jumlah_bahan_yang_dicuci').val(potong.hasil_cutting)
                                $('#konversi').val(data.konversi)

                            }

                        })
                    }
            })



     })
</script>
@endpush
