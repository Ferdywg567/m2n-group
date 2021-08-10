@extends('backend.master')

@section('title', 'Finishing')

@section('finishing', 'class=active')

@section('content')
<style>
    textarea {
        width: 300px;
        height: 170px !important;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.finishing.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Kirim Warehouse</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.finishing.store')}}"  method="post">

                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="finishing masuk">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <div id="kdbahanselectkeluar">
                                                <select class="form-control" id="kode_bahanselectkeluar"
                                                    name="kode_bahan">
                                                    <option value="">Pilih Kode Bahan</option>



                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
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
                                            <label for="tanggal_masuk">Tanggal Barang Masuk</label>
                                            <input type="date" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_qc">Tanggal QC Barang</label>
                                            <input type="date" class="form-control" required id="tanggal_qc"
                                                name="tanggal_qc">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                name="nama_produk">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required id="jenis_kain"
                                                name="jenis_kain">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_siap_qc">Barang Siap QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="barang_siap_qc" name="barang_siap_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barang_lolos_qc">Barang Lolos QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"  required
                                                    id="barang_lolos_qc" name="barang_lolos_qc">
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gagal_qc">Barang Gagal QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="gagal_qc" name="gagal_qc">
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
                                                    <label for="barang_diretur">Barang Diretur</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" required
                                                            id="barang_diretur" name="barang_diretur">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran barang yang Diretur</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-2">

                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="S">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturs">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdireturs" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandireturm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="M">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturm">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdireturm" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandireturl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="L">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdireturl" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandireturxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XL</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="XL">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturxl">
                                                    <input type="number" min="0" class="form-control" required
                                                        id="jumlahdireturxl" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="ukurandireturxxl">
                                                <div class="form-group">
                                                    <label for="ukuran">XXL</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="XXL">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturxxl">
                                                    <input type="text" min="0" class="form-control" required
                                                        id="jumlahdireturxxl" name="jumlahdiretur[]">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_diretur">Keterangan Barang Diretur</label>
                                            <textarea class="form-control" readonly id="keterangan_diretur"
                                                name="keterangan_diretur" rows="3"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Barang Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" readonly required
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
                                                <label for="" class="text-dark">Ukuran barang yang Dibuang</label>
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
                                            <textarea class="form-control" readonly id="keterangan_dibuang"
                                                name="keterangan_dibuang" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.finishing.index')}}">Batal</a>

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
              $('#ukurandireturm').hide()
              $('#ukurandireturl').hide()
              $('#ukurandireturxl').hide()
              $('#ukurandireturxxl').hide()
              $('#ukurandibuangm').hide()
              $('#ukurandibuangl').hide()
              $('#ukurandibuangxl').hide()
              $('#ukurandibuangxxl').hide()
              $('#iddatavendor').hide()
              $('#idhargavendor').hide()
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


              $('#vendor_jahit').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#iddatavendor').show()

                  }else{
                    $('#iddatavendor').hide()

                  }
               })

               $('#barang_diretur').on('keyup', function(){
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

            $(document).on('click','#btnsize', function(){
                var ukuranm = $('#ukuranm').is(':visible')
                var ukuranl = $('#ukuranl').is(':visible')
                var ukuranxl = $('#ukuranxl').is(':visible')
                var ukuranxxl = $('#ukuranxxl').is(':visible')

                if(!ukuranm){
                    $('#ukuranm').show()
                    $('#ukurandireturm').show()
                    $('#ukurandibuangm').show()
                    return false;
                }else if(!ukuranl){
                    $('#ukuranl').show()
                    $('#ukurandireturl').show()
                    $('#ukurandibuangl').show()
                    return false;
                }else if(!ukuranxl){
                    $('#ukuranxl').show()
                    $('#ukurandireturxl').show()
                    $('#ukurandibuangxl').show()
                    return false;
                }else if(!ukuranxxl){
                    $('#ukuranxxl').show()
                    $('#ukurandireturxxl').show()
                    $('#ukurandibuangxxl').show()
                    return false;
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
                                var bahan = data.potong.bahan
                                $('#sku').val(bahan.sku)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)

                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)
                            }

                        })
                    }
            })


     })
</script>
@endpush
