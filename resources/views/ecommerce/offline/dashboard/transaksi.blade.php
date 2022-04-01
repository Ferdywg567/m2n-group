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
        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }


            $('#tabelproduk').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            })


        })
    </script>
@endpush
