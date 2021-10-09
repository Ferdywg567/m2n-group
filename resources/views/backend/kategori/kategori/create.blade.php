@extends('backend.master')

@section('title', 'Kategori')
@section('title-nav', 'Kategori')
@section('kategori', 'class=active-sidebar')
@section('content')
<style>
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
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('kategori.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Kategori</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('kategori.store')}}" method="post">
                            @csrf

                            <div class="card-body">
                                @include('backend.include.alert')
                                <input type="hidden" name="status" id="status" value="kategori">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_kategori">Nama Kategori</label>
                                            <input type="text" class="form-control" required id="nama_kategori"
                                                name="nama_kategori">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" required id="sku" name="sku">
                                        </div>

                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('kategori.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary">Simpan</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
