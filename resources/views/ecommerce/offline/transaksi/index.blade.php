@extends('ecommerce.offline.master')
@section('title', 'Transaksi')
@section('title-nav', 'Transaksi')
@section('transaksi', 'class=active-sidebar')
@section('content')
    <style>
        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
        }
    </style>
    <section class="section mt-4">
        <div class="btn-group">
            <a href="{{ route('offline.transaksi.create') }}" class="btn btn-primary rounded">
                Input Data <i class="fas fa-plus"></i>
            </a>
        </div>
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

                                    </tr>
                                </thead>
                                <tbody id="">

                                    @forelse ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_transaksi }}</td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @forelse ($item->detail_transaksi as $row)
                                                        <li>{{ $row->produk->kode_produk }}</li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @forelse ($item->detail_transaksi as $row)
                                                        <li>{{ $row->produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan }}
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>{{ $item->qty }} seri</td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @forelse ($item->detail_transaksi as $row)
                                                        <li>{{ $row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku }}
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>{{ $item->tgl_transaksi }}</td>
                                            <td>@rupiah($item->total_harga)</td>

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
        $.extend(true, $.fn.dataTable.defaults, {
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
            }, ],
            order: [
                [1, 'asc']
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        });

        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }


            let dt_tabelrekap = $('#tabelrekap').DataTable()

            dt_tabelrekap.on('order.dt search.dt', function() {
                let i = 1;

                dt_tabelrekap.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        })
    </script>
@endpush
