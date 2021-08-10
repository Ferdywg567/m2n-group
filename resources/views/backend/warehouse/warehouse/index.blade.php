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
                                        <th scope="col">Tanggal Warehouse</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Vendor Warehouse</th>
                                        <th scope="col">Warehouse Sukses</th>
                                        <th scope="col">Surat Jalan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                    {{-- @forelse ($jahitmasuk as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->potong->bahan->kode_bahan}}</td>
                                        <td>{{$item->potong->bahan->sku}}</td>
                                        <td>{{$item->tanggal_jahit}}</td>
                                        <td>{{$item->tanggal_selesai}}</td>
                                        <td>{{$item->vendor}}</td>
                                        <td>-</td>

                                        <td>{{$item->no_surat}}</td>
                                        <td>
                                            @if ($item->status_jahit == 'belum jahit')
                                            <span
                                                class="badge badge-secondary text-dark">{{$item->status_jahit}}</span>
                                            @elseif ($item->status_jahit == 'selesai')
                                            <span
                                                class="badge badge-success text-dark">{{$item->status_jahit}}</span>
                                            @else
                                            <span
                                                class="badge badge-warning text-dark">{{$item->status_jahit}}</span>
                                            @endif
                                        </td>
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

                                    @endforelse --}}

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
