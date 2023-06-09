@extends('backend.master')

@section('title', 'Pembayaran')
@section('title-nav', 'Pembayaran')
@section('pembayaran', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
        }

        .cssnav {
            margin-left: 10px;
        }

        .left {
            text-align: left;
        }
    </style>
    <div id="non-printable">
        <section class="section mt-4">
            <div class="btn-group">
                <a type="button" href="#" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" aria-expanded="false">
                    Input Data <i class="fas fa-plus"></i>
                </a>
                <div class="dropdown-menu">
                    <form action="{{ route('pembayaran.create') }}" method="get">
                        <input type="hidden" name="status" value="jahit">
                        <button class="dropdown-item">Pembayaran Jahit</button>
                    </form>
                    <form action="{{ route('pembayaran.create') }}" method="get">
                        <input type="hidden" name="status" value="cuci">
                        <button class="dropdown-item">Pembayaran Cuci</button>
                    </form>
                </div>
                <a href="{{ route('pembayaran.cetak') }}" target="_blank" class="btn btn-outline-primary rounded ml-1">Unduh
                    Semua <i class="ri-download-2-fill"></i>
                </a>
            </div>
            <div class="section-body mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="ml-2">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab"
                                                href="#nav-masuk" role="tab" aria-controls="nav-masuk"
                                                aria-selected="true">
                                                Jahit</a>
                                            <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab"
                                                href="#nav-selesai" role="tab" aria-controls="nav-selesai"
                                                aria-selected="false"> Cuci</a>

                                        </div>
                                    </nav>
                                </div>
                                <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-masuk" role="tabpanel"
                                        aria-labelledby="nav-masuk-tab">

                                        <table class="table table-hover" id="tabeljahit">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Vendor Jahit</th>
                                                    <th scope="col">Total Bayar</th>
                                                    <th scope="col">Sisa Bayar</th>

                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
                                                @forelse ($jahit as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->potong->bahan->kode_transaksi }}</td>
                                                        <td>{{ $item->potong->bahan->sku }}</td>
                                                        <td>{{ $item->potong->bahan->nama_bahan }}</td>
                                                        <td>{{ $item->nama_vendor }}</td>
                                                        <td>{{ $item->total_bayar }}</td>
                                                        <td>{{ $item->sisa_bayar }}</td>
                                                        <td>
                                                            @if ($item->status_pembayaran == 'Belum Lunas')
                                                                <span
                                                                    class="badge badge-warning text-dark">{{ $item->status_pembayaran }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-success text-dark">{{ $item->status_pembayaran }}</span>
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
                                                                    <form
                                                                        action="{{ route('pembayaran.show', [$item->id]) }}"
                                                                        method="get">
                                                                        <input type="hidden" name="status" value="jahit">
                                                                        <button class="dropdown-item"
                                                                            style="font-size: 12px"><i
                                                                                class="ri-eye-fill"></i>Detail</button>
                                                                    </form>

                                                                    @if ($item->status_pembayaran != 'Lunas')
                                                                        <form
                                                                            action="{{ route('pembayaran.edit', [$item->id]) }}"
                                                                            method="get">
                                                                            <input type="hidden" name="status"
                                                                                value="jahit">
                                                                            <button class="dropdown-item"
                                                                                style="font-size: 12px"><i
                                                                                    class="ri-edit-fill"></i>Pembayaran
                                                                                Baru</button>
                                                                        </form>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-selesai" role="tabpanel"
                                        aria-labelledby="nav-selesai-tab">
                                        <table class="table table-hover" id="tabelcuci">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Vendor Jahit</th>
                                                    <th scope="col">Total Bayar</th>
                                                    <th scope="col">Sisa Bayar</th>

                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
                                                @forelse ($cuci as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->jahit->potong->bahan->kode_transaksi }}</td>
                                                        <td>{{ $item->jahit->potong->bahan->sku }}</td>
                                                        <td>{{ $item->jahit->potong->bahan->nama_bahan }}</td>
                                                        <td>{{ $item->nama_vendor }}</td>
                                                        <td>@rupiah($item->total_bayar)</td>
                                                        <td>@rupiah($item->sisa_bayar)</td>
                                                        <td>
                                                            @if ($item->status_pembayaran == 'Belum Lunas')
                                                                <span
                                                                    class="badge badge-warning text-dark">{{ $item->status_pembayaran }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-success text-dark">{{ $item->status_pembayaran }}</span>
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
                                                                        href="{{ route('pembayaran.show', [$item->id]) }}"><i
                                                                            class="ri-eye-fill"></i>
                                                                        Detail</a>

                                                                    @if ($item->status_pembayaran != 'Lunas')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('pembayaran.edit', [$item->id]) }}"><i
                                                                                class="ri-edit-fill"></i>
                                                                            Pembayaran Baru</a>
                                                                    @endif
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
    </div>

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
            let t = []
            t.push($('#tabeljahit').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            }))
            t.push($('#tabelcuci').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            }))
            t.push($('#tabelkeluar').DataTable())
            $.each(t, function(index, value) {
                value.on('order.dt search.dt', function() {
                    let i = 1;

                    value.cells(null, 0, {
                        search: 'applied',
                        order: 'applied'
                    }).every(function(cell) {
                        this.data(i++);
                    });
                }).draw();
            })

            $('#nav-masuk-tab').css('background-color', 'black')
            $('#nav-masuk-tab').css('color', 'white')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')

            $('#nav-masuk-tab').click(function() {
                $(this).css('background-color', 'black')
                $(this).css('color', 'white')
                $('#nav-keluar-tab').css('background-color', '')
                $('#nav-keluar-tab').css('color', 'black')
                $('#nav-selesai-tab').css('background-color', '')
                $('#nav-selesai-tab').css('color', 'black')
            })

            $('#nav-keluar-tab').click(function() {
                $('#nav-masuk-tab').css('background-color', '')
                $('#nav-masuk-tab').css('color', 'black')
                $('#nav-selesai-tab').css('background-color', '')
                $('#nav-selesai-tab').css('color', 'black')
                $(this).css('color', 'white')
                $(this).css('background-color', 'black')
            })


            $('#nav-selesai-tab').click(function() {
                $('#nav-masuk-tab').css('background-color', '')
                $('#nav-masuk-tab').css('color', 'black')
                $('#nav-keluar-tab').css('background-color', '')
                $('#nav-keluar-tab').css('color', 'black')
                $(this).css('color', 'white')
                $(this).css('background-color', 'black')
            })

            $(document).on('click', '.btnprint', function() {
                var id = $(this).data('id')
                $.ajax({
                    url: "{{ route('potong.getdataprint') }}",
                    method: "GET",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#idpotong').val(id)
                            var data = response.data
                            var title = data.title
                            var datares = data.data
                            var tbody = $('#dataprint');

                            var datahtml = "";
                            for (let index = 0; index < title.length; index++) {
                                const element = title[index];
                                var nilai = datares[index];
                                if (nilai == null) {
                                    nilai = '-'
                                }
                                datahtml += '<tr>'
                                datahtml += '<td class="left">' + element + '</td>'
                                datahtml += '<td class="text-right">' + nilai + '</td>'
                                datahtml += '</tr>'
                            }
                            var kode = data.kode_bahan;
                            $('#title_kode').text(kode)
                            tbody.html(datahtml)
                            $('#printModal').modal('show')
                        }
                    }
                })
            })
        })
    </script>
@endpush
