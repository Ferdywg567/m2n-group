@extends('backend.master')

@section('title', 'Sortir')
@section('title-nav', 'Sortir')
@section('finishing', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
   .cssnav {
        margin-left: -15px;
    }    .dropdown-menu {
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
                        <form action="{{route('warehouse.finishing.store')}}" id="formProduk" method="post">
                            <div class="card-body">
                                @include('backend.include.alert')
                                <div class="alert alert-danger" role="alert" id="dataalert">

                                </div>
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
                                                        <option value="{{$item->id}}">{{$item->cuci->jahit->potong->bahan->kode_transaksi}} </option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                            </div>
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
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="barang_siap_qc">Stok Siap Sortir</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="barang_siap_qc" name="barang_siap_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gagal_qc">Produk Gagal QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control"  required readonly
                                                    id="gagal_qc" name="gagal_qc">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>



                                <div  id="ukuran-utama">


                                </div>

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

                                <div id="data-ukuran-diretur">



                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan_diretur">Keterangan Produk Diretur</label>
                                            <textarea class="form-control"   id="keterangan_diretur"
                                                name="keterangan_diretur"  rows="3"></textarea>
                                        </div>

                                    </div>
                                </div>
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
                                <div id="data-ukuran-dibuang"></div>
                                <div class="row">
                                    <div class="col-md-12">
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

              $('#stok_lolos_sortir').on('keyup', function(){
                  var data = $(this).val()
                var jumlah_bahan = $('#barang_siap_qc').val()

                if(parseInt(data) <= parseInt(jumlah_bahan)){
                    var res = parseInt(jumlah_bahan) -  parseInt(data);
                    $('#gagal_qc').val(res)
                }else{
                    $('#gagal_qc').val(0)
                }
              })

              $('#barang_diretur').on('keyup', function(){
                   var nilai = $(this).val()
                   var dibuang = $('#gagal_qc').val()
                   nilai = parseInt(nilai)
                   dibuang = parseInt(dibuang)
                   if(nilai == 0){
                    $('#barang_dibuang').val(dibuang)
                   }else{
                        if(nilai > 0 && dibuang > 0 && dibuang >= nilai){
                            var res =dibuang-nilai;
                            $('#barang_dibuang').val(res)
                        }else{
                            $('#barang_dibuang').val(0)
                        }
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
                                // var total_barang = data.rekapitulasi.total_barang
                                var bahan = data.cuci.jahit.potong.bahan
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
                                // $('#barang_siap_qc').val(total_barang)
                                $('#barang_siap_qc').val(data.cuci.berhasil_cuci)
                                // $('#stok_lolos_sortir').prop('max',data.cuci.berhasil_cuci)
                                $('#ukuran').show()
                                $('#idukuran').show()

                                var content="";
                                content += ' <label for="ukuran" class="text-dark">Ukuran Lolos Sortir</label>'
                                detail_finish.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukuran[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahutama" name="jumlahutama[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#ukuran-utama').html(content)


                                var content="";
                                content += ' <label for="ukurandiretur" class="text-dark">Ukuran yang Diretur</label>'
                                detail_finish.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandiretur[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdiretur" name="jumlahdiretur[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#data-ukuran-diretur').html(content)


                                var content="";
                                content += ' <label for="ukurangdibuang" class="text-dark">Ukuran yang Dibuang</label>'
                                detail_finish.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukurandibuang[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required id="jumlahdibuang" name="jumlahdibuang[]" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#data-ukuran-dibuang').html(content)

                            }

                        })
                    }
            })
            $('#dataalert').hide()
            $('form[id=formProduk]').submit(function(){
                var jumlahdiretur =0;
                var jumlahutama =0;
                var jumlahdibuang =0;
                var barang_siap_qc = $("#barang_siap_qc").val()
                var gagal_qc = $("#gagal_qc").val()
                var stok_lolos_sortir = $('#stok_lolos_sortir').val()
                var barang_dibuang = $('#barang_dibuang').val()
                var barang_diretur = $('#barang_diretur').val()
                $('input[name^="jumlahdiretur"]').each(function() {
                    jumlahdiretur = jumlahdiretur + parseInt($(this).val());
                });
                $('input[name^="jumlahutama"]').each(function() {
                    jumlahutama = jumlahutama + parseInt($(this).val());
                });
                $('input[name^="jumlahdibuang"]').each(function() {
                    jumlahdibuang = jumlahdibuang + parseInt($(this).val());
                });
                if(parseInt(barang_siap_qc) <= parseInt(stok_lolos_sortir)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah Stok Lolos Sortir tidak boleh melebihi Jumlah Stok Siap Sortir')
                    return false;
                }else if(parseInt(gagal_qc) <= parseInt(barang_diretur)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah produk diretur tidak boleh melebihi Jumlah produk gagal qc')
                    return false;
                }else if(parseInt(jumlahutama) != parseInt(stok_lolos_sortir)){
                    alert(jumlahutama)
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran harus sesuai dengan jumlah Stok lolos Sortir')
                    return false;
                }else if(parseInt(jumlahdiretur) != parseInt(barang_diretur)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran retur harus sesuai dengan jumlah produk diretur')
                    return false;
                }else if(parseInt(jumlahdibuang) != parseInt(barang_dibuang)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran dibuang harus sesuai dengan jumlah dibuang')
                    return false;
                } else{
                    $('#dataalert').hide()
                   return true;
                }
            });
     })
</script>
@endpush
