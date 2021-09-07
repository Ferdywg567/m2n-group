@extends('backend.master')

@section('title', 'Sortir')
@section('title-nav', 'Sortir')
@section('finishing', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .left {
        text-align: left;
    }
</style>
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
            <h1 class="ml-2">Input Data | Produk Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.finishing.store')}}"  method="post">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="kirim warehouse">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanselectkeluar">
                                                <select class="form-control" id="kode_transaksiselectkeluar"
                                                    name="kode_transaksi">
                                                    <option value="">Pilih Kode Transaksi</option>
                                                    @forelse ($finish as $item)
                                                        <option value="{{$item->id}}">{{$item->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}} | {{$item->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</option>
                                                    @empty

                                                    @endforelse
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
                                            <label for="tanggal_selesai">Tanggal Selesai Sortir</label>
                                            <input type="date" class="form-control"  required id="tanggal_selesai"
                                                name="tanggal_selesai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok_lolos_sortir">Stok Lolos Sortir</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"  required
                                                    id="stok_lolos_sortir"  name="stok_lolos_sortir">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>



                                <div class="row" id="ukuran" style="margin-bottom: -30px">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="idukuran">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control"  required id="jumlahs"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control"  required id="jumlahm"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control"  required id="jumlahl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gagal_qc">Produk Gagal QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"  required
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
                                                    <label for="barang_diretur">Produk Diretur</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" required
                                                            id="barang_diretur"  name="produk_diretur">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran produk yang Diretur</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="S">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturs">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdireturs" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandireturm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="M">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturm">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdireturm" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandireturl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandiretur[]" value="L">
                                                    <input type="hidden" name="iddetailukurandiretur[]"
                                                        id="iddetaildireturl">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdireturl" name="jumlahdiretur[]">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_diretur">Keterangan Produk Diretur</label>
                                            <textarea class="form-control"   id="keterangan_diretur"
                                                name="keterangan_diretur"  rows="3"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="barang_dibuang">Produk Dibuang</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" readonly required
                                                            id="barang_dibuang"  name="produk_dibuang">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">pcs</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="text-dark">Ukuran produk yang Dibuang</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ukuran">S</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="S">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangs">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdibuangs" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandibuangm">
                                                <div class="form-group">
                                                    <label for="ukuran">M</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="M">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangm">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdibuangm" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="ukurandibuangl">
                                                <div class="form-group">
                                                    <label for="ukuran">L</label>
                                                    <input type="hidden" name="dataukurandibuang[]" value="L">
                                                    <input type="hidden" name="iddetailukurandibuang[]"
                                                        id="iddetaildibuangl">
                                                    <input type="number" min="0"  class="form-control" required
                                                        id="jumlahdibuangl" name="jumlahdibuang[]">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan_dibuang">Keterangan Produk Dibuang</label>
                                            <textarea class="form-control"   id="keterangan_dibuang"
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
            //   $('#ukurandireturm').hide()
            //   $('#ukurandireturl').hide()
            //   $('#ukurandireturxl').hide()
            //   $('#ukurandireturxxl').hide()
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
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')


              $('#barang_diretur').on('keyup', function(){
                   var nilai = $(this).val()
                   var dibuang = $('#gagal_qc').val()
                   nilai = parseInt(nilai)
                   dibuang = parseInt(dibuang)
                   if(nilai > 0 && dibuang > 0 && dibuang >= nilai){
                        var res =dibuang-nilai;

                        $('#barang_dibuang').val(res)
                   }
               })

            $('#kode_transaksiselectkeluar').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('warehouse.finishing.getdatafinish')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var total_barang = data.rekapitulasi.total_barang
                                var bahan = data.rekapitulasi.cuci.jahit.potong.bahan
                                var detail_finish = data.detail_finish
                                var finish_retur = data.finish_retur
                                var finish_dibuang = data.finish_dibuang
                                $('#sku').val(bahan.sku)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain').val(bahan.jenis_bahan)
                                $('#warna').val(bahan.warna)
                                $('#tanggal_masuk').val(bahan.tanggal_masuk)
                                $('#tanggal_qc').val(data.tanggal_qc)
                                // $('#barang_lolos_qc').val(data.barang_lolos_qc)
                                $('#gagal_qc').val(data.barang_gagal_qc)
                                $('#barang_diretur').val(data.barang_diretur)
                                $('#barang_dibuang').val(data.barang_dibuang)
                                $('#keterangan_diretur').val(data.keterangan_diretur)
                                $('#keterangan_dibuang').val(data.keterangan_dibuang)
                                $('#barang_siap_qc').val(total_barang)


                                $('#ukuran').show()
                                $('#idukuran').show()
                                for (let index = 0; index < detail_finish.length; index++) {
                                    const element = detail_finish[index];
                                    const retur = finish_retur[index];
                                    const dibuang = finish_dibuang[index];
                                    if(element.ukuran == 'S'){
                                        $('#iddetails').val(element.id)
                                        $('#jumlahs').val(element.jumlah)
                                        // $('#jumlahdireturs').val(retur.jumlah)
                                        // $('#jumlahdibuangs').val(dibuang.jumlah)
                                        // $('#jumlahs').prop('readonly',true)

                                    }else if(element.ukuran == 'M'){
                                        $('#iddetailm').val(element.id)
                                        $('#jumlahm').val(element.jumlah)
                                        // $('#jumlahdireturm').val(retur.jumlah)
                                        // $('#jumlahdibuangm').val(dibuang.jumlah)
                                        // $('#jumlahm').prop('readonly',true)
                                        // $('#ukuranm').show()
                                        // $('#ukurandireturm').show()
                                        //  $('#ukurandibuangm').show()
                                    }else if(element.ukuran == 'L'){
                                        $('#iddetaill').val(element.id)
                                        $('#jumlahl').val(element.jumlah)
                                        // $('#jumlahdireturl').val(retur.jumlah)
                                        // $('#jumlahdibuangm').val(dibuang.jumlah)
                                        // $('#jumlahl').prop('readonly',true)
                                        // $('#ukuranl').show()
                                        // $('#ukurandireturl').show()
                                        // $('#ukurandibuangl').show()
                                    }else if(element.ukuran == 'XL'){
                                        $('#iddetailxl').val(element.id)
                                        $('#jumlahxl').val(element.jumlah)
                                        // $('#jumlahdireturxl').val(retur.jumlah)
                                        // $('#jumlahdibuangxl').val(dibuang.jumlah)
                                        // $('#jumlahxl').prop('readonly',true)
                                        // $('#ukuranxl').show()
                                        // $('#ukurandireturxl').show()
                                        // $('#ukurandibuangxl').show()
                                    }else if(element.ukuran == 'XXL'){
                                        $('#iddetailxxl').val(element.id)
                                        $('#jumlahxxl').val(element.jumlah)
                                        // $('#jumlahdireturxxl').val(retur.jumlah)
                                        // $('#jumlahdibuangxxl').val(dibuang.jumlah)
                                        // $('#jumlahxxl').prop('readonly',true)
                                        // $('#ukuranxxl').show()
                                        // $('#ukurandireturxxl').show()
                                        // $('#ukurandibuangxxl').show()
                                    }
                                }

                            }

                        })
                    }
            })


     })
</script>
@endpush
