@extends('backend.master')

@section('title', 'Jahit')

@section('jahit', 'class=active')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    textarea {
        width: 300px;
        height: 150px !important;
        }

</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <h1>Jahit Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div id="alert-jahit-keluar">

                            </div>
                            <input type="hidden" name="status" value="jahit keluar">
                            <input type="hidden" name="id" id="idkeluar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_bahan">Kode Bahan</label>
                                        <div id="kdbahanselectkeluar">
                                            <select class="form-control" id="kode_bahanselectkeluar" name="kode_bahan">
                                                <option value="">Pilih Kode Bahan</option>
                                                {{-- @forelse ($keluar as $item)
                                                <option value="{{$item->id}}">{{$item->bahan->kode_bahan}} |
                                                {{$item->bahan->nama_bahan}}
                                                </option>
                                                @empty

                                                @endforelse --}}


                                            </select>
                                        </div>

                                        <div id="kdbahankeluar">
                                            <input type="text" class="form-control" readonly id="kdbahanreadkeluar"
                                                name="kdbahanreadkeluar">
                                        </div>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_selesai_keluar">Tanggal Selesai</label>
                                        <input type="date" class="form-control" readonly required
                                            id="tanggal_selesai_keluar" name="tanggal_selesai">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                        <input type="text" class="form-control" required id="no_surat_keluar"
                                            name="no_surat">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vendor_jahit">Vendor Jahit</label>
                                        <select class="form-control" id="vendor_jahit" name="vendor_jahit">
                                            <option value="internal">Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                        <input type="text" class="form-control" required id="no_surat_keluar"
                                            name="no_surat">
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
                                                <input type="text" class="form-control" required
                                                    id="harga_vendor_keluar" name="harga_vendor">
                                            </div>
                                        </div>
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
                                        <label for="ukuran">S</label>
                                        <input type="hidden" name="dataukuran[]" value="S">
                                        <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                        <input type="number" min="0" class="form-control" required id="jumlahs"
                                            name="jumlah[]">
                                    </div>
                                </div>
                                <div class="col-md-2" id="ukuranm">
                                    <div class="form-group">
                                        <label for="ukuran">M</label>
                                        <input type="hidden" name="dataukuran[]" value="M">
                                        <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                        <input type="number" min="0" class="form-control" required id="jumlahm"
                                            name="jumlah[]">
                                    </div>
                                </div>
                                <div class="col-md-2" id="ukuranl">
                                    <div class="form-group">
                                        <label for="ukuran">L</label>
                                        <input type="hidden" name="dataukuran[]" value="L">
                                        <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                        <input type="number" min="0" class="form-control" required id="jumlahl"
                                            name="jumlah[]">
                                    </div>
                                </div>
                                <div class="col-md-2" id="ukuranxl">
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
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-top: 30px">
                                        <button type="button" class="btn btn-outline-primary" id="btnsize">Tambah
                                            Size</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gagal_jahit">Gagal Jahit</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" required id="gagal_jahit"
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
                                    <div class="form-group">
                                        <label for="barang_direpair">Barang Akan Direpair</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" required id="barang_direpair"
                                                name="barang_direpair">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">pcs</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gagal_jahit">Barang Akan Dibuang</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" required id="gagal_jahit"
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
                                                <input type="number" min="0" class="form-control" required id="jumlahs"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranm">
                                            <div class="form-group">
                                                <label for="ukuran">M</label>
                                                <input type="hidden" name="dataukuran[]" value="M">
                                                <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                                <input type="number" min="0" class="form-control" required id="jumlahm"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranl">
                                            <div class="form-group">
                                                <label for="ukuran">L</label>
                                                <input type="hidden" name="dataukuran[]" value="L">
                                                <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                                <input type="number" min="0" class="form-control" required id="jumlahl"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranxl">
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
                                                <input type="text" min="0" class="form-control" required id="jumlahxxl"
                                                    name="jumlah[]">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                                <label for="ukuran">S</label>
                                                <input type="hidden" name="dataukuran[]" value="S">
                                                <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                                <input type="number" min="0" class="form-control" required id="jumlahs"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranm">
                                            <div class="form-group">
                                                <label for="ukuran">M</label>
                                                <input type="hidden" name="dataukuran[]" value="M">
                                                <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                                <input type="number" min="0" class="form-control" required id="jumlahm"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranl">
                                            <div class="form-group">
                                                <label for="ukuran">L</label>
                                                <input type="hidden" name="dataukuran[]" value="L">
                                                <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                                <input type="number" min="0" class="form-control" required id="jumlahl"
                                                    name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="ukuranxl">
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
                                                <input type="text" min="0" class="form-control" required id="jumlahxxl"
                                                    name="jumlah[]">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Keterangan Barang Direpair</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Keterangan Barang Dibuang</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>
<div id="printable">
    <h1>Hello print</h1>
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
              $('#idnamavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#jahitMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#jahitMasukLabel').text('Input Data [jahit Masuk]')
                $('#alert-jahit-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('.btnmasuk').show()
                $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#datavendor').hide()
              });

              $('#jahitKeluar').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#jahitKeluarLabel').text('Input Data [jahit Keluar]')
                $('#alert-jahit-keluar').empty()
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


              $('#vendor_jahit').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#idnamavendor').show()
                    $('#datavendor').show()
                  }else{
                    $('#idnamavendor').hide()
                    $('#datavendor').hide()
                  }
               })

              $('#hasil_cutting').on('keyup', function(){
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

            $(document).on('click','#btnsimpanmasuk', function () {

                var form = $('#formjahitMasuk').serialize()
                ajax()
                $.ajax({
                    url:"{{route('jahit.store')}}",
                    method:"POST",
                    data:form
                }).done(function (response) {
                    console.log(response);
                    if(response.status){
                        $('#alert-jahit-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-jahit-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-jahit-masuk').html(response.data)
                        return false;
                    }
                })
             })

             $(document).on('click','.btneditmasuk',function () {
                    var id = $(this).data('id');
                    $('.btnmasuk').prop('id','btnupdatemasuk')
                    $('#jahitMasukLabel').text('Edit Data [jahit Masuk]')
                    $('#kdbahanselectmasuk').hide()
                    $('#jahitMasuk').modal('show')
                    $('#kdbahanmasuk').show()
                    $.ajax({
                        url:"{{route('jahit.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                        console.log(response);
                            if(response.status){
                                var data = response.data;
                                var potong = data.potong
                                var bahan = potong.bahan;

                                // $('#idmasuk').val(data.id)
                                $('#kdbahanreadmasuk').val(bahan.kode_bahan)
                                $('#no_surat').val(data.no_surat)
                                // $('#nama_produk').val(bahan.nama_bahan)
                                // $('#jenis_kain').val(bahan.jenis_bahan)
                                // $('#warna').val(bahan.warna)
                                $('#sku').val(bahan.sku)
                                $('#tanggal_jahit').val(data.tanggal_jahit)
                                $('#tanggal_selesai').val(data.tanggal_selesai)
                                // $('#panjang_kain').val(bahan.panjang_bahan)
                                if(data.vendor == 'internal'){
                                    $('#vendor_jahit').val(data.vendor).change()
                                }else{
                                    $('#vendor_jahit').val(data.vendor).change()
                                    $('#nama_vendor').val(data.nama_vendor)
                                    $('#harga_vendor').val(data.harga_vendor)
                                    $('#datavendor').show()
                                }

                            }
                    })
              })

            $(document).on('click','#btnupdatemasuk', function () {
                var id = $('#idmasuk').val()
                var form = $('#formjahitMasuk').serialize()

                ajax()
                $.ajax({
                    url:"{{url('production/jahit/')}}/"+id,
                    method:"PUT",
                    data:form
                }).done(function (response) {

                    if(response.status){
                        $('#alert-jahit-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-jahit-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-jahit-masuk').html(response.data)
                        return false;
                    }
                })
             })


             $(document).on('click','.btndetailmasuk',function () {

                    var id = $(this).data('id');

                    $('.btnmasuk').hide()
                    $('#jahitMasukLabel').text('Detail Data [Bahan Masuk]')
                    $('#kdbahanselectmasuk').hide()
                    $('#jahitMasuk').modal('show')
                    $('#kdbahanmasuk').show()
                    $('#kdbahanreadmasuk').prop('readonly', true)
                    $('#no_surat').prop('readonly', true)
                    $('#tanggal_cutting').prop('readonly', true)
                    $('#tanggal_selesai').prop('readonly', true)


                    $.ajax({
                        url:"{{route('jahit.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                var bahan = data.bahan;
                                $('#kdbahanreadmasuk').val(bahan.kode_bahan)
                                $('#no_surat').val(data.no_surat)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain').val(bahan.jenis_bahan)
                                $('#warna').val(bahan.warna)
                                $('#sku').val(bahan.sku)
                                $('#tanggal_cutting').val(data.tanggal_cutting)
                                $('#tanggal_selesai').val(data.tanggal_selesai)
                                $('#panjang_kain').val(bahan.panjang_bahan)

                            }
                    })
              })

              $(document).on('click','.btnprintmasuk', function(){

                  window.print()

              })

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
                                console.log(response);
                                var data = response.data;
                                $('#sku').val(data.sku)
                                $('#nama_produk').val(data.nama_bahan)
                                $('#jenis_kain').val(data.jenis_bahan)
                                $('#warna').val(data.warna)
                                $('#vendor_keluar').val(data.vendor)

                                $('#panjang_kain').val(data.panjang_bahan)
                            }

                        })
                    }
            })


            $('#kode_bahanselectkeluar').on('change', function () {
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
                                var bahan = data.bahan
                                $('#sku_keluar').val(bahan.sku)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)

                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)
                            }

                        })
                    }
            })

            $(document).on('click','#btnsimpankeluar', function () {

                var form = $('#formjahitKeluar').serialize()
                ajax()
                $.ajax({
                    url:"{{route('jahit.store')}}",
                    method:"POST",
                    data:form
                }).done(function (response) {
                    if(response.status){
                        $('#alert-jahit-keluar').html(response.data)
                        setTimeout(function(){
                            $('#alert-jahit-keluar').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-jahit-keluar').html(response.data)
                        return false;
                    }
                })
            })

            $(document).on('click','.btneditkeluar',function () {
                    var id = $(this).data('id');
                    $('.btnkeluar').prop('id','btnupdatekeluar')
                    $('#kdbahanselectkeluar').hide()
                    $('#kdbahankeluar').show()
                    $('#jahitKeluarLabel').text('Edit Data [jahit Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#jahitKeluar').modal('show')

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
                                var bahan = data.bahan;
                                var detail = data.detail_jahit
                                $('#idkeluar').val(data.id)
                                $('#kdbahanreadkeluar').val(bahan.kode_bahan)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#sku_keluar').val(bahan.sku)
                                $('#tanggal_keluar').val(data.tanggal_keluar)
                                $('#tanggal_selesai').val(data.tanggal_selesai)
                                $('#hasil_cutting').val(data.hasil_cutting)
                                $('#konversi').val(data.konversi)

                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)

                                detail.forEach(element => {
                                        if(element.size == 'S' && element.jumlah > 0){
                                            $('#jumlahs').val(element.jumlah)
                                            $('#iddetails').val(element.id)
                                        }else if(element.size == 'M' && element.jumlah > 0){
                                            $('#jumlahm').val(element.jumlah)
                                            $('#iddetailm').val(element.id)
                                            $('#ukuranm').show()
                                        }
                                        else if(element.size == 'L' && element.jumlah > 0){
                                            $('#jumlahl').val(element.jumlah)
                                            $('#iddetaill').val(element.id)
                                            $('#ukuranl').show()
                                        }
                                        else if(element.size == 'XL' && element.jumlah > 0){
                                            $('#jumlahxl').val(element.jumlah)
                                            $('#iddetailxl').val(element.id)
                                            $('#ukuranxl').show()
                                        }
                                        else if(element.size == 'XXL' && element.jumlah > 0){
                                            $('#jumlahxxl').val(element.jumlah)
                                            $('#iddetailxxl').val(element.id)
                                            $('#ukuranxxl').show()
                                        }
                                });
                            }
                    })
              })

              $(document).on('click','#btnupdatekeluar', function () {
                var id = $('#idkeluar').val()
                var form = $('#formbahanKeluar').serialize()
                ajax()
                $.ajax({
                    url:"{{url('production/bahan/')}}/"+id,
                    method:"PUT",
                    data:form
                }).done(function (response) {
                    if(response.status){
                        $('#alert-bahan-keluar').html(response.data)
                        setTimeout(function(){
                            $('#alert-bahan-keluar').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-bahan-keluar').html(response.data)
                        return false;
                    }
                })
             })

             $(document).on('click','.btndetailkeluar',function () {
                    var id = $(this).data('id');
                    $('.btnkeluar').hide()
                    $('#kdbahanselectkeluar').hide()
                    $('#kdbahankeluar').show()
                    $('#jahitKeluarLabel').text('Detail Data [jahit Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#jahitKeluar').modal('show')

                    $('#tanggal_keluar').prop('readonly', true)
                    $('#no_surat_keluar').prop('readonly', true)
                    $('#hasil_cutting').prop('readonly', true)

                    $.ajax({
                        url:"{{route('jahit.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                var bahan = data.bahan;
                                var detail = data.detail_jahit

                                $('#kdbahanreadkeluar').val(bahan.kode_bahan)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#sku_keluar').val(bahan.sku)
                                $('#tanggal_keluar').val(data.tanggal_keluar)
                                $('#tanggal_selesai').val(data.tanggal_selesai)
                                $('#hasil_cutting').val(data.hasil_cutting)
                                $('#konversi').val(data.konversi)

                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)

                                detail.forEach(element => {
                                        if(element.size == 'S' && element.jumlah > 0){
                                            $('#jumlahs').val(element.jumlah)
                                            $('#iddetails').val(element.id)
                                            $('#jumlahs').prop('readonly', true)
                                        }else if(element.size == 'M' && element.jumlah > 0){
                                            $('#jumlahm').val(element.jumlah)
                                            $('#iddetailm').val(element.id)
                                            $('#jumlahm').prop('readonly', true)
                                            $('#ukuranm').show()
                                        }
                                        else if(element.size == 'L' && element.jumlah > 0){
                                            $('#jumlahl').val(element.jumlah)
                                            $('#iddetaill').val(element.id)
                                            $('#jumlahl').prop('readonly', true)
                                            $('#ukuranl').show()
                                        }
                                        else if(element.size == 'XL' && element.jumlah > 0){
                                            $('#jumlahxl').val(element.jumlah)
                                            $('#iddetailxl').val(element.id)
                                            $('#jumlahxl').prop('readonly', true)
                                            $('#ukuranxl').show()
                                        }
                                        else if(element.size == 'XXL' && element.jumlah > 0){
                                            $('#jumlahxxl').val(element.jumlah)
                                            $('#iddetailxxl').val(element.id)
                                            $('#jumlahxxl').prop('readonly', true)
                                            $('#ukuranxxl').show()
                                        }
                                });
                            }
                    })
              })
     })
</script>
@endpush
