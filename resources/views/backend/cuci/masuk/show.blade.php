@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('cuci.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.cetak')}}" target="_blank" method="post">
                            @csrf

                            <div class="card-body">
                                <input type="hidden" name="id" id="idcuci" value="{{$cuci->id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly required id="kode_transaksi" value="{{$cuci->jahit->potong->bahan->kode_transaksi}}" name="kode_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly value="{{$cuci->no_surat}}" required id="no_surat"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                name="nama_produk"   value="{{$cuci->jahit->potong->bahan->nama_bahan}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku" value="{{$cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori" value="{{$cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori" value="{{$cuci->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly value="{{$cuci->jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_cuci">Tanggal Cuci</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_cuci" value="{{$cuci->tanggal_cuci}}"
                                                name="tanggal_cuci">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_cuci">Estimasi Selesai Cuci</label>
                                            <input type="date" class="form-control" readonly required id="estimasi_selesai_cuci"  value="{{$cuci->tanggal_selesai}}"
                                                name="estimasi_selesai_cuci">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_pembayaran">Status Pembayaran</label>
                                            <input type="text" class="form-control" required readonly id="status_pembayaran" value="{{$cuci->status_pembayaran}}"
                                                name="status_pembayaran">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" readonly required id="nama_vendor" value="{{$cuci->nama_vendor}}"
                                                name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" readonly required id="harga_vendor" value="{{$cuci->harga_vendor}}"
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
                                                <input type="number" class="form-control" readonly required value="{{$cuci->kain_siap_cuci}}"
                                                    id="jumlah_bahan_yang_dicuci" name="jumlah_bahan_yang_dicuci" max="{{$cuci->kain_siap_cuci}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi" value="{{$cuci->konversi}}"
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
                                <div class="row">

                                    @forelse ($cuci->detail_cuci as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukuran[]" value="{{$item->size}}" readonly>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->size}}</div>
                                            </div>
                                            <input type="number" class="form-control" readonly required id="jumlah"
                                                name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 6 ==0)
                                     </div><div class="row">
                                    @endif
                                    @empty

                                    @endforelse

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('cuci.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                            Print</button>
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
