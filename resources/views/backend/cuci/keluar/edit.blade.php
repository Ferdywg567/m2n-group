@extends('backend.master')

@section('title', 'Cuci')

@section('cuci', 'class=active')

@section('content')
<style>


    textarea {
        width: 300px;
        height: 150px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Edit Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.update',[$cuci->id])}}" method="post">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="cucian keluar">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control" readonly required id="kode_bahan" value="{{$cuci->jahit->potong->bahan->kode_bahan}}" name="kode_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sku">SKU</label>
                                                    <input type="text" class="form-control" readonly value="{{$cuci->jahit->potong->bahan->sku}}" required id="sku"
                                                        name="sku">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_surat">Nomor Surat Jalan</label>
                                                    <input type="text" class="form-control" value="{{$cuci->no_surat}}" required id="no_surat"
                                                        name="no_surat">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_keluar">Tanggal Selesai</label>
                                            <input type="date" class="form-control"   value="{{$cuci->tanggal_selesai}}" required id="tanggal_selesai_keluar"
                                                name="tanggal_selesai">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vendor_cuci">Vendor Cuci</label>
                                            <select class="form-control" id="vendor_cuci" name="vendor_cuci">
                                                <option value="internal"  @if($cuci->vendor == 'internal') selected @endif>Internal</option>
                                                <option value="eksternal"  @if($cuci->vendor == 'eksternal') selected @endif>Eksternal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="iddatavendor">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_pembayaran">Status Pembayaran</label>
                                            <select class="form-control" id="status_pembayaran"
                                                name="status_pembayaran" >
                                                <option value="lunas" @if($cuci->status_pembayaran == 'lunas') selected @endif >Lunas</option>
                                                <option value="belum" @if($cuci->status_pembayaran == 'belum') selected @endif >Belum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" value="{{$cuci->nama_vendor}}"  id="nama_vendor"
                                                name="nama_vendor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"  id="harga_vendor"  value="{{$cuci->harga_vendor}}"
                                                        name="harga_vendor">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berhasil_cuci">Berhasil Cuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="berhasil_cuci" value="{{$cuci->berhasil_cuci}}"
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

                                <div class="row">
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
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
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
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
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
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'XL')
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailxl">
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahxl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'XXL')
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}"
                                                id="iddetailxxl">
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahxxl" name="jumlah[]">
                                        </div>
                                    </div>
                                    @endif
                                    @empty

                                    @endforelse
                                    <div class="col-md-2">
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
                                                <input type="number" class="form-control" value="{{$cuci->gagal_cuci}}" required id="kain_gagal_cuci"
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
                                                <input type="number" class="form-control" value="{{$cuci->barang_direpair}}" required id="barang_direpair"
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
                                                <input type="number" class="form-control" value="{{$cuci->barang_dibuang}}" required id="barang_dibuang"
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
                                        <div class="form-group">
                                            <label for="barang_akan_direpair">Barang Akan Direpair</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="barang_akan_direpair" name="barang_akan_direpair" value="{{$cuci->barang_akan_direpair}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_akan_dibuang">Barang Akan Dibuang</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="barang_akan_dibuang" name="barang_akan_dibuang" value="{{$cuci->barang_akan_dibuang}}">
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
                                            <label for="keterangan_direpair">Keterangan Barang Direpair</label>
                                            <textarea class="form-control" id="keterangan_direpair"
                                                name="keterangan_direpair" rows="3">{{$cuci->keterangan_direpair}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Barang Dibuang</label>
                                            <textarea class="form-control" id="keterangan_dibuang"
                                                name="keterangan_dibuang" rows="6">{{$cuci->keterangan_dibuang}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Batal</a>

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

              $('#ukurandirepairm').hide()
              $('#ukurandirepairl').hide()
              $('#ukurandirepairxl').hide()
              $('#ukurandirepairxxl').hide()
              $('#ukurandibuangm').hide()
              $('#ukurandibuangl').hide()
              $('#ukurandibuangxl').hide()
              $('#ukurandibuangxxl').hide()
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
              var vendor = "{{$cuci->vendor}}"

              if(vendor == 'internal'){
                $('#iddatavendor').hide()
              }

              $('#vendor_cuci').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#iddatavendor').show()
                    $('#idpembayaran').show()
                    $('#idhargavendor').show()
                  }else{
                    $('#iddatavendor').hide()
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
                                    }else if(element.size == 'L'){
                                        $('#iddetaill').val(element.id)
                                        $('#jumlahl').val(element.jumlah)
                                        $('#ukuranl').show()
                                    }else if(element.size == 'XL'){
                                        $('#iddetailxl').val(element.id)
                                        $('#jumlahxl').val(element.jumlah)
                                        $('#ukuranxl').show()
                                    }else if(element.size == 'XXL'){
                                        $('#iddetailxxl').val(element.id)
                                        $('#jumlahxxl').val(element.jumlah)
                                        $('#ukuranxxl').show()
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
