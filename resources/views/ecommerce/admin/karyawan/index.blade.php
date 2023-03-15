@extends('ecommerce.admin.master')
@section('title', 'Karyawan')
@section('title-nav', 'Karyawan')
@section('cssnav', 'cssnav')
@section('karyawan', 'class=active-sidebar')
@section('content')
<style>

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
    }
</style>
<section class="section mt-4">
    <div class="btn-group">
        <a href="{{route('ecommerce.karyawan.create')}}" class="btn btn-primary rounded">
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
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($karyawan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-left" style="padding-left: 20vw">
                                                {{ $item->name }}
                                                @if ($item->id == auth()->id())
                                                    <span class="badge badge-success ml-3">Akun Anda</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->email }}</td>

                                    <td>
                                        <div class="dropdown dropleft">
                                            <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{route('ecommerce.karyawan.show',[$item->id])}}"><i
                                                        class="ri-eye-fill"></i>
                                                    Detail</a>

                                                <a class="dropdown-item"
                                                    href="{{route('ecommerce.karyawan.edit',[$item->id])}}"><i
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
    $(document).ready(function () {
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
