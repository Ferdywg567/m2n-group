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
            <h1 class="ml-2">Edit Data | Masuk</h1>
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
                                <input type="hidden" name="status" value="cucian masuk">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required id="kode_transaksi" value="{{$cuci->jahit->potong->bahan->kode_transaksi}}" name="kode_bahan">
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
                                            <label for="tanggal_mulai_cuci">Tanggal Mulai Cuci</label>
                                            <input type="date" class="form-control" required id="tanggal_mulai_cuci"
                                                name="tanggal_mulai_cuci" readonly value="{{$cuci->tanggal_cuci}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_cuci">Tanggal Selesai Cuci</label>
                                            <input type="date" class="form-control" required id="tanggal_selesai_cuci"
                                                name="tanggal_selesai_cuci"  value="{{$cuci->tanggal_selesai}}">
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
                                                        <input type="number" class="form-control" required
                                                            id="kain_siap_cuci" name="kain_siap_cuci" value="{{$cuci->kain_siap_cuci}}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="konversi">Konversi Lusin</label>
                                                    <input type="text" readonly class="form-control" required value="{{$cuci->konversi}}"
                                                        id="konversi" name="konversi">
                                                </div>
                                            </div>
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

                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
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
                                                    <input type="text" class="form-control" value="{{$cuci->harga_vendor}}" id="harga_vendor"
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

                                    @endif
                                    @empty

                                    @endforelse

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

              var vendor = "{{$cuci->vendor}}"

              if(vendor == 'internal'){
                $('#datavendor').hide()
              }

              $('#idnamavendor').hide()

              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()

              $('#vendor_cuci').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#idnamavendor').show()
                    $('#datavendor').show()
                    $('#nama_vendor').prop('required',true)
                    $('#harga_vendor').prop('required',true)
                  }else{
                    $('#idnamavendor').hide()
                    $('#datavendor').hide()
                    $('#nama_vendor').prop('required',false)
                    $('#harga_vendor').prop('required',false)
                  }
               })

              $('#kain_siap_cuci').on('keyup', function(){
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

             $('#kode_bahanselect').on('change', function () {
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

                                $('#sku').val(bahan.sku)
                                // $('#nama_produk').val(data.nama_bahan)
                                // $('#jenis_kain').val(data.jenis_bahan)
                                // $('#warna').val(data.warna)
                                // $('#vendor_keluar').val(data.vendor)

                                // $('#panjang_kain').val(data.panjang_bahan)
                            }

                        })
                    }
            })



     })
</script>
@endpush
