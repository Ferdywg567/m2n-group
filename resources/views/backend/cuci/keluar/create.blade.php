@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active-sidebar')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.store')}}"  method="post">

                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="cucian keluar">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <div id="kdbahanselectkeluar">
                                                <select class="form-control" id="kode_bahanselectkeluar"
                                                    name="kode_bahan">
                                                    <option value="">Pilih Kode Bahan</option>
                                                    @forelse ($cuci as $item)
                                                    <option value="{{$item->id}}">{{$item->jahit->potong->bahan->kode_bahan}}
                                                        |
                                                        {{$item->jahit->potong->bahan->nama_bahan}}
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
                                            <input type="text" class="form-control" required id="no_surat_keluar"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_keluar">Tanggal Selesai</label>
                                            <input type="date" class="form-control"  required
                                                id="tanggal_selesai_keluar" name="tanggal_selesai">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor_cuci">Vendor Cuci</label>
                                            <select class="form-control" id="vendor_cuci" name="vendor_cuci">
                                                <option value="internal" selected>Internal</option>
                                                <option value="eksternal">Eksternal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="idnamavendor">
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
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_cuci">Berhasil Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="berhasil_cuci"
                                                    name="berhasil_cuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi</label>
                                            <input type="text" readonly class="form-control" required id="konversi"
                                                name="konversi">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jumlahs">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control"  id="jumlahs"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="jumlahm">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control"  id="jumlahm"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="jumlahl">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control"  id="jumlahl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="jumlahxl">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control"  id="jumlahxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="jumlahxxl">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control"  id="jumlahxxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-1" id="datahapus">
                                        <div class="form-group" style="margin-top: 30px">
                                            <button type="button" class="btn btn btn-outline-danger" id="btnhapus">Hapus
                                                Size</button>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top: 30px">
                                            <button type="button" class="btn btn-outline-primary" id="btnsize">Tambah
                                                Size</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kain_gagal_cuci">Kain Gagal Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="kain_gagal_cuci"
                                                    name="kain_gagal_cuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="barang_direpair">Barang Direpair</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="barang_direpair"
                                                    name="barang_direpair">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="barang_dibuang">Barang Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="barang_dibuang"
                                                    name="barang_dibuang">
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
                                                    <label for="barang_akan_direpair">Barang Akan Direpair</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" required
                                                            id="barang_akan_direpair" name="barang_akan_direpair">
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

                                            <div class="col-md-2">

                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="S">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairs">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdirepairs" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandirepairm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="M">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairm">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdirepairm" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandirepairl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="L">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdirepairl" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandirepairxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XL</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="XL">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairxl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdirepairxl" name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandirepairxxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XXL</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="XXL">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairxxl">
                                                    <input type="text" min="0" class="form-control" required
                                                        id="jumlahdirepairxxl" name="jumlahdirepair[]">
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
                                                    <label for="barang_akan_dibuang">Barang Akan Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" readonly required
                                                            id="barang_akan_dibuang" name="barang_akan_dibuang">
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

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdibuangs" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdibuangm" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdibuangl" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandibuangxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XL</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="XL">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangxl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdibuangxl" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandibuangxxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XXL</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="XXL">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangxxl">
                                                    <input type="text" min="0" class="form-control" required
                                                        id="jumlahdibuangxxl" name="jumlahdibuang[]">
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
              $('#ukuranm').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
              $('#ukurandirepairm').hide()
              $('#ukurandirepairl').hide()
              $('#ukurandirepairxl').hide()
              $('#ukurandirepairxxl').hide()
              $('#ukurandibuangm').hide()
              $('#ukurandibuangl').hide()
              $('#datahapus').hide()
              $('#ukurandibuangxl').hide()
              $('#ukurandibuangxxl').hide()
              $('#idnamavendor').hide()
              $('#idhargavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('#idpembayaran').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#cuciMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#cuciMasukLabel').text('Input Data [cuci Masuk]')
                $('#alert-cuci-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('.btnmasuk').show()
                $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#datavendor').hide()
              });

              $('#cuciKeluar').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#cuciKeluarLabel').text('Input Data [cuci Keluar]')
                $('#alert-cuci-keluar').empty()
                $('.btnkeluar').prop('id','btnsimpankeluar')
                $('#kdbahanselectkeluar').show()
                $('#kdbahankeluar').hide()
                $('.btnkeluar').show()

                $('#ukuranm').hide()
                $('#ukuranl').hide()
                $('#ukuranxl').hide()
                $('#ukuranxxl').hide()
                $('#jumlahs').prop('readonly', false)
                $('#jumlahm').prop('readonly', false)
                $('#jumlahl').prop('readonly', false)
                $('#jumlahxl').prop('readonly', false)
                $('#jumlahxxl').prop('readonly', false)
                $('#tanggal_keluar').prop('readonly', false)
                $('#no_surat_keluar').prop('readonly', false)
                $('#hasil_cutting').prop('readonly', false)
              });


              $('#vendor_cuci').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#idnamavendor').show()
                    $('#idpembayaran').show()
                    $('#idhargavendor').show()
                  }else{
                    $('#idnamavendor').hide()
                    $('#idhargavendor').hide()
                    $('#idpembayaran').hide()
                  }
               })

               $('#barang_akan_direpair').on('keyup', function(){
                   var nilai = $(this).val()
                   var dibuang = $('#barang_dibuang').val()
                   nilai = parseInt(nilai)
                   dibuang = parseInt(dibuang)
                   if(nilai > 0 && dibuang > 0 && dibuang >= nilai){
                        var res =dibuang-nilai;

                        $('#barang_akan_dibuang').val(res)
                   }
               })

              $('#berhasil_cuci').on('keyup', function(){
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
                    $('#datahapus').show()
                    $('#ukuranm').show()
                    $('#ukurandirepairm').show()
                    $('#ukurandibuangm').show()
                    return false;
                }else if(!ukuranl){
                    $('#ukuranl').show()
                    $('#ukurandirepairl').show()
                    $('#ukurandibuangl').show()
                    return false;
                }else if(!ukuranxl){
                    $('#ukuranxl').show()
                    $('#ukurandirepairxl').show()
                    $('#ukurandibuangxl').show()
                    return false;
                }else if(!ukuranxxl){
                    $('#ukuranxxl').show()
                    $('#ukurandirepairxxl').show()
                    $('#ukurandibuangxxl').show()
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
                    $('#ukurandirepairxxl').hide()
                    $('#ukurandibuangxxl').hide()
                    return false;
                }else if(ukuranxl){
                    $('#ukuranxl').hide()
                    $('#ukurandirepairxl').hide()
                    $('#ukurandibuangxl').hide()
                    return false;
                }else if(ukuranl){
                    $('#ukuranl').hide()
                    $('#ukurandirepairl').hide()
                    $('#ukurandibuangl').hide()
                    return false;
                }else if(ukuranm){
                    $('#ukuranm').hide()
                    $('#ukurandirepairm').hide()
                    $('#ukurandibuangm').hide()
                    $('#datahapus').hide()
                    return false;
                }
            })

            function emptyUkuran()
            {
                $('#iddetails').val('')
                $('#jumlahs').val(0)

                $('#iddetailm').val('')
                $('#jumlahm').val(0)
                $('#ukuranm').hide()

                $('#iddetaill').val('')
                $('#jumlahl').val(0)
                $('#ukuranl').hide()

                $('#iddetailxl').val('')
                $('#jumlahxl').val(0)
                $('#ukuranxl').hide()

                $('#iddetailxxl').val('')
                $('#jumlahxxl').val(0)
                $('#ukuranxxl').hide()
            }

            $('#kode_bahanselectkeluar').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        emptyUkuran()
                        $.ajax({
                            url:"{{route('cuci.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){

                                var data = response.data;
                                var bahan = data.jahit.potong.bahan
                                var detail_cuci = data.detail_cuci
                                $('#sku_keluar').val(bahan.sku)
                                console.log(detail_cuci);

                                for (let index = 0; index < detail_cuci.length; index++) {
                                    const element = detail_cuci[index];
                                    if(element.size == 'S'){
                                        $('#iddetails').val(element.id)
                                        $('#jumlahs').val(element.jumlah)

                                    }else if(element.size == 'M'){
                                        $('#iddetailm').val(element.id)
                                        $('#jumlahm').val(element.jumlah)
                                        $('#ukuranm').show()
                                        $('#ukurandirepairm').show()
                                         $('#ukurandibuangm').show()
                                    }else if(element.size == 'L'){
                                        $('#iddetaill').val(element.id)
                                        $('#jumlahl').val(element.jumlah)
                                        $('#ukuranl').show()
                                        $('#ukurandirepairl').show()
                                        $('#ukurandibuangl').show()
                                    }else if(element.size == 'XL'){
                                        $('#iddetailxl').val(element.id)
                                        $('#jumlahxl').val(element.jumlah)
                                        $('#ukuranxl').show()
                                        $('#ukurandirepairxl').show()
                                        $('#ukurandibuangxl').show()
                                    }else if(element.size == 'XXL'){
                                        $('#iddetailxxl').val(element.id)
                                        $('#jumlahxxl').val(element.jumlah)
                                        $('#ukuranxxl').show()
                                        $('#ukurandirepairxxl').show()
                                        $('#ukurandibuangxxl').show()
                                    }
                                }
                            }

                        })
                    }else{
                        emptyUkuran()
                    }
            })


     })
</script>
@endpush
