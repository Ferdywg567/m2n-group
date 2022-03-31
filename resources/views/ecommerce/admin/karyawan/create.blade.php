@extends('ecommerce.admin.master')
@section('title', 'Karyawan')
@section('title-nav', 'Karyawan')
@section('cssnav', 'cssnav')
@section('karyawan', 'class=active-sidebar')
@section('content')
    <style>
        .cssnav {
            margin-left: -20px;
        }

    </style>

    <div id="non-printable">
        <section class="section">
            <div class="section-header ">
                <a class="btn btn-primary" href="{{ route('ecommerce.promo.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="ml-2">Input Data | Karyawan</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @include('ecommerce.admin.include.alert')
                                <form id="formBahanMasuk" method="post" action="{{ route('ecommerce.karyawan.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" required id="nama_lengkap"
                                                    name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" required id="email"
                                                    name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="hak_akses">Hak Akses</label>
                                                <select class="form-control" id="hak_akses" required name="hak_akses">
                                                    <option value="production">Produksi</option>
                                                    <option value="warehouse">Gudang</option>
                                                    <option value="admin-online">Admin Online</option>
                                                    <option value="admin-offline">Admin Offline</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kata_sandi">Kata Sandi</label>
                                                <input type="password" class="form-control" required id="kata_sandi"
                                                    name="kata_sandi" value="{{ old('kata_sandi') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ulangi_kata_sandi">Ulangi Kata Sandi</label>
                                                <input type="password" class="form-control" required
                                                    id="ulangi_kata_sandi" name="ulangi_kata_sandi"
                                                    value="{{ old('ulangi_kata_sandi') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a type="button" class="btn btn-secondary"
                                                href="{{ route('ecommerce.karyawan.index') }}">Batal</a>

                                            <button type="submit" class="btn btn-primary btnmasuk">Simpan</button>

                                        </div>
                                    </div>

                                </form>
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


        })
    </script>
@endpush
