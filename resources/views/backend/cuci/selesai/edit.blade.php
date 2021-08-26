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
            <h1 class="ml-2">Edit Data | Selesai</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.update',[$cuci->id])}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="cucian selesai">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" value="{{$cuci->jahit->potong->bahan->kode_transaksi}}" readonly required id="kode_transaksi_keluar"
                                                name="kode_transaksi">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar" value="{{$cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required id="no_surat" value="{{$cuci->no_surat}}"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_mulai_cuci">Tanggal Mulai Cuci</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_mulai_cuci" value="{{$cuci->tanggal_cuci}}"
                                                name="tanggal_mulai_cuci">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_cuci">Tanggal Selesai Cuci</label>
                                            <input type="date" class="form-control"  required id="tanggal_selesai_cuci" value="{{$cuci->tanggal_selesai}}"
                                                name="tanggal_selesai_cuci">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kain_siap_cuci">Kain Siap Cuci</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control"  required  value="{{$cuci->kain_siap_cuci}}"
                                                            id="kain_siap_cuci" name="kain_siap_cuci">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="konversi_siap">Konversi Lusin</label>
                                                    <input type="text" readonly class="form-control" required
                                                        id="konversi_siap" name="konversi_siap">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="vendor_cuci"> Vendor Cuci</label>
                                            <select class="form-control" id="vendor_cuci" name="vendor_cuci">
                                                <option value="internal"  @if($cuci->vendor == 'internal') selected @endif>Internal</option>
                                                <option value="eksternal"  @if($cuci->vendor == 'eksternal') selected @endif>Eksternal</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if ($cuci->vendor == 'eksternal')
                                <div class="row" id="idnamavendor">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_pembayaran">Status Pembayaran</label>
                                            <select class="form-control" id="status_pembayaran"
                                                name="status_pembayaran" >
                                                <option value="lunas" @if($cuci->status_pembayaran == 'lunas') selected @endif >Lunas</option>
                                                <option value="belum" @if($cuci->status_pembayaran == 'belum') selected @endif >Belum</option>
                                                <option value="termin" @if($cuci->status_pembayaran == 'termin') selected @endif >Termin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" required   id="nama_vendor" value="{{$cuci->nama_vendor}}"
                                                name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor_keluar">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"  required value="{{$cuci->harga_vendor}}"
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
                                @endif

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_cuci">Berhasil Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="berhasil_cuci"  value="{{$cuci->berhasil_cuci}}"
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
                                            <input type="text" readonly class="form-control" required id="konversi" value="{{$cuci->konversi}}"
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

                                    @forelse ($cuci->detail_cuci as $item)
                                    @if ($item->size == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetails">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahs" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailm">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahm" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetaill">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahl" name="jumlah[]">
                                        </div>
                                    </div>

                                    @endif
                                    @empty

                                    @endforelse
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kain_gagal_cuci">Kain Gagal Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="kain_gagal_cuci"  value="{{$cuci->gagal_cuci}}"
                                                    name="kain_gagal_cuci">
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
                                                    <label for="barang_direpair">Barang  Direpair</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" required  value="{{$cuci->barang_direpair}}"
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

                                            @forelse ($cuci->cuci_direpair as $item)

                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="S">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairs" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairs"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'M')
                                            <div class="col-md-4" id="ukurandirepairm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="M">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairm" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairm"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'L')
                                            <div class="col-md-4" id="ukurandirepairl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandirepair[]" value="L">
                                                    <input type="hidden" name="iddetailukurandirepair[]"
                                                        id="iddetaildirepairl" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdirepairl"
                                                        name="jumlahdirepair[]">
                                                </div>
                                            </div>


                                            @endif

                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_direpair">Keterangan Barang Direpair</label>
                                            <textarea class="form-control" id="keterangan_direpair"
                                                name="keterangan_direpair" rows="3" >{{$cuci->keterangan_direpair}}</textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Barang  Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" readonly required value=" {{$cuci->barang_dibuang}}"
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

                                            @forelse ($cuci->cuci_dibuang as $item)

                                            @if ($item->ukuran == 'S')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdibuangs"
                                                        name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'M')
                                            <div class="col-md-4" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdibuangm"
                                                        name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @elseif ($item->ukuran == 'L')
                                            <div class="col-md-4" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl" value="{{$item->id}}">
                                                    <input type="number" min="0" value="{{$item->jumlah}}"
                                                        class="form-control" required id="jumlahdibuangl"
                                                        name="jumlahdibuang[]">
                                                </div>
                                            </div>

                                            @endif

                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Barang Dibuang</label>
                                            <textarea class="form-control" id="keterangan_dibuang"
                                                name="keterangan_dibuang"  rows="6"> {{$cuci->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Close</a>
                                            <button type="submit" class="btn btn-primary">Update</button>


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
              $('#datahapus').hide()
              $('#ukurandibuangxl').hide()
              $('#ukurandibuangxxl').hide()
            //   $('#idnamavendor').hide()
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
              $('#kode_transaksiselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')


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

               $('#barang_direpair').on('keyup', function(){
                   var nilai = $(this).val()
                   var dibuang = $('#kain_gagal_cuci').val()
                   nilai = parseInt(nilai)
                   dibuang = parseInt(dibuang)
                   if(nilai > 0 && dibuang > 0 && dibuang >= nilai){
                        var res =dibuang-nilai;

                        $('#barang_dibuang').val(res)
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


                  var data = "{{$cuci->kain_siap_cuci}}"
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi_siap').val(res)

            //   $(document).on('click','#btnsize', function(){
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
            //         return false;
            //     }else if(ukuranxl){
            //         $('#ukuranxl').hide()
            //         $('#ukurandirepairxl').hide()
            //         $('#ukurandibuangxl').hide()
            //         return false;
            //     }else if(ukuranl){
            //         $('#ukuranl').hide()
            //         $('#ukurandirepairl').hide()
            //         $('#ukurandibuangl').hide()
            //         return false;
            //     }else if(ukuranm){
            //         $('#ukuranm').hide()
            //         $('#ukurandirepairm').hide()
            //         $('#ukurandibuangm').hide()
            //         $('#datahapus').hide()
            //         return false;
            //     }
            // })

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

            $('#kode_transaksiselectkeluar').on('change', function () {
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
                                $('#no_surat').val(data.no_surat)
                                $('#tanggal_mulai_cuci').val(data.tanggal_cuci)
                                $('#tanggal_selesai_cuci').val(data.tanggal_selesai)
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
