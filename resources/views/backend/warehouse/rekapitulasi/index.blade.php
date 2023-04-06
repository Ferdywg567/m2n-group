@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        .cssnav {
            margin-left: 10px;
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
    <div id="non-printable">
        <section class="section mt-4">
            <div class="btn-group">
                {{-- <a href="{{route('warehouse.rekapitulasi.create')}}" class="btn btn-primary rounded">
            Input Data <i class="fas fa-plus"></i>
            </a> --}}
                <a href="{{ route('warehouse.print.index') }}" class="btn btn-outline-primary rounded ml-1">Cetak Semua <i
                        class="ri-printer-fill"></i>
                </a>
            </div>
            <div class="section-body mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <table class="table table-hover" id="tabelbahanmasuk">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Jenis Bahan</th>

                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Warna</th>
                                            <th scope="col">Diretur</th>
                                            <th scope="col">Dibuang</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @forelse ($rekap as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->kode_transaksi }}
                                                </td>
                                                <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->sku }}
                                                </td>
                                                <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan }}
                                                </td>
                                                <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan }}
                                                </td>
                                                <td>{{ $item->warehouse->finishing->cuci->jahit->potong->bahan->warna }}
                                                </td>
                                                <td>{{ $item->jumlah_diretur }} pcs
                                                </td>
                                                <td>{{ $item->jumlah_dibuang }} pcs
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
                                                                href="{{ route('warehouse.rekapitulasi.show', [$item->id]) }}"><i
                                                                    class="ri-eye-fill"></i>
                                                                Detail</a>
                                                            <a class="dropdown-item btnprint" href="#"
                                                                data-id="{{ $item->id }}"><i
                                                                    class="ri-printer-fill"></i>
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
                            <span id="test" class=" float-right text-dark"> <img
                                    src="{{ asset('assets/img/logo.png') }}" alt="" class="mr-1" srcset=""
                                    width="30">GARMENT</span>
                        </h5>
                    </div>
                    <form action="{{ route('warehouse.rekapitulasi.cetak') }}" target="_blank" method="post">
                        @csrf
                        <div class="modal-body" style="margin-top: -30px; height:40rem">
                            <hr>
                            <input type="hidden" name="id" id="idbahan">
                            <span class="badge badge-primary  rounded"><i class="ri-booklet-fill"></i> Rekapitulasi</span>
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
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let t = []
            t.push($('#tabelbahanmasuk').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            }))
            t.push($('#tabelbahankeluar').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            }))
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

            $(document).on('click', '.btnprint', function() {
                var id = $(this).data('id')
                $.ajax({
                    url: "{{ route('warehouse.rekapitulasi.getdataprint') }}",
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
