@extends('ecommerce.admin.master')
@section('title', 'Promo')
@section('title-nav', 'Promo')
@section('cssnav', 'cssnav')
@section('promo', 'class=active-sidebar')
@section('content')
<style>
    .cssnav{
       margin-left:-20px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('ecommerce.promo.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Promo</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formBahanMasuk" method="post" action="{{route('ecommerce.promo.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama_promo">Nama Promo</label>
                                            <input type="text" class="form-control" required id="nama_promo"
                                                name="nama_promo" value="{{old('nama_promo')}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_promo">Kode Promo</label>
                                            <input type="text" class="form-control" required id="kode_promo"
                                                name="kode_promo" value="{{old('kode_promo')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="potongan">Potongan (%)</label>
                                            <input type="number" class="form-control" required id="potongan"
                                                name="potongan" value="{{old('potongan')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_mulai">Promo Mulai</label>
                                            <input type="date" class="form-control" required id="promo_mulai"
                                                name="promo_mulai" value="{{old('promo_mulai')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_berakhir">Promo Berakhir</label>
                                            <input type="date" class="form-control" required id="promo_berakhir"
                                                name="promo_berakhir" value="{{old('promo_berakhir')}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('ecommerce.promo.index')}}">Batal</a>

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
    $(document).ready(function () {
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
