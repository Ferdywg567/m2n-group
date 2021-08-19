@extends('backend.master')

@section('title', 'Warehouse')
@section('title-nav', 'Warehouse')

@section('warehouse', 'class=active')

@section('content')
<section class="section mt-2">
    <div class="btn-group">
        <a href="{{route('warehouse.warehouse.create')}}" class="btn btn-primary ">
            Input Data <i class="fas fa-plus"></i>
        </a>
        <a href="{{route('warehouse.print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua  <i class="ri-printer-fill"></i>
        </a>
    </div>
    <div class="section-body mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="tabelmasuk">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Bahan</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Jenis Kain</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Siap Jual</th>
                                    <th scope="col">Harga Jual</th>

                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">

                                @forelse ($warehouse as $item)
                                @php
                                $total = $warehouse->sum(function ($q){
                                return $q->detail_warehouse->sum('jumlah');
                                });
                                @endphp
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}</td>
                                    <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku}}</td>
                                    <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}</td>
                                    <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{$item->harga_produk}}/pcs</td>

                                    <td>
                                        <div class="dropdown dropleft">
                                            <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{route('warehouse.warehouse.show',[$item->id])}}"><i
                                                        class="fas fa-eye"></i>
                                                    Detail</a>
                                                <a class="dropdown-item btnprint" href="#"
                                                    data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                    Print</a>
                                                <a class="dropdown-item"
                                                    href="{{route('warehouse.warehouse.edit',[$item->id])}}"><i
                                                        class="fas fa-edit"></i>
                                                    Edit</a>
                                                <a class="dropdown-item hapus" data-id="{{$item->id}}" href="#"><i
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
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-md-12" id="exampleModalLabel">
                    <span class="float left text-primary" id="title_kode"></span>
                    <span id="test" class=" float-right text-dark"> <img src="{{asset('assets/img/logo.png')}}" alt=""
                            class="mr-1" srcset="" width="30">GARMENT</span></h5>
            </div>
            <form action="{{route('warehouse.warehouse.cetak')}}" target="_blank" method="post">
                @csrf
                <div class="modal-body" style="margin-top: -30px; height:33rem">
                    <hr>
                    <input type="hidden" name="id" id="idbahan">
                    <span class="badge badge-primary  rounded"><i class="ri-home-gear-fill"></i> Warehouse</span>
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

              $(document).on('click','.btnprint' ,function () {
                  var id = $(this).data('id')
                  $.ajax({
                      url:"{{route('warehouse.warehouse.getdataprint')}}",
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
                                    datahtml += '<tr>'
                                        datahtml += '<td>'+element+'</td>'
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
                            url:"{{url('warehouse/warehouse/')}}/"+id,
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

                    } else {

                    }
                    });

               })
     })
</script>
@endpush
