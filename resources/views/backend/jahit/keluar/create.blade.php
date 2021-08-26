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
                        <form action="{{route('jahit.store')}}" novalidate method="post">

                            <div class="card-body">
                                @include('backend.include.alert')
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
                                                        {{$item->potong->bahan->kode_transaksi}}
                                                    </option>
                                                    @empty

                                                    @endforelse


                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control"  required id="no_surat_keluar"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_keluar">Tanggal Selesai Jahit</label>
                                            <input type="date" class="form-control" readonly required
                                                id="tanggal_selesai_keluar" name="tanggal_selesai">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor_jahit">Vendor Jahit</label>
                                            <input type="text" class="form-control" readonly required id="vendor_jahit"
                                            name="vendor_jahit">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row" id="iddatavendor">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_pembayaran">Status Pembayaran</label>
                                            <select class="form-control" id="status_pembayaran"
                                                name="status_pembayaran">
                                                <option value="lunas">Lunas</option>
                                                <option value="belum">Belum</option>

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
                                            <label for="harga_vendor_keluar">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" required
                                                        id="harga_vendor_keluar" name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="/ lusin" readonly class="form-control"
                                                        required id="lusin" name="lusin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_jahit">Berhasil Jahit</label>
                                            <input type="number" class="form-control" required id="berhasil_jahit"
                                                name="berhasil_jahit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" readonly class="form-control" required id="konversi"
                                                name="konversi">
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin-bottom: -30px">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control" required id="jumlahs" value="0"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control" required id="jumlahm" value="0"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control" required id="jumlahl" value="0"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control" required id="jumlahxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control" required id="jumlahxxl"
                                                name="jumlah[]">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gagal_jahit">Gagal Jahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="gagal_jahit"
                                                    name="gagal_jahit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_direpair">Barang Akan Direpair</label>
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

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang di repair</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="S">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairs">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdirepairs" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandirepairm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="M">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairm">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdirepairm" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandirepairl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="L">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairl">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdirepairl" name="jumlahdirepair[]">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_direpair">Keterangan Barang Direpair</label>
                                            <textarea class="form-control" id="keterangan_direpair"
                                                name="keterangan_direpair" rows="3"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Barang Akan Dibuang</label>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang di buang</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdibuangs" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdibuangm" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl">
                                                    <input type="number" min="0" class="form-control" required value="0"
                                                        id="jumlahdibuangl" name="jumlahdibuang[]">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Barang Dibuang</label>
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
                                $('#sku_keluar').val(bahan.sku)
                                $('#vendor_jahit').val(data.vendor)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)
                                $('#tanggal_jahit').val(data.tanggal_jahit)

                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)
                            }

                        })
                    }
            })


     })
</script>
@endpush
