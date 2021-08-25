@extends('backend.master')

@section('title', 'SKU')
@section('title-nav', 'SKU')
@section('sku', 'class=active-sidebar')
@section('cssnav', 'cssnav')
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

    .cssnav {
        margin-left: -30px;
    }

</style>
<div id="non-printable">
    <section class="section mt-4">
        <div class="btn-group">
            <a href="{{route('sku.create')}}" class="btn btn-primary ">
                Input Data <i class="fas fa-plus"></i>
            </a>
            <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i class="ri-printer-fill"></i>
            </a>
        </div>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover" id="tabelbahanmasuk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Jenis Bahan</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col">Ukuran</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($sku as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->kode_sku}}</td>
                                        <td>{{$item->nama_produk}}</td>
                                        <td>{{$item->warna}}</td>
                                        <td>{{$item->jenis_bahan}}</td>
                                        <td>{{$item->ukuran}}</td>
                                        <td>
                                            <div class="dropdown text-center" style="width: 20%">
                                                <a class="" href="#" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu text-center"
                                                    aria-labelledby="dropdownMenuButton">

                                                    <a class="dropdown-item"
                                                        href="{{route('sku.show',[$item->id])}}"><i
                                                            class="ri-eye-fill"></i>
                                                        Detail</a>

                                                    <a class="dropdown-item"
                                                        href="{{route('sku.edit',[$item->id])}}"><i
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
              $('#tabelbahanmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
     })
</script>
@endpush
