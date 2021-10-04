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
                        <form action="{{route('cuci.store')}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="cuci">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <select class="form-control" id="kode_transaksiselect"
                                                name="kode_transaksi">
                                                <option value="">Pilih Kode Transaksi</option>
                                                {{-- @forelse ($datakeluar as $item)
                                                <option value="{{$item->id}}" @if($item->id ==
                                                old('kode_transaksi')) selected
                                                @endif>{{$item->bahan->kode_transaksi}} |
                                                {{$item->bahan->nama_bahan}}
                                                </option>
                                                @empty

                                                @endforelse --}}


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
                                            <label for="jumlah_bahan_yang_dijahit">Jumlah Bahan Yang Dijahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    value="{{old('jumlah_bahan_yang_dijahit')}}"
                                                    id="jumlah_bahan_yang_dijahit" readonly
                                                    name="jumlah_bahan_yang_dijahit">
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
                                            <label for="nominal">Nominal</label>
                                            <input type="number" min="1" class="form-control" required id="nominal"
                                                value="{{old('nominal')}}" name="nominal">
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
                                            <input type="number" min="1" class="form-control" required id="nominal"
                                                value="{{old('nominal')}}" name="nominal">
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
                                            <label for="nominal">Nominal</label>
                                            <input type="number" min="1" class="form-control" required id="nominal"
                                                value="{{old('nominal')}}" name="nominal">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                                    Pembayaran Baru</button>
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
              $('#kdbahanreadonly').hide()
              $('#ukuranm').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
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



              $('#hasil_cutting').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })


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



             $('#kode_transaksiselect').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('potong.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var bahan = data.bahan
                                var detail_potong = data.detail_potong
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;


                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#no_surat').val(data.no_surat)
                                $('#sku').val(bahan.sku)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#jumlah_bahan_yang_dijahit').val(data.hasil_cutting)
                                $('#konversi').val(data.konversi)
                                // var content="";
                                // detail_potong.forEach((result, i) => {
                                //     if(i == 0){
                                //         content+= '<div class="row">'
                                //     }

                                //     content += '<div class="col-md-2">'+
                                //     '<input type="hidden" name="ukuran[]" value="'+result.size+'">'+
                                //     '<div class="input-group mb-2">'+
                                //         '<div class="input-group-prepend">'+
                                //             '<div class="input-group-text">'+result.size+'</div>'+
                                //         '</div>'+
                                //         '<input type="number" class="form-control" required id="jumlah" name="jumlah[]" value="'+result.jumlah+'">'+
                                //     '</div>'+
                                //    '</div>';
                                //     if(i!=0 && i%6 == 0){

                                //         // add end of row ,and start new row on every 5 elements
                                //         content += '</div><div class="row">'
                                //     }
                                // });
                                // $('#title-ukuran').show()
                                // $('#data-ukuran').html(content)

                            }

                        })
                    }
            })



     })
</script>
@endpush
