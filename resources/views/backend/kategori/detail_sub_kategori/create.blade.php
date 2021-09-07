@extends('backend.master')

@section('title', 'Kategori')
@section('title-nav', 'Kategori')
@section('kategori', 'class=active-sidebar')
@section('cssnav', 'cssnav')
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
                <div class="col-md-8">
                    <div class="card">
                        <form action="{{route('kategori.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                @include('backend.include.alert')
                                <input type="hidden" name="status" id="status" value="detail sub kategori">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori_utama">Pilih Kategori Utama</label>
                                            <select class="form-control" id="kategori_utama" name="kategori_utama">
                                                <option value="">Pilih Kategori</option>
                                                    @forelse ($kategori as $item)
                                                            <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                                    @empty
                                                    @endforelse
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku_utama">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_utama" name="sku_utama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_kategori">Pilih Sub Kategori</label>
                                            <select class="form-control" id="sub_kategori" name="sub_kategori">
                                                <option value="">Pilih Sub Kategori</option>
                                                    {{-- @forelse ($sub as $item)
                                                            <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                                    @empty
                                                    @endforelse --}}
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku_sub">SKU Sub Kategori</label>
                                            <input type="text" class="form-control" readonly required id="sku_sub" name="sku_sub">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="datasub">
                                    <div class="row">
                                        <input type="hidden" name="nilai" id="nilai" value="1">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="detail_sub_kategori">Detail Sub Kategori 1</label>
                                                <input type="text" class="form-control" required id="detail_sub_kategori"
                                                    name="detail_sub_kategori[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku">Detail SKU Sub Kategori 1</label>
                                                <input type="text" class="form-control" readonly required id="sku" name="sku[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah Sub Kategori Baru</button>
                                <div class="row mt-2">
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
@push('scripts')
<script>
    $(document).ready(function(){
        $('.btntambah').on('click', function () {
            // var nilai = $('#nilai').val()
            var nilai = 0
            var sku = $('#sku_sub').val()
            var hide = $('#datasub').find('input[type=hidden]')
            var maxIndex;
            maxIndex = hide.length - 1;
            nilai = maxIndex+2
            var resku = sku +'/'+nilai
            var tambah = parseInt(nilai);
            var datahtml = '<div class="row">' +
                '<input type="hidden" name="nilai" id="nilai" value="'+tambah+'">'+
                                        '<div class="col-md-6">'+
                                            '<div class="form-group">'+
                                                '<label for="detail_sub_kategori">Detail Sub Kategori '+tambah+'</label>'+
                                                '<input type="text" class="form-control" required id="detail_sub_kategori" name="detail_sub_kategori[]">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                            '<div class="form-group">'+
                                                '<label for="sku"> Detail SKU Sub Kategori '+tambah+'</label>'+
                                                '<input type="text" class="form-control" readonly required id="sku" name="sku[]" value="'+resku+'">'+
                                            '</div>'+
                                        '</div>'+
                            '</div>'
            $('#datasub').append(datahtml)
        })

        $('#kategori_utama').on('change', function () {
                var kategori = $(this).val()
                $('#sub_kategori').empty()
                $.ajax({
                    url:"{{route('kategori.getkategori')}}",
                    method:"GET",
                    data:{
                        'kategori':kategori
                    }
                }).done(function (response) {
                     if(response.status){
                         var sku = response.data.sku
                         var sub = response.data.sub_kategori
                         $('#sku_utama').val(sku)
                         $('#sub_kategori').append('<option value="">Pilih Sub Kategori</option>')
                         for (let index = 0; index < sub.length; index++) {
                             const element = sub[index];
                            $('#sub_kategori').append('<option  value="'+element.id+'">'+element.nama_kategori+'</option>')
                         }
                     }
                })
         })



        $('#sub_kategori').on('change', function () {
                var kategori = $(this).val()
                $.ajax({
                    url:"{{route('kategori.getSubKategori')}}",
                    method:"GET",
                    data:{
                        'kategori':kategori
                    }
                }).done(function (response) {
                     if(response.status){
                         var sku = response.data.sku
                         $('#sku_sub').val(sku)
                         $('#sku').val(sku+'/'+'1')
                     }
                })
         })

    })
</script>
@endpush
