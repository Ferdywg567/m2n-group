@extends('ecommerce.admin.master')
@section('title', 'Banner')
@section('title-nav', 'Banner')
@section('banner', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -20px;
    }


    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i {
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0, 0, 0, .54);
        font-weight: 500;
        font-size: initial;
        /* text-transform: uppercase; */
    }

    textarea {
        width: 300px;
        height: 150px !important;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('ecommerce.banner.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Promo Tambahan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="formProduk" method="post" action="#"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>
                                <input type="hidden" name="status_banner" value="Slider Utama">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama_promo">Nama Promo</label>
                                            <input type="text" class="form-control" required id="nama_promo"
                                                name="nama_promo" readonly value="{{$banner->nama}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_mulai">Promo Mulai</label>
                                            <input type="date" class="form-control" required id="promo_mulai"
                                                name="promo_mulai" readonly value="{{$banner->promo_mulai}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_berakhir">Promo Berakhir</label>
                                            <input type="date" class="form-control" required id="promo_berakhir"
                                                name="promo_berakhir" readonly value="{{$banner->promo_berakhir}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File Gambar Promo</label>
                                            <img src="{{asset('uploads/images/banner/'.$banner->gambar)}}" class="text-center" alt="" srcset="">
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="syarat">Syarat dan Ketentuan</label>
                                            <textarea class="form-control" id="syarat" name="syarat" readonly
                                                rows="3">{{$banner->syarat}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('ecommerce.banner.index')}}">Tutup</a>

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
