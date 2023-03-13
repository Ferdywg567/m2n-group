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
</style>
<style>
    textarea {
        width: 300px;
        height: 150px !important;
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
                        <form action="{{route('jahit.storeselesai',[$jahit->id])}}" method="POST" id="formJahit">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <div class="alert" role="alert" id="dataalert">

                                </div>

                                <input type="hidden" name="status" value="jahitan selesai">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <div id="kdbahankeluar">
                                                <input type="text" class="form-control"
                                                    value="{{$jahit->potong->bahan->kode_transaksi}}" readonly
                                                    id="kode_transaksi" name="kode_transaksi">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$jahit->no_surat}}"
                                                readonly required id="no_surat_keluar" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                value="{{$jahit->potong->bahan->nama_bahan}}" name="nama_produk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                value="{{$jahit->potong->bahan->sku}}" name="sku">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                value="{{$jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="vendor_jahit">Vendor Jahit</label>
                                            <input type="text" class="form-control" required readonly id="vendor_jahit"
                                                value="{{$jahit->vendor}}" name="vendor_jahit">

                                        </div>
                                    </div>
                                </div>
                                @if ($jahit->vendor=='eksternal')
                                <div class="row" id="iddatavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" id="nama_vendor" readonly
                                                value="{{$jahit->nama_vendor}}" name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{$jahit->harga_vendor}}" id="harga_vendor"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="/ lusin" readonly class="form-control"
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bahan">Jumlah Bahan yang Dijahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required readonly
                                                    value="{{$jahit->jumlah_bahan}}" id="jumlah_bahan"
                                                    name="jumlah_bahan">
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
                                                    value="{{$jahit->berhasil}}" id="berhasil_jahit" max="{{$jahit->jumlah_bahan}}"
                                                    name="berhasil_jahit">
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
                                                    value="{{$jahit->gagal_jahit}}" id="gagal_jahit" name="gagal_jahit">
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
                                                    value="{{$jahit->barang_direpair}}" id="barang_direpair"
                                                    name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="ukurandirepair" class="text-dark">Ukuran yang Diperbaiki</label>
                                <div class="row">

                                    @forelse ($jahit->detail_jahit as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandirepair[]" value="{{$item->size}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->size}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlahdirepair"
                                                name="jumlahdirepair[]" >
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 6 ==0)
                                </div>
                                <div class="row">
                                    @endif
                                    @empty

                                    @endforelse

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_direpair">Keterangan Diperbaiki</label>
                                            <textarea class="form-control" id="keterangan_direpair"
                                                name="keterangan_direpair"
                                                rows="3">{{$jahit->keterangan_direpair}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="barang_dibuang">Jumlah Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" readonly required
                                                    value="{{$jahit->barang_dibuang}}" id="barang_dibuang"
                                                    name="barang_dibuang">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <label for="ukurandibuang" class="text-dark">Ukuran yang Dibuang</label>
                                <div class="row">

                                    @forelse ($jahit->detail_jahit as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukurandibuang[]" value="{{$item->size}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->size}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlahdibuang"
                                                name="jumlahdibuang[]" >
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 6 ==0)
                                </div><div class="row">
                                    @endif
                                    @empty

                                    @endforelse

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Dibuang</label>
                                            <textarea class="form-control" id="keterangan_dibuang"
                                                name="keterangan_dibuang"
                                                rows="6">{{$jahit->keterangan_dibuang}}</textarea>
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
              $('#idhargavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#datahapus').hide()
              $('#dataalert').hide()
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
                if( parseInt(berhasil_jahit) >  parseInt(jumlah_bahan) ){
                    $('#dataalert').addClass('alert-danger')
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah Berhasil Jahit tidak boleh melebihi Jumlah Bahan yang Dijahit')
                    return false;
                }else if(parseInt(jumlahdirepair) != parseInt(hasil)){
                    $('#dataalert').addClass('alert-danger')
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran perbaikan harus sesuai dengan jumlah perbaikan')
                    return false;
                }else if(parseInt(jumlahdibuang) != parseInt(barang_dibuang)){
                    $('#dataalert').addClass('alert-danger')
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
                   if(nilai == 0){
                    $('#barang_dibuang').val(gagal)
                   }else{
                    if(nilai > 0 && gagal > 0 && gagal >= nilai){
                        var res =gagal-nilai;
                        console.log(res);
                        $('#barang_dibuang').val(res)
                    }else{
                        $('#barang_dibuang').val(0)
                    }
                   }
               })

            $('#berhasil_jahit').on('keyup', function(){
                var data = parseInt($(this).val())
                var jumlah_bahan = parseInt($('#jumlah_bahan').val())

                if(data <= jumlah_bahan){
                    var res = jumlah_bahan -  data;
                    $('#gagal_jahit').val(res)
                }else{
                    $('#gagal_jahit').val(0)
                }
            })

            $('#harga_vendor').mask('000.000.000.000', {
                reverse: true
            });

     })
</script>
@endpush
