@extends('ecommerce.admin.master')
@section('title', 'Bank')
@section('title-nav', 'Bank')
@section('bank', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        .cssnav {
            margin-left: -20px;
        }
    </style>

    <section class="section mt-4">
        <div class="btn-group">
            <a href="{{ route('ecommerce.bank.create') }}" class="btn btn-primary rounded">
                Input Data <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <table class="table table-hover" id="tabelbank">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bank</th>
                                        <th scope="col">Nomor Rekening</th>
                                        <th scope="col">Nama Penerima</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($bank as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_bank }}</td>
                                            <td>{{ $item->nomor_rekening }}</td>
                                            <td>{{ $item->nama_penerima }}</td>
                                            <td style="width: 100px;">
                                                <img src="{{ asset('uploads/images/bank/' . $item->logo) }}"
                                                    style="width: 100px;" alt="" srcset="">
                                            </td>

                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">
                                                        {{-- <a class="dropdown-item"
                                                    href="{{route('ecommerce.bank.show',[$item->id])}}"><i
                                                        class="ri-eye-fill"></i>
                                                    Detail</a> --}}

                                                        <a class="dropdown-item"
                                                            href="{{ route('ecommerce.bank.edit', [$item->id]) }}"><i
                                                                class="ri-edit-fill"></i>
                                                            Edit</a>

                                                        {{-- <a class="dropdown-item hapus" data-id="{{$item->id}}" href="#"><i
                                                        class="ri-delete-bin-fill"></i>
                                                    Hapus</a> --}}

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
        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }


            let value = $('#tabelbank').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
            })
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
    </script>
@endpush
