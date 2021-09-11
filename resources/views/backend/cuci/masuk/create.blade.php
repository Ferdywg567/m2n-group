@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav{
       margin-left:-25px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.store')}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="cucian masuk">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <select class="form-control" id="kode_transaksiselect"
                                                name="kode_transaksi">
                                                <option value="">Pilih Kode Transaksi</option>
                                                @forelse ($jahit as $item)
                                                <option value="{{$item->id}}">{{$item->potong->bahan->kode_transaksi}}

                                                </option>
                                                @empty

                                                @endforelse


                                            </select>


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" required id="no_surat"
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
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_cuci">Tanggal Cuci</label>
                                            <input type="date" class="form-control" required id="tanggal_cuci"
                                                name="tanggal_cuci">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_cuci">Estimasi Selesai Cuci</label>
                                            <input type="date" class="form-control" required id="estimasi_selesai_cuci"
                                                name="estimasi_selesai_cuci">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_pembayaran">Status Pembayaran</label>
                                            <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                                              <option value="Lunas">Lunas</option>
                                              <option value="Belum Lunas">Belum Lunas</option>
                                              <option value="Termin">Termin</option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" required id="nama_vendor"
                                                name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" required id="harga_vendor"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dicuci">Jumlah Bahan Yang Dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="jumlah_bahan_yang_dicuci" name="jumlah_bahan_yang_dicuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                name="konversi">
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
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Batal</a>

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

              $('#idnamavendor').hide()
              $('#dataukuranall').hide()
              $('#labelukuran').hide()
              $('#datavendor').hide()
              $('#datahapus').hide()
              $('#title-ukuran').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksiselect').select2()



              $('#jumlah_bahan_yang_dicuci').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })



              $(document).on('click','#btnsize', function(){
                var ukuranm = $('#ukuranm').is(':visible')
                var ukuranl = $('#ukuranl').is(':visible')
                var ukuranxl = $('#ukuranxl').is(':visible')
                var ukuranxxl = $('#ukuranxxl').is(':visible')

                if(!ukuranm){
                    $('#ukuranm').show()
                    $('#datahapus').show()
                    return false;
                }else if(!ukuranl){
                    $('#ukuranl').show()

                    return false;
                }else if(!ukuranxl){
                    $('#ukuranxl').show()

                    return false;
                }else if(!ukuranxxl){
                    $('#ukuranxxl').show()

                    return false;
                }
            })

            $(document).on('click','#btnhapus', function(){
                var ukuranm = $('#ukuranm').is(':visible')
                var ukuranl = $('#ukuranl').is(':visible')
                var ukuranxl = $('#ukuranxl').is(':visible')
                var ukuranxxl = $('#ukuranxxl').is(':visible')

                if(ukuranxxl){
                    $('#ukuranxxl').hide()
                    return false;
                }else if(ukuranxl){
                    $('#ukuranxl').hide()
                    return false;
                }else if(ukuranl){
                    $('#ukuranl').hide()
                    return false;
                }else if(ukuranm){
                    $('#ukuranm').hide()
                    $('#datahapus').hide()
                    return false;
                }
            })

             $('#kode_transaksiselect').on('change', function () {
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
                                var detail_jahit = data.detail_jahit
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#sku').val(bahan.sku)
                                $('#nama_produk').val(bahan.nama_bahan)
                                // $('#jenis_kain').val(data.jenis_bahan)
                                // $('#warna').val(data.warna)
                                // $('#vendor_keluar').val(data.vendor)

                                // $('#panjang_kain').val(data.panjang_bahan)
                                $('#jumlah_bahan_yang_dicuci').prop('max',data.berhasil)
                                var content="";
                                detail_jahit.forEach((result, i) => {
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
