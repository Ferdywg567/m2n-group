@extends('ecommerce.admin.master')
@section('title', 'Promo')
@section('title-nav', 'Promo')
@section('cssnav', 'cssnav')
@section('promo', 'class=active-sidebar')
@section('content')
    <style>
        .cssnav {
            margin-left: -20px;
        }

        .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 100% !important;
        }
    </style>
    <section class="section mt-4">
        <div class="btn-group">
            <a href="{{ route('ecommerce.promo.create') }}" class="btn btn-primary rounded">
                Input Data <i class="fas fa-plus"></i>
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
                                        <th scope="col">Kode Promo</th>
                                        <th scope="col">Nama Promo</th>
                                        <th scope="col">Potongan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($promo as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->potongan }} %</td>
                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('ecommerce.promo.show', [$item->id]) }}"><i
                                                                class="ri-eye-fill"></i>
                                                            Detail</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('ecommerce.promo.edit', [$item->id]) }}"><i
                                                                class="ri-edit-fill"></i>
                                                            Edit</a>

                                                        <a class="dropdown-item hapus" data-id="{{ $item->id }}"
                                                            href="#"><i class="ri-delete-bin-fill"></i>
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
