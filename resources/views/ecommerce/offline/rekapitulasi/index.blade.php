@extends('ecommerce.offline.master')
@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
        }

        .selectgrey {
            background-color: #E5E5EA;
        }

        .cssnav {
            margin-left: 20px;
        }
    </style>
    <section class="section mt-4">
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ route('offline.rekapitulasi.cetak_semua') }}"
                                class="btn btn-outline-primary rounded ml-1">Cetak Semua <i class="ri-printer-fill"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-right">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control selectgrey" id="bulan">
                                            @forelse ($month as $key => $item)
                                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control selectgrey" id="tahun">
                                            @forelse ($tahun as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('offline.rekapitulasi.show', [$item->id]) }}"><i
                                                                class="ri-eye-fill"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item btnprint"
                                                            href="{{ route('offline.rekapitulasi.cetak', [$item->id]) }}"
                                                            target="_blank"><i class="ri-printer-fill"></i>
                                                            Cetak</a>
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
    <script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
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
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                var tanggal = tahun + '/' + bulan;
                var parseDate = moment(data[6]).format('YYYY/MM')
                tanggal = new Date(tanggal)
                // console.log(tanggal);
                var date = new Date(parseDate);
                if (
                    (bulan == "" || tahun == "") ||
                    (moment(parseDate).isSame(tanggal))
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }


            var table = $('#tabelrekap').DataTable()

            table.on('order.dt search.dt', function() {
                let i = 1;

                table.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            $('#bulan, #tahun').on('change', function() {
                table.draw();
            })

            var tanggal = new Date()
            var bulan = tanggal.getMonth() + 1
            var tahun = tanggal.getFullYear()
            $('#bulan').val(bulan).change()
            $('#tahun').val(tahun).change()

        })
    </script>
@endpush
