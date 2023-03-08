@extends('ecommerce.offline.master')
@section('title', 'Beranda')
@section('title-nav', 'Beranda')
@section('dashboard', 'class=active-sidebar')
@section('content')
    <section class="section mt-4">

        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <table class="table table-hover" id="tabelproduk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Tgl Transaksi</th>

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
                                                        <li>{{ $row->produk->nama_produk }}</li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @forelse ($item->detail_transaksi as $row)
                                                        <li>{{ $row->jumlah }} seri</li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @forelse ($item->detail_transaksi as $row)
                                                        <li>{{ $row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku }}
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </td>
                                            <td>@rupiah($item->total_harga)</td>
                                            <td>{{ date('j F Y', strtotime($item->tgl_transaksi)) }}</td>
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


            let dt_tabelproduk = $('#tabelproduk').DataTable()

            dt_tabelproduk.on('order.dt search.dt', function() {
                let i = 1;

                dt_tabelproduk.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            history.pushState(null, null, '<?php echo $_SERVER['REQUEST_URI']; ?>');
            window.addEventListener('popstate', function(event) {
                window.location.assign("{{ route('offline.dashboard.index') }}");
            });

        })
    </script>
@endpush
