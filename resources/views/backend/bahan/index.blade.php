@extends('backend.master')

@section('title', 'Bahan')
@section('title-nav', 'Bahan')
@section('cssnav', 'cssnav')
@section('bahan', 'class=active-sidebar')


@section('content')
    <style>
        .cssnav {
            margin-left: -20px;
        }

        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
            /* width: 10% !important; */
        }

        .left {
            text-align: left;
        }
    </style>
    <div id="non-printable">
        <section class="section mt-4">
            <div class="btn-group">
                <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Input Data <i class="fas fa-plus"></i>
                </button>
                <div class="dropdown-menu">
                    <form action="{{ route('bahan.create') }}" method="get">
                        <input type="hidden" name="status" value="masuk">
                        <button class="dropdown-item">Bahan Masuk</button>
                    </form>

                    <form action="{{ route('bahan.create') }}" method="get">
                        <input type="hidden" name="status" value="keluar">
                        <button class="dropdown-item">Bahan Keluar</button>
                    </form>
                </div>
                <a href="{{ route('print.index') }}" class="btn btn-outline-primary rounded ml-1">Cetak Semua <i
                        class="ri-printer-fill"></i>
                </a>
            </div>
            <div class="section-body mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div>
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-bahanmasuk-tab" data-toggle="tab"
                                                href="#nav-bahanmasuk" role="tab" aria-controls="nav-bahanmasuk"
                                                aria-selected="true">Bahan Masuk</a>
                                            <a class="nav-item nav-link " id="nav-stokbahan-tab" data-toggle="tab"
                                                href="#nav-stokbahan" role="tab" aria-controls="nav-stokbahan"
                                                aria-selected="true">Stok Bahan</a>
                                            <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                                href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                                aria-selected="false">Bahan Keluar</a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-bahanmasuk" role="tabpanel"
                                        aria-labelledby="nav-bahanmasuk-tab">
                                        <table class="table table-hover" id="tabelbahanmasuk">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Bahan</th>
                                                    <th scope="col">Jenis Kain</th>
                                                    <th scope="col">Nama Bahan</th>
                                                    <th scope="col">Warna Kain</th>
                                                    <th scope="col">Vendor</th>
                                                    <th scope="col">Surat Jalan</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">

                                                @forelse ($masuk as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->kode_bahan }}</td>
                                                        <td>{{ $item->jenis_bahan }}</td>
                                                        <td>{{ $item->nama_bahan }}</td>
                                                        <td>{{ $item->warna }}</td>
                                                        <td>{{ $item->vendor }}</td>
                                                        <td>{{ $item->no_surat }}</td>
                                                        <td>{{ $item->panjang_bahan }} yard</td>
                                                        <td>
                                                            <div class="dropdown text-center" style="width: 20%">
                                                                <a class="" href="#" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                </a>
                                                                <div class="dropdown-menu text-center"
                                                                    aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item"
                                                                        href="{{ route('bahan.show', [$item->id]) }}"><i
                                                                            class="ri-eye-fill"></i>
                                                                        Detail</a>

                                                                    <a class="dropdown-item btnprint" href="#"
                                                                        data-id="{{ $item->id }}"><i
                                                                            class="ri-printer-fill"></i>
                                                                        Cetak</a>

                                                                    <a class="dropdown-item"
                                                                        href="{{ route('bahan.edit', [$item->id]) }}"><i
                                                                            class="ri-edit-fill"></i>
                                                                        Edit</a>

                                                                    <a class="dropdown-item hapus"
                                                                        data-id="{{ $item->id }}" href="#"><i
                                                                            class="ri-delete-bin-fill"></i>
                                                                        Hapus</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade show" id="nav-stokbahan" role="tabpanel"
                                        aria-labelledby="nav-stokbahan-tab">
                                        <table class="table table-hover" id="tabelstokbahan">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Bahan</th>
                                                    <th scope="col">Jenis Kain</th>
                                                    <th scope="col">Nama Bahan</th>
                                                    <th scope="col">Tanggal Masuk</th>
                                                    <th scope="col">Sisa Bahan</th>
                                                    <th scope="col">Surat Jalan</th>

                                                    {{-- <th scope="col">Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="">

                                                @forelse ($bahan as $item)
                                                    @if ($item->status == 'bahan masuk')
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->kode_bahan }}</td>
                                                            <td>{{ $item->jenis_bahan }}</td>
                                                            <td>{{ $item->nama_bahan }}</td>
                                                            <td>{{ $item->tanggal_masuk }}</td>
                                                            <td>{{ $item->panjang_bahan }} yard</td>
                                                            <td>{{ $item->no_surat }}</td>
                                                        </tr>
                                                    @elseif ($item->status == 'bahan keluar' && $item->sisa_bahan != null)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->kode_bahan }}</td>
                                                            <td>{{ $item->jenis_bahan }}</td>
                                                            <td>{{ $item->nama_bahan }}</td>
                                                            <td>{{ $item->tanggal_masuk }}</td>
                                                            <td>{{ $item->sisa_bahan }} yard</td>
                                                            <td>{{ $item->no_surat }}</td>
                                                        </tr>
                                                    @endif

                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade" id="nav-keluar" role="tabpanel"
                                        aria-labelledby="nav-keluar-tab">
                                        <table class="table table-hover" id="tabelbahankeluar">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">Kode Bahan</th>
                                                    <th scope="col">Jenis Kain</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Nama Bahan</th>
                                                    <th scope="col">Tanggal Keluar</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Surat Jalan</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @forelse ($keluar as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->kode_transaksi }}</td>
                                                        <td>{{ $item->kode_bahan }}</td>
                                                        <td>{{ $item->jenis_bahan }}</td>
                                                        <td>{{ $item->sku }}</td>
                                                        <td>{{ $item->nama_bahan }}</td>
                                                        <td>{{ $item->tanggal_keluar }}</td>
                                                        <td>{{ $item->panjang_bahan_diambil }} yard</td>
                                                        <td>{{ $item->no_surat }}</td>
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
                                                                        href="{{ route('bahan.show', [$item->id]) }}"><i
                                                                            class="ri-eye-fill"></i>
                                                                        Detail</a>

                                                                    <a class="dropdown-item btnprint" href="#"
                                                                        data-id="{{ $item->id }}"><i
                                                                            class="ri-printer-fill"></i>
                                                                        Cetak</a>

                                                                    <a class="dropdown-item"
                                                                        href="{{ route('bahan.edit', [$item->id]) }}"><i
                                                                            class="ri-edit-fill"></i>
                                                                        Edit</a>

                                                                    <a class="dropdown-item hapus"
                                                                        data-id="{{ $item->id }}" href="#"><i
                                                                            class="ri-delete-bin-fill"></i>
                                                                        Hapus</a>


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

        <!-- Modal -->
        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-12" id="exampleModalLabel">

                            <span id="test" class=" float-right text-dark"> <img
                                    src="{{ asset('assets/img/logo.png') }}" alt="" class="mr-1"
                                    srcset="" width="30">M2N Group</span>
                        </h5>
                    </div>
                    <form action="{{ route('bahan.cetak') }}" target="_blank" method="post">
                        @csrf
                        <div class="modal-body" style="margin-top: -30px; height:35rem">
                            <hr>
                            <input type="hidden" name="id" id="idbahan">
                            <span class="badge badge-primary  rounded"><i class="ri-t-shirt-fill"></i> Bahan</span>
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
        function isSorted(arr) {
            let sorted = true;

            for (let i = 0; i < arr.length - 1; i++) {
                if (arr[i] > arr[i + 1]) {
                    sorted = false;
                    break;
                }
            }
            return sorted;
        }
        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            $('#nav-bahanmasuk-tab').css('background-color', 'black')
            $('#nav-bahanmasuk-tab').css('color', 'white')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $('#nav-stokbahan-tab').css('background-color', '')
            $('#nav-stokbahan-tab').css('color', 'black')

            $('#nav-bahanmasuk-tab').click(function() {
                $(this).css('background-color', 'black')
                $(this).css('color', 'white')
                $('#nav-keluar-tab').css('background-color', '')
                $('#nav-keluar-tab').css('color', 'black')
                $('#nav-stokbahan-tab').css('background-color', '')
                $('#nav-stokbahan-tab').css('color', 'black')
            })

            $('#nav-stokbahan-tab').click(function() {
                $(this).css('background-color', 'black')
                $(this).css('color', 'white')
                $('#nav-keluar-tab').css('background-color', '')
                $('#nav-keluar-tab').css('color', 'black')
                $('#nav-bahanmasuk-tab').css('background-color', '')
                $('#nav-bahanmasuk-tab').css('color', 'black')
            })

            $('#nav-keluar-tab').click(function() {
                $('#nav-bahanmasuk-tab').css('background-color', '')
                $('#nav-bahanmasuk-tab').css('color', 'black')
                $('#nav-stokbahan-tab').css('background-color', '')
                $('#nav-stokbahan-tab').css('color', 'black')
                $(this).css('color', 'white')
                $(this).css('background-color', 'black')
            })

            let t = []
            t.push($('#tabelbahanmasuk').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            }))
            t.push($('#tabelstokbahan').DataTable({
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

            $('#kode_bahanselect').select2()
            $(document).on('click', '.btnprint', function() {
                var id = $(this).data('id')
                $.ajax({
                    url: "{{ route('bahan.getdataprint') }}",
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

                            tbody.html(datahtml)
                            $('#printModal').modal('show')
                        }
                    }
                })
            })

            $(document).on('click', '.hapus', function() {
                var id = $(this).data('id')
                swal({
                        title: "Apa anda yakin?",
                        text: "Ketika dihapus, data tidak bisa dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            ajax()
                            $.ajax({
                                url: "{{ url('production/bahan/') }}/" + id,
                                method: "DELETE",
                                success: function(data) {

                                    if (data.status) {
                                        swal("Maaf, data tidak bisa dihapus!");

                                    } else {
                                        swal("Success! data berhasil dihapus!", {
                                            icon: "success",
                                        });

                                        setTimeout(function() {
                                            location.reload(true)
                                        }, 1500)
                                    }
                                }
                            })

                        }
                    });

            })
        })
    </script>
@endpush
