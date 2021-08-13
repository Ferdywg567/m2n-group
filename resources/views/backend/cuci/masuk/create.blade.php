@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active')

@section('content')

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
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <div id="kdbahanselectmasuk">
                                                <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                                    <option value="">Pilih Kode Bahan</option>
                                                    @forelse ($jahit as $item)
                                                    <option value="{{$item->id}}">{{$item->potong->bahan->kode_bahan}} |
                                                        {{$item->potong->bahan->nama_bahan}}
                                                    </option>
                                                    @empty

                                                    @endforelse


                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sku">SKU</label>
                                                    <input type="text" class="form-control" readonly required id="sku"
                                                        name="sku">
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" required id="tanggal_masuk"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_cuci">Estimasi Mulai Cuci</label>
                                            <input type="date" class="form-control" required id="tanggal_cuci"
                                                name="tanggal_cuci">
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
                                                            id="kain_siap_cuci" name="kain_siap_cuci">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="konversi">Konversi Lusin</label>
                                                    <input type="text" readonly class="form-control" required
                                                        id="konversi" name="konversi">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="vendor_cuci">Vendor Cuci</label>
                                            <select class="form-control" id="vendor_cuci" name="vendor_cuci">
                                                <option value="internal">Internal</option>
                                                <option value="eksternal">Eksternal</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="datavendor">
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
                                            <input type="text" class="form-control"  id="nama_vendor"
                                                name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"  id="harga_vendor"
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
                                            <input type="number" min="0" class="form-control"  id="jumlahs"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control"  id="jumlahm"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control"  id="jumlahl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control"  id="jumlahxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
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
              $('#datahapus').hide()
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
