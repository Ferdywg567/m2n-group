@extends('backend.master')

@section('title', 'Kategori')
@section('title-nav', 'Kategori')
@section('kategori', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -20px;
    }

    .dropdown-menu-custom {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .left {
        text-align: left;
    }
</style>
<div id="non-printable">
    <section class="section mt-4">
        <div class="btn-group">
            <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Input Data <i class="fas fa-plus"></i>
            </button>
            <div class="dropdown-menu">
                <form action="{{route('kategori.create')}}" method="get">
                    <input type="hidden" name="status" value="kategori">
                    <button class="dropdown-item">Kategori</button>
                </form>
                <form action="{{route('kategori.create')}}" method="get">
                    <input type="hidden" name="status" value="Sub Kategori">
                    <button class="dropdown-item">Sub Kategori</button>
                </form>
                <form action="{{route('kategori.create')}}" method="get">
                    <input type="hidden" name="status" value="Detail Sub Kategori">
                    <button class="dropdown-item">Detail Sub Kategori</button>
                </form>
            </div>
        </div>


        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="ml-2">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab"
                                            href="#nav-masuk" role="tab" aria-controls="nav-masuk"
                                            aria-selected="true">Kategori</a>
                                        <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab"
                                            href="#nav-selesai" role="tab" aria-controls="nav-selesai"
                                            aria-selected="false">Sub Kategori</a>
                                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                            href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                            aria-selected="false">Detail Sub Kategori</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-masuk" role="tabpanel"
                                    aria-labelledby="nav-masuk-tab">
                                    <table class="table table-hover" id="tabelmasuk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @forelse ($kategori as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->nama_kategori}}</td>
                                                <td>{{$item->sku}}</td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center dropdown-menu-custom"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <form action="{{route('kategori.edit',[$item->id])}}"
                                                                method="get" id="edit_kategori">
                                                                <input type="hidden" name="status" value="kategori">
                                                                <a href="#"
                                                                    onclick="event.preventDefault(); document.getElementById('edit_kategori').submit();"
                                                                    class="dropdown-item"><i
                                                                        class="ri-edit-fill"></i>Edit</a>
                                                            </form>
                                                            <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                                href="#"><i class="ri-delete-bin-fill"></i>
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
                                <div class="tab-pane fade" id="nav-selesai" role="tabpanel"
                                    aria-labelledby="nav-selesai-tab">
                                    <table class="table table-hover" id="tabelbahanselesai">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Sub Kategori</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @forelse ($sub as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->kategori->nama_kategori}}</td>
                                                <td>{{$item->nama_kategori}}</td>
                                                <td>{{$item->sku}}</td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center dropdown-menu-custom"
                                                            aria-labelledby="dropdownMenuButton">


                                                            <a class="dropdown-item"
                                                                href="{{route('jahit.edit',[$item->id])}}"><i
                                                                    class="ri-edit-fill"></i>
                                                                Edit</a>

                                                            <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                                href="#"><i class="ri-delete-bin-fill"></i>
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
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Sub Kategori</th>
                                                <th scope="col">Detail Sub Kategori</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @forelse ($detail as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->sub_kategori->kategori->nama_kategori}}</td>
                                                <td>{{$item->sub_kategori->nama_kategori}}</td>
                                                <td>{{$item->nama_kategori}}</td>
                                                <td>{{$item->sku}}</td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center dropdown-menu-custom"
                                                            aria-labelledby="dropdownMenuButton">


                                                            <a class="dropdown-item"
                                                                href="{{route('jahit.edit',[$item->id])}}"><i
                                                                    class="ri-edit-fill"></i>
                                                                Edit</a>

                                                            <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                                href="#"><i class="ri-delete-bin-fill"></i>
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-md-12" id="exampleModalLabel">
                        <span class="float left text-primary" id="title_kode"></span>
                        <span id="test" class=" float-right text-dark"> <img src="{{asset('assets/img/logo.png')}}"
                                alt="" class="mr-1" srcset="" width="30">GARMENT</span></h5>
                </div>
                <form action="{{route('jahit.cetak')}}" target="_blank" method="post">
                    @csrf
                    <div class="modal-body" style="margin-top: -30px; height:40rem">
                        <hr>
                        <input type="hidden" name="id" id="idjahit">
                        <span class="badge badge-primary  rounded"><i class="fas fa-user-cog"></i> Tailoring</span>
                        <table class="table">
                            <tbody id="dataprint">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#tabelbahanselesai').DataTable()
              $('#nav-masuk-tab').css('background-color','black')
                  $('#nav-masuk-tab').css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')

              $('#nav-masuk-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
               })

               $('#nav-keluar-tab').click(function () {
                  $('#nav-masuk-tab').css('background-color','')
                  $('#nav-masuk-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })


               $('#nav-selesai-tab').click(function () {
                  $('#nav-masuk-tab').css('background-color','')
                  $('#nav-masuk-tab').css('color','black')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })
              $(document).on('click','.btnprint' ,function () {
                  var id = $(this).data('id')
                  $.ajax({
                      url:"{{route('jahit.getdataprint')}}",
                      method:"GET",
                      data:{'id':id},
                      success:function(response){
                            if(response.status){
                                $('#idjahit').val(id)
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
                                var kode = data.kode_bahan;
                                $('#title_kode').text(kode)
                                tbody.html(datahtml)
                                $('#printModal').modal('show')
                            }
                      }
                  })
               })

              $(document).on('click','.hapus', function () {
                  var id = $(this).data('id')
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        ajax()
                        $.ajax({
                            url:"{{url('production/jahit/')}}/"+id,
                            method:"DELETE",
                            success:function(data){

                                if(data.status){
                                    swal("Sorry, cant delete this file!");

                                }else{
                                    swal("Success! Your imaginary file has been deleted!", {
                                    icon: "success",
                                    });

                                    setTimeout(function () {  location.reload(true) },1500)
                                }
                            }
                       })

                    }
                    });

               })
     })
</script>
@endpush
