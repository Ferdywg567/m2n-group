@extends('backend.master')

@section('title', 'Sampah')
@section('title-nav', 'Sampah')
@section('sampah', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
  

    .dropdown-menu {
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
        <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i
                class="ri-printer-fill"></i>
        </a>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-hover" id="tabelbahanmasuk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Tgl. Masuk</th>
                                        <th scope="col">Asal</th>
                                        <th scope="col">Jumlah</th>

                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($sampah as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        @if ($item->asal == 'cuci')
                                        <td>{{$item->cuci->jahit->potong->bahan->kode_transaksi}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->sku}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                        <td>{{$item->tanggal_masuk}}</td>
                                        <td>{{$item->asal}} </td>
                                        <td>{{$item->total}} pcs</td>
                                        @else
                                        <td>{{$item->jahit->potong->bahan->kode_transaksi}}</td>
                                        <td>{{$item->jahit->potong->bahan->sku}}</td>
                                        <td>{{$item->jahit->potong->bahan->nama_bahan}}</td>
                                        <td>{{$item->tanggal_masuk}}</td>
                                        <td>{{$item->asal}} </td>
                                        <td>{{$item->total}} pcs</td>
                                        @endif

                                        <td>
                                            <a href="{{route('sampah.show',[$item->id])}}"
                                                class="btn btn-outline-primary">Detail</a>
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
