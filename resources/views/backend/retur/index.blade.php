@extends('backend.master')

@section('title', 'Retur')
@section('title-nav', 'Retur')
@section('retur', 'class=active-sidebar')

@section('cssnav', 'cssnav')
@section('content')
    <style>
        .cssnav {
            margin-left: -25px;
        }

        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
        }

        .left {
            text-align: left;
        }
    </style>
    <section class="section mt-4">
        <a href="{{ route('print.index') }}" class="btn btn-outline-primary rounded ml-1">Cetak Semua <i
                class="ri-printer-fill"></i>
        </a>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-hover" id="tableretur">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tgl Masuk</th>

                                        <th scope="col">Warna</th>

                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                    @forelse ($retur as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->finishing->cuci->jahit->potong->bahan->kode_transaksi }}</td>
                                            <td>{{ $item->finishing->cuci->jahit->potong->bahan->sku }}</td>
                                            <td>{{ $item->finishing->cuci->jahit->potong->bahan->tanggal_masuk }}</td>

                                            <td>{{ $item->finishing->cuci->jahit->potong->bahan->warna }}</td>

                                            <td>{{ $item->total_barang }} pcs</td>
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('retur.show', [$item->id]) }}"><i
                                                                class="fas fa-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item btnprint" href="#"
                                                            data-id="{{ $item->id }}"><i class="fas fa-print"></i>
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
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-md-12" id="exampleModalLabel">
                        <span class="float left text-primary" id="title_kode"></span>
                        <span id="test" class=" float-right text-dark"> <img src="{{ asset('assets/img/logo.png') }}"
                                alt="" class="mr-1" srcset="" width="30">GARMENT</span>
                    </h5>
                </div>
                <form action="{{ route('retur.cetak') }}" target="_blank" method="post">
                    @csrf
                    <div class="modal-body" style="margin-top: -30px; height:40rem">
                        <hr>
                        <input type="hidden" name="id" id="idbahan">
                        <span class="badge badge-primary  rounded"><i class="ri-logout-box-fill"></i> Retur</span>
                        <table class="table">
                            <tbody id="dataprint">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i> Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

            let dt_tableretur = $('#tableretur').DataTable()

            dt_tableretur.on('order.dt search.dt', function() {
                let i = 1;

                dt_tableretur.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            $(document).on('click', '.btnprint', function() {
                var id = $(this).data('id')
                $.ajax({
                    url: "{{ route('retur.getdataprint') }}",
                    method: "GET",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#idbahan').val(id)
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
