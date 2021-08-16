@extends('backend.master')

@section('title', 'Finishing')
@section('title-nav', 'Finishing')
@section('finishing', 'class=active')
@section('content')
<section class="section  mt-5">
    <div class="btn-group">
        <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Input Data <i class="fas fa-plus"></i>
        </button>
        <div class="dropdown-menu">
            <form action="{{route('warehouse.finishing.create')}}" method="get">
                <input type="hidden" name="status" value="masuk">
                <button class="dropdown-item">Finishing</button>
            </form>

            <form action="{{route('warehouse.finishing.create')}}" method="get">
                <input type="hidden" name="status" value="keluar">
                <button class="dropdown-item">Kirim Warehouse</button>
            </form>

        </div>
        <a href="{{route('warehouse.print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i
                class="fas fa-print"></i>
        </a>
    </div>
    <div class="section-body mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="ml-2">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab"
                                        href="#nav-masuk" role="tab" aria-controls="nav-masuk"
                                        aria-selected="true">Finishing</a>
                                    <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                        href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                        aria-selected="false">Kirim Warehouse</a>
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
                                            <th scope="col">Kode Bahan</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Jenis Kain</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Ukuran</th>
                                            <th scope="col">Tgl Masuk</th>
                                            <th scope="col">Tgl Finishing</th>
                                            <th scope="col">Berhasil Finishing</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">

                                        @forelse ($finish as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->sku}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}
                                            </td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                            <td>
                                                @php
                                                $ukuran = '';

                                                @endphp

                                                @forelse ($item->detail_finish as $key => $row)
                                                @php
                                                $ukuran .= $row->ukuran . ', ';
                                                @endphp
                                                @empty

                                                @endforelse
                                                {{rtrim($ukuran,", ")}}
                                            </td>
                                            <td>{{$item->tanggal_masuk}}</td>
                                            <td>{{$item->tanggal_qc}}</td>
                                            <td>{{$item->barang_lolos_qc}}/{{$item->rekapitulasi->total_barang}}
                                            </td>
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.show',[$item->id])}}"><i
                                                                class="fas fa-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item btnprint" href="#"
                                                            data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                            Print</a>
                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.edit',[$item->id])}}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                            href="#"><i class="fa fa-trash"></i>
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
                            <div class="tab-pane fade" id="nav-keluar" role="tabpanel" aria-labelledby="nav-keluar-tab">
                                <table class="table table-hover" id="tabelbahankeluar">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Bahan</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Jenis Kain</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Ukuran</th>
                                            <th scope="col">Tgl Masuk</th>
                                            <th scope="col">Tgl Finishing</th>
                                            <th scope="col">Berhasil Finishing</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @forelse ($kirim as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->sku}}</td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}
                                            </td>
                                            <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                            <td>
                                                @php
                                                $ukuran = '';

                                                @endphp

                                                @forelse ($item->detail_finish as $key => $row)
                                                @php
                                                $ukuran .= $row->ukuran . ', ';
                                                @endphp
                                                @empty

                                                @endforelse
                                                {{rtrim($ukuran,", ")}}
                                            </td>
                                            <td>{{$item->tanggal_masuk}}</td>
                                            <td>{{$item->tanggal_qc}}</td>
                                            <td>{{$item->barang_lolos_qc}}/{{$item->rekapitulasi->total_barang}}</td>
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.show',[$item->id])}}"><i
                                                                class="fas fa-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item btnprint" href="#"
                                                            data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                            Print</a>
                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.edit',[$item->id])}}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                            href="#"><i class="fa fa-trash"></i>
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
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-md-12" id="exampleModalLabel">

                    <span id="test" class=" float-right text-dark"> <img src="{{asset('assets/img/logo.png')}}" alt=""
                            class="mr-1" srcset="" width="30">GARMENT</span></h5>
            </div>
            <form action="{{route('warehouse.finishing.cetak')}}" target="_blank" method="post">
                @csrf
                <div class="modal-body" style="margin-top: -30px; height:50rem">
                    <hr>
                    <input type="hidden" name="id" id="idbahan">
                    <span class="badge badge-primary  rounded"><i class="ri-t-shirt-fill"></i> Material</span>
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
                      url:"{{route('warehouse.finishing.getdataprint')}}",
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

                                tbody.html(datahtml)
                                $('#printModal').modal('show')
                            }
                      }
                  })
               })
     })
</script>
@endpush
