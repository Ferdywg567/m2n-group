@extends('backend.master')

@section('title', 'Bahan')

@section('potong', 'class=active')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <h1>Potong</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>Latest Posts</h4> --}}
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary " data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Input Data <i class="fas fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#potongMasuk">Potong Masuk</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#bahanKeluar">Potong Keluar</a>

                                    </div>
                                </div>

                                <button class="btn btn-outline-primary">Print Semua <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="ml-2">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-bahanmasuk-tab" data-toggle="tab"
                                            href="#nav-bahanmasuk" role="tab" aria-controls="nav-bahanmasuk"
                                            aria-selected="true">Potong Masuk</a>
                                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                            href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                            aria-selected="false">Potong Keluar</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-bahanmasuk" role="tabpanel"
                                    aria-labelledby="nav-bahanmasuk-tab">
                                    <table class="table table-hover" id="tabelbahanmasuk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Bahan</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Jenis Kain</th>
                                                <th scope="col">Warna Kain</th>
                                                <th scope="col">Tanggal Cutting</th>
                                                <th scope="col">Tanggal Selesai</th>
                                                <th scope="col">Surat Jalan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">

                                            @forelse ($masuk as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->bahan->kode_bahan}}</td>
                                                <td>{{$item->bahan->sku}}</td>
                                                <td>{{$item->bahan->jenis_bahan}}</td>
                                                <td>{{$item->bahan->warna}}</td>
                                                <td>{{$item->tanggal_cutting}}</td>
                                                <td>{{$item->tanggal_selesai}}</td>
                                                <td>{{$item->no_surat}}</td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">

                                                            <a class="dropdown-item btndetailmasuk" href="#"
                                                                data-id="{{$item->id}}"><i class="fas fa-eye"></i>
                                                                Detail</a>
                                                            <a class="dropdown-item btnprintmasuk" href="#"
                                                                data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                                Print</a>
                                                            <a class="dropdown-item btneditmasuk" href="#"
                                                                data-id="{{$item->id}}"><i class="fas fa-edit"></i>
                                                                Edit</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa fa-trash"></i>
                                                                Delete</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="nav-keluar" role="tabpanel"
                                    aria-labelledby="nav-keluar-tab">
                                    <table class="table table-hover" id="tabelbahankeluar">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Bahan</th>
                                                <th scope="col">Jenis Kain</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Warna Kain</th>
                                                <th scope="col">Vendor</th>
                                                <th scope="col">Surat Jalan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            {{-- @forelse ($keluar as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                            <td>{{$item->kode_bahan}}</td>
                                            <td>{{$item->jenis_bahan}}</td>
                                            <td>{{$item->sku}}</td>
                                            <td>{{$item->nama_bahan}}</td>
                                            <td>{{$item->warna}}</td>
                                            <td>{{$item->vendor}}</td>
                                            <td>{{$item->no_surat}}</td>
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item btndetailkeluar" href="#"
                                                            data-id="{{$item->id}}"><i class="fas fa-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item btneditkeluar" href="#"
                                                            data-id="{{$item->id}}"><i class="fas fa-edit"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i>
                                                            Delete</a>

                                                    </div>
                                                </div>
                                            </td>
                                            </tr>
                                            @empty

                                            @endforelse --}}



                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Bahan Masuk --}}

    <div class="modal fade" id="potongMasuk" tabindex="-1" role="dialog" aria-labelledby="potongMasukLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="potongMasukLabel">Input Data [Potong Masuk]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formpotongMasuk">
                    <div class="modal-body">
                        <div id="alert-potong-masuk">

                        </div>
                        <input type="hidden" name="status" value="potong masuk">
                        <input type="hidden" name="id" id="idmasuk">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_bahan">Kode Bahan</label>
                                    <div id="kdbahanselectmasuk">
                                        <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                            <option value="">Pilih Kode Bahan</option>
                                            @forelse ($bahan as $item)
                                            <option value="{{$item->id}}">{{$item->kode_bahan}} | {{$item->nama_bahan}}
                                            </option>
                                            @empty

                                            @endforelse


                                        </select>
                                    </div>

                                    <div id="kdbahanmasuk">
                                        <input type="text" class="form-control" readonly
                                        id="kdbahanreadmasuk" name="kdbahanreadmasuk">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" required id="no_surat" name="no_surat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_cutting">Tanggal Cutting</label>
                                    <input type="date" class="form-control" readonly required value="{{date('Y-m-d')}}"
                                        id="tanggal_cutting" name="tanggal_cutting">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control" required id="tanggal_selesai"
                                        name="tanggal_selesai">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kain">Jenis Kain</label>
                                    <input type="text" class="form-control" readonly required id="jenis_kain"
                                        name="jenis_kain">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sku">Kode SKU</label>
                                    <input type="text" class="form-control" readonly required id="sku" name="sku">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="panjang_kain">Panjang kain</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" readonly required id="panjang_kain"
                                            name="panjang_kain">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">yard</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control" readonly required id="nama_produk"
                                        name="nama_produk">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" class="form-control" readonly required id="warna" name="warna">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hasil_cutting">Hasil Cutting</label>
                                            <input type="number" class="form-control" required id="hasil_cutting"
                                                name="hasil_cutting">
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
                                    <input type="number" class="form-control" required id="jumlahs" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-md-2" id="ukuranm">
                                <div class="form-group">
                                    <label for="ukuran">M</label>
                                    <input type="hidden" name="dataukuran[]" value="M">
                                    <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                    <input type="number" class="form-control" required id="jumlahm" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-md-2" id="ukuranl">
                                <div class="form-group">
                                    <label for="ukuran">L</label>
                                    <input type="hidden" name="dataukuran[]" value="L">
                                    <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                    <input type="number" class="form-control" required id="jumlahl" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-md-2" id="ukuranxl">
                                <div class="form-group">
                                    <label for="ukuran">XL</label>
                                    <input type="hidden" name="dataukuran[]" value="XL">
                                    <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                    <input type="number" class="form-control" required id="jumlahxl" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-md-2" id="ukuranxxl">
                                <div class="form-group">
                                    <label for="ukuran">XXL</label>
                                    <input type="hidden" name="dataukuran[]" value="XXL">
                                    <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                    <input type="number" class="form-control" required id="jumlahxxl" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 30px">
                                    <button type="button" class="btn btn-outline-primary" id="btnsize">Tambah
                                        Size</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btnmasuk">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Modal Bahan Keluar --}}

    <div class="modal fade" id="bahanKeluar" tabindex="-1" role="dialog" aria-labelledby="bahanKeluarLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bahanKeluarLabel">Input Data [Bahan Keluar]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formbahanKeluar">
                    <div class="modal-body">
                        <div id="alert-bahan-keluar">

                        </div>
                        <input type="hidden" name="status" value="bahan keluar">
                        <input type="hidden" name="id" id="idkeluar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <div class="kdbahanselect">
                                                {{-- <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                                    <option value="">Pilih Kode Bahan</option>
                                                    @forelse ($masuk as $item)
                                                    <option value="{{$item->id}}">{{$item->kode_bahan}}</option>
                                                @empty

                                                @endforelse


                                                </select> --}}
                                            </div>
                                            <div id="kdbahanreadonly">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" readonly
                                                        id="kode_bahanreadonly" name="kode_bahanreadonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" rea required id="sku" name="sku">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" required readonly id="no_surat_keluar"
                                        name="no_surat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_bahan">Nama Bahan</label>
                                    <input type="text" class="form-control" required readonly id="nama_bahan_keluar"
                                        name="nama_bahan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_bahan">Jenis Bahan</label>
                                    <input type="text" class="form-control" required readonly id="jenis_bahan_keluar"
                                        name="jenis_bahan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" class="form-control" required readonly id="warna_keluar"
                                        name="warna">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="panjang_bahan">Panjang Bahan</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" required readonly
                                            id="panjang_bahan_keluar" name="panjang_bahan">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">yard</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vendor">Vendor</label>
                                    <input type="text" class="form-control" required readonly id="vendor_keluar"
                                        name="vendor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_keluar">Tanggal Keluar</label>
                                    <input type="date" class="form-control" required id="tanggal_keluar" name="tanggal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btnkeluar">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelbahanmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#potongMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#potongMasukLabel').text('Input Data [Potong Masuk]')
                $('#alert-potong-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('#ukuranm').hide()
                $('#ukuranl').hide()
                $('#ukuranxl').hide()
                $('#ukuranxxl').hide()
                $('.btnmasuk').show()
              });

              $('#bahanKeluar').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#bahanKeluarLabel').text('Input Data [Bahan Keluar]')
                $('#alert-bahan-keluar').empty()
                $('.btnkeluar').prop('id','btnsimpankeluar')
                $('.kdbahanselect').show()
                $('#kdbahanreadonly').hide()
                $('.btnkeluar').show()
                $('#kode_bahanreadonly').prop('readonly', true)
                $('#no_surat_keluar').prop('readonly', false)
                $('#sku').prop('readonly', false)
                $('#nama_bahan_keluar').prop('readonly', false)
                $('#jenis_bahan_keluar').prop('readonly', false)
                $('#warna_keluar').prop('readonly', false)
                $('#vendor_keluar').prop('readonly', false)
                $('#tanggal_keluar').prop('readonly', false)
                $('#panjang_bahan_keluar').prop('readonly', false)
              });

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

                var form = $('#formpotongMasuk').serialize()
                ajax()
                $.ajax({
                    url:"{{route('potong.store')}}",
                    method:"POST",
                    data:form
                }).done(function (response) {
                    console.log(response);
                    if(response.status){
                        $('#alert-potong-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-potong-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-potong-masuk').html(response.data)
                        return false;
                    }
                })
             })

             $(document).on('click','.btneditmasuk',function () {
                    var id = $(this).data('id');
                    $('.btnmasuk').prop('id','btnupdatemasuk')
                    $('#potongMasukLabel').text('Edit Data [Potong Masuk]')
                    $('#kdbahanselectmasuk').hide()
                    $('#potongMasuk').modal('show')
                    $('#kdbahanmasuk').show()
                    $.ajax({
                        url:"{{route('potong.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                        console.log(response);
                            if(response.status){
                                var data = response.data;
                                var detail = data.detail_potong;
                                var bahan = data.bahan;

                                $('#idmasuk').val(data.id)
                                $('#kdbahanreadmasuk').val(bahan.kode_bahan)
                                $('#no_surat').val(data.no_surat)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain').val(bahan.jenis_bahan)
                                $('#warna').val(bahan.warna)
                                $('#sku').val(bahan.sku)
                                $('#tanggal_cutting').val(data.tanggal_cutting)
                                $('#tanggal_selesai').val(data.tanggal_selesai)
                                $('#hasil_cutting').val(data.hasil_cutting)
                                $('#konversi').val(data.konversi)
                                $('#panjang_kain').val(bahan.panjang_bahan)

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

            $(document).on('click','#btnupdatemasuk', function () {
                var id = $('#idmasuk').val()
                var form = $('#formpotongMasuk').serialize()

                ajax()
                $.ajax({
                    url:"{{url('production/potong/')}}/"+id,
                    method:"PUT",
                    data:form
                }).done(function (response) {
                    console.log(response);
                    // return false;
                    if(response.status){
                        $('#alert-potong-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-potong-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-potong-masuk').html(response.data)
                        return false;
                    }
                })
             })


             $(document).on('click','.btndetailmasuk',function () {

                    var id = $(this).data('id');

                    $('.btnmasuk').hide()
                    $('#bahanMasukLabel').text('Detail Data [Bahan Masuk]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#bahanMasuk').modal('show')
                    $('#kode_bahan').prop('readonly', true)
                    $('#no_surat').prop('readonly', true)
                    $('#nama_bahan').prop('readonly', true)
                    $('#jenis_bahan').prop('readonly', true)
                    $('#warna').prop('readonly', true)
                    $('#vendor').prop('readonly', true)
                    $('#tanggal_masuk').prop('readonly', true)
                    $('#panjang_bahan').prop('readonly', true)

                    $.ajax({
                        url:"{{route('bahan.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                $('#idmasuk').val(data.id)
                                $('#kode_bahan').val(data.kode_bahan)
                                $('#no_surat').val(data.no_surat)
                                $('#nama_bahan').val(data.nama_bahan)
                                $('#jenis_bahan').val(data.jenis_bahan)
                                $('#warna').val(data.warna)
                                $('#vendor').val(data.vendor)
                                $('#tanggal_masuk').val(data.tanggal_masuk)
                                $('#panjang_bahan').val(data.panjang_bahan)
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

            $(document).on('click','#btnsimpankeluar', function () {

                var form = $('#formbahanKeluar').serialize()
                ajax()
                $.ajax({
                    url:"{{route('bahan.store')}}",
                    method:"POST",
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

            $(document).on('click','.btneditkeluar',function () {
                    var id = $(this).data('id');
                    $('.btnkeluar').prop('id','btnupdatekeluar')
                    $('.kdbahanselect').hide()
                    $('#kdbahanreadonly').show()
                    $('#bahanKeluarLabel').text('Edit Data [Bahan Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#bahanKeluar').modal('show')

                    $.ajax({
                        url:"{{route('bahan.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                $('#idkeluar').val(data.id)
                                $('#kode_bahanreadonly').val(data.kode_bahan)

                                $('#no_surat_keluar').val(data.no_surat)
                                $('#sku').val(data.sku)
                                $('#nama_bahan_keluar').val(data.nama_bahan)
                                $('#jenis_bahan_keluar').val(data.jenis_bahan)
                                $('#warna_keluar').val(data.warna)
                                $('#vendor_keluar').val(data.vendor)
                                $('#tanggal_keluar').val(data.tanggal_keluar)
                                $('#panjang_bahan_keluar').val(data.panjang_bahan)
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
                    $('.kdbahanselect').hide()
                    $('#kdbahanreadonly').show()
                    $('#bahanKeluarLabel').text('Detail Data [Bahan Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#bahanKeluar').modal('show')
                    $('#kode_bahanreadonly').prop('readonly', true)
                    $('#no_surat_keluar').prop('readonly', true)
                    $('#sku').prop('readonly', true)
                    $('#nama_bahan_keluar').prop('readonly', true)
                    $('#jenis_bahan_keluar').prop('readonly', true)
                    $('#warna_keluar').prop('readonly', true)
                    $('#vendor_keluar').prop('readonly', true)
                    $('#tanggal_keluar').prop('readonly', true)
                    $('#panjang_bahan_keluar').prop('readonly', true)
                    $.ajax({
                        url:"{{route('bahan.getdata')}}",
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                $('#kode_bahanreadonly').val(data.kode_bahan)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#sku').val(data.sku)
                                $('#nama_bahan_keluar').val(data.nama_bahan)
                                $('#jenis_bahan_keluar').val(data.jenis_bahan)
                                $('#warna_keluar').val(data.warna)
                                $('#vendor_keluar').val(data.vendor)
                                $('#tanggal_keluar').val(data.tanggal_keluar)
                                $('#panjang_bahan_keluar').val(data.panjang_bahan)
                            }
                    })
              })
     })
</script>
@endpush