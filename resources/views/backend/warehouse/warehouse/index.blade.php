@extends('backend.master')

@section('title', 'Warehouse')

@section('warehouse', 'class=active')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <h1>Warehouse</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>Latest Posts</h4> --}}
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="{{route('warehouse.warehouse.create')}}" class="btn btn-primary ">
                                        Input Data <i class="fas fa-plus"></i>
                                    </a>

                                </div>

                                <button class="btn btn-outline-primary">Print Semua <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
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
                                                <a class="" href="#" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu text-center"
                                                    aria-labelledby="dropdownMenuButton">

                                                    <a class="dropdown-item"
                                                        href="{{route('jahit.show',[$item->id])}}"><i
                                                            class="fas fa-eye"></i>
                                                        Detail</a>
                                                    <a class="dropdown-item btnprintmasuk" href="#"
                                                        data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                        Print</a>
                                                    <a class="dropdown-item"
                                                        href="{{route('jahit.edit',[$item->id])}}"><i
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

              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()



     })
</script>
@endpush
