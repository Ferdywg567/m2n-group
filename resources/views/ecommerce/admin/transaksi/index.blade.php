@extends('ecommerce.admin.master')
@section('title', 'Transaksi')
@section('title-nav', 'Transaksi')
@section('transaksi', 'class=active-sidebar')
@section('content')
<style>
    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
        /* width: 10% !important; */
    }

    .left {
        text-align: left;
    }
</style>
<div id="non-printable">
    <section class="section mt-4">

        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-bahanmasuk-tab" data-toggle="tab"
                                            href="#nav-bahanmasuk" role="tab" aria-controls="nav-bahanmasuk"
                                            aria-selected="true">Pesanan Masuk</a>
                                        <a class="nav-item nav-link " id="nav-stokbahan-tab" data-toggle="tab"
                                            href="#nav-stokbahan" role="tab" aria-controls="nav-stokbahan"
                                            aria-selected="true">Diproses</a>
                                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                            href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                            aria-selected="false">Dikirim</a>
                                        <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab"
                                            href="#nav-selesai" role="tab" aria-controls="nav-selesai"
                                            aria-selected="false">Selesai</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-bahanmasuk" role="tabpanel"
                                    aria-labelledby="nav-bahanmasuk-tab">
                                    <table class="table table-hover" id="tabelbahanmasuk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">


                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade show" id="nav-stokbahan" role="tabpanel"
                                    aria-labelledby="nav-stokbahan-tab">
                                    <table class="table table-hover" id="tabelstokbahan">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">


                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="nav-keluar" role="tabpanel"
                                    aria-labelledby="nav-keluar-tab">
                                    <table class="table table-hover" id="tabelbahankeluar">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="nav-selesai" role="tabpanel"
                                aria-labelledby="nav-selesai-tab">
                                <table class="table table-hover" id="tabelbahanselesai">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Kode Produk</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">

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

              $('#nav-bahanmasuk-tab').css('background-color','black')
                  $('#nav-bahanmasuk-tab').css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-stokbahan-tab').css('background-color','')
                  $('#nav-stokbahan-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
              $('#nav-bahanmasuk-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-stokbahan-tab').css('background-color','')
                  $('#nav-stokbahan-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
               })

               $('#nav-stokbahan-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-bahanmasuk-tab').css('background-color','')
                  $('#nav-bahanmasuk-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
               })

               $('#nav-keluar-tab').click(function () {
                  $('#nav-bahanmasuk-tab').css('background-color','')
                  $('#nav-bahanmasuk-tab').css('color','black')
                  $('#nav-stokbahan-tab').css('background-color','')
                  $('#nav-stokbahan-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })

               $('#nav-selesai-tab').click(function () {
                  $('#nav-bahanmasuk-tab').css('background-color','')
                  $('#nav-bahanmasuk-tab').css('color','black')
                  $('#nav-stokbahan-tab').css('background-color','')
                  $('#nav-stokbahan-tab').css('color','black')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })

              $('#tabelbahanmasuk').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#tabelstokbahan').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#tabelbahankeluar').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#tabelbahanselesai').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#kode_bahanselect').select2()
              $(document).on('click','.btnprint' ,function () {
                  var id = $(this).data('id')
                  $.ajax({
                      url:"{{route('bahan.getdataprint')}}",
                      method:"GET",
                      data:{'id':id},
                      success:function(response){
                            if(response.status){
                                $('#idbahan').val(id)
                                var data =response.data
                                var title = data.title
                                var datares = data.data
                                var tbody = $('#dataprint');

                                var datahtml = "";
                                for (let index = 0; index < title.length; index++) {
                                    const element = title[index];

                                    var nilai = datares[index];
                                    if(nilai == null){
                                        nilai = '-'
                                    }
                                    datahtml += '<tr>'
                                        datahtml += '<td class="left">'+element+'</td>'
                                        datahtml += '<td class="text-right">'+nilai+'</td>'
                                    datahtml += '</tr>'
                                }

                                tbody.html(datahtml)
                                $('#printModal').modal('show')
                            }
                      }
                  })
               })

               $(document).on('click','.hapus', function () {
                  var id = $(this).data('id')
                    swal({
                    title: "Apa anda yakin?",
                    text: "Ketika dihapus, data tidak bisa dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        ajax()
                        $.ajax({
                            url:"{{url('production/bahan/')}}/"+id,
                            method:"DELETE",
                            success:function(data){

                                if(data.status){
                                    swal("Maaf, data tidak bisa dihapus!");

                                }else{
                                    swal("Success! data berhasil dihapus!", {
                                    icon: "success",
                                    });

                                    setTimeout(function () {  location.reload(true) },1500)
                                }
                            }
                       })

                    } else {

                    }
                    });

               })
     })
</script>
@endpush
