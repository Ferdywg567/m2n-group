@extends('ecommerce.offline.master')
@section('title', 'Produk')
@section('title-nav', 'Produk')
@section('produk', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')

    <section class="section mt-4">
        <div class="btn-group">
            <a href="{{ route('offline.produk.create') }}" class="btn btn-primary rounded">
                Input Data <i class="fas fa-plus"></i>
            </a>
            <a href="{{ route('offline.cetak_label.index') }}" target="blank"
                class="btn btn-outline-primary rounded ml-1">Cetak
                Barcode <i class="ri-printer-fill"></i>
            </a>
        </div>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <table class="table table-hover" id="tabelproduk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($produk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_produk }}</td>
                                            <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->sku }}</td>
                                            <td>{{ ucwords($item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan) }}
                                            </td>
                                            <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori }}/{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori }}/{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->detail_sub->nama_kategori }}
                                            </td>
                                            <td>{{ $item->stok }}</td>
                                            @if ($item->detail_produk->min('harga') == $item->detail_produk->max('harga'))
                                                <td>@rupiah($item->detail_produk->max('harga'))/pcs</td>
                                            @else
                                                <td>@rupiah($item->detail_produk->min('harga')) - @rupiah($item->detail_produk->max('harga'))/pcs</td>
                                            @endif

                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('offline.produk.show', [$item->id]) }}"><i
                                                                class="ri-eye-fill"></i>
                                                            Detail</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('offline.produk.edit', [$item->id]) }}"><i
                                                                class="ri-edit-fill"></i>
                                                            Edit</a>


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
        })
    </script>
@endpush
