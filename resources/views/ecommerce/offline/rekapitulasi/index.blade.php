@extends('ecommerce.offline.master')
@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')
@section('content')
<style>
    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
    }
</style>
<section class="section mt-4">

    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">

                        <table class="table table-hover" id="tabelrekap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Tgl Transaksi</th>
                                    <th scope="col">Total</th>

                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">

                                @forelse ($transaksi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kode_transaksi}}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @forelse ($item->detail_transaksi as $row)
                                            <li>{{$row->produk->kode_produk}}</li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @forelse ($item->detail_transaksi as $row)
                                            <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}
                                            </li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{$item->qty}} seri</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @forelse ($item->detail_transaksi as $row)
                                            <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}
                                            </li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{$item->tgl_transaksi}}</td>
                                    <td>@rupiah($item->total_harga)</td>
                                    <td>
                                        <div class="dropdown dropleft">
                                            <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{route('offline.rekapitulasi.show',[$item->id])}}"><i
                                                        class="ri-eye-fill"></i>
                                                    Detail</a>
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


              $('#tabelrekap').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })


     })
</script>
@endpush
