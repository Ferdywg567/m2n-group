@extends('backend.master')

@section('title', 'Perbaikan')
@section('title-nav', 'Perbaikan')
@section('perbaikan', 'class=active-sidebar')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .left{
        text-align: left;
    }
</style>
<div id="non-printable">
    <section class="section mt-4">
        <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Cetak Semua <i class="ri-printer-fill"></i>
        </a>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-hover" id="tabelperbaikan">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Bahan</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Barang Repair</th>
                                        <th scope="col">Surat Jalan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                    @forelse ($repair as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->bahan->kode_bahan}}</td>
                                        <td>{{$item->bahan->sku}}</td>
                                        <td>{{$item->tanggal_masuk}}</td>
                                        <td>{{$item->total}}</td>
                                        <td>{{$item->bahan->no_surat}}</td>
                                        <td>
                                            @php
                                                $status = strtoupper($item->status)
                                            @endphp
                                            @if ($item->status == 'butuh konfirmasi')
                                            <a href="{{route('perbaikan.edit',[$item->id])}}"> <span class="badge badge-secondary text-dark"
                                                    style="cursor: pointer">{{$status}}</span></a>

                                            @elseif ($item->status == 'selesai')
                                            <span class="badge badge-success text-dark">{{$status}}</span>
                                            @else
                                            <span class="badge badge-warning text-dark">{{$status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('perbaikan.show',[$item->id])}}" class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>

                        </div>
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
              $('#ukuranm').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelperbaikan').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#perbaikanMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#perbaikanMasukLabel').text('Input Data [perbaikan Masuk]')
                $('#alert-perbaikan-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('.btnmasuk').show()
                $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              });

              $('#perbaikanKeluar').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#perbaikanKeluarLabel').text('Input Data [perbaikan Keluar]')
                $('#alert-perbaikan-keluar').empty()
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

                var form = $('#formperbaikanMasuk').serialize()
                ajax()
                $.ajax({
                    url:"{{route('perbaikan.store')}}",
                    method:"POST",
                    data:form
                }).done(function (response) {
                    console.log(response);
                    if(response.status){
                        $('#alert-perbaikan-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-perbaikan-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-perbaikan-masuk').html(response.data)
                        return false;
                    }
                })
             })

             $(document).on('click','.btneditmasuk',function () {
                    var id = $(this).data('id');
                    $('.btnmasuk').prop('id','btnupdatemasuk')
                    $('#perbaikanMasukLabel').text('Edit Data [perbaikan Masuk]')
                    $('#kdbahanselectmasuk').hide()
                    $('#perbaikanMasuk').modal('show')
                    $('#kdbahanmasuk').show()
                    $.ajax({
                        //
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                        console.log(response);
                            if(response.status){
                                var data = response.data;
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
                                $('#panjang_kain').val(bahan.panjang_bahan)

                            }
                    })
              })

            $(document).on('click','#btnupdatemasuk', function () {
                var id = $('#idmasuk').val()
                var form = $('#formperbaikanMasuk').serialize()

                ajax()
                $.ajax({
                    url:"{{url('production/perbaikan/')}}/"+id,
                    method:"PUT",
                    data:form
                }).done(function (response) {

                    if(response.status){
                        $('#alert-perbaikan-masuk').html(response.data)
                        setTimeout(function(){
                            $('#alert-perbaikan-masuk').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-perbaikan-masuk').html(response.data)
                        return false;
                    }
                })
             })


             $(document).on('click','.btndetailmasuk',function () {

                    var id = $(this).data('id');

                    $('.btnmasuk').hide()
                    $('#perbaikanMasukLabel').text('Detail Data [Bahan Masuk]')
                    $('#kdbahanselectmasuk').hide()
                    $('#perbaikanMasuk').modal('show')
                    $('#kdbahanmasuk').show()
                    $('#kdbahanreadmasuk').prop('readonly', true)
                    $('#no_surat').prop('readonly', true)
                    $('#tanggal_cutting').prop('readonly', true)
                    $('#tanggal_selesai').prop('readonly', true)


                    $.ajax({
                        //
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
                            //
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

                var form = $('#formperbaikanKeluar').serialize()
                ajax()
                $.ajax({
                    url:"{{route('perbaikan.store')}}",
                    method:"POST",
                    data:form
                }).done(function (response) {
                    if(response.status){
                        $('#alert-perbaikan-keluar').html(response.data)
                        setTimeout(function(){
                            $('#alert-perbaikan-keluar').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-perbaikan-keluar').html(response.data)
                        return false;
                    }
                })
            })

            $(document).on('click','.btneditkeluar',function () {
                    var id = $(this).data('id');
                    $('.btnkeluar').prop('id','btnupdatekeluar')
                    $('#kdbahanselectkeluar').hide()
                    $('#kdbahankeluar').show()
                    $('#perbaikanKeluarLabel').text('Edit Data [perbaikan Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#perbaikanKeluar').modal('show')

                    $.ajax({
                        //
                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var bahan = data.bahan;
                                var detail = data.detail_perbaikan
                                $('#idkeluar').val(data.id)
                                $('#kdbahanreadkeluar').val(bahan.kode_bahan)
                                $('#no_surat_keluar').val(data.no_surat)
                                $('#nama_produk_keluar').val(bahan.nama_bahan)
                                $('#jenis_kain_keluar').val(bahan.jenis_bahan)
                                $('#warna_keluar').val(bahan.warna)
                                $('#sku_keluar').val(bahan.sku)
                                $('#tanggal_keluar').val(data.tanggal_keluar)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)
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
                var form = $('#formperbaikanKeluar').serialize()
                ajax()
                $.ajax({
                    url:"{{url('production/perbaikan/')}}/"+id,
                    method:"PUT",
                    data:form
                }).done(function (response) {
                    if(response.status){
                        $('#alert-perbaikan-keluar').html(response.data)
                        setTimeout(function(){
                            $('#alert-perbaikan-keluar').empty()
                            location.reload(true)
                        },1500)


                    }else{
                        $('#alert-perbaikan-keluar').html(response.data)
                        return false;
                    }
                })
             })

             $(document).on('click','.btndetailkeluar',function () {
                    var id = $(this).data('id');
                    $('.btnkeluar').hide()
                    $('#kdbahanselectkeluar').hide()
                    $('#kdbahankeluar').show()
                    $('#perbaikanKeluarLabel').text('Detail Data [perbaikan Keluar]')
                    $('#kode_bahan').prop('readonly', true)
                    $('#perbaikanKeluar').modal('show')

                    $('#tanggal_keluar').prop('readonly', true)
                    $('#no_surat_keluar').prop('readonly', true)
                    $('#hasil_cutting').prop('readonly', true)

                    $.ajax({

                        method:"GET",
                        data:{
                            'id':id
                        }

                    }).done(function (response) {
                            if(response.status){
                                var data = response.data;
                                var bahan = data.bahan;
                                var detail = data.detail_perbaikan

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
