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

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;

    }

    .top-right {
        position: absolute;
        top: 15%;
        right: 10%;
        width: 40px;
        text-align: center;
    }

    .top-left {
        position: absolute;
        top: 15%;
        left: 10%;
        width: 80px;
        text-align: center;
    }

    .overlay-div {
        height: 85%;
        width: 87%;
        position: absolute;
        background-color: #000;
        opacity: .5;
        bottom: 8%;
    }
</style>
<section class="section  mt-4">
    <div class="btn-group">
        <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Tambah Promo Baru <i class="fas fa-plus"></i>
        </button>
        <div class="dropdown-menu">
            <form action="{{route('ecommerce.banner.create')}}" method="get">
                <input type="hidden" name="status" value="Slider Utama">
                <button class="dropdown-item">Slider Utama</button>
            </form>

            <form action="{{route('ecommerce.banner.create')}}" method="get">
                <input type="hidden" name="status" value="Promo Tambahan">
                <button class="dropdown-item">Promo Tambahan</button>
            </form>
        </div>
    </div>
    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="ml-2">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active " id="nav-masuk-tab" data-toggle="tab"
                                        href="#nav-masuk" role="tab" aria-controls="nav-masuk"
                                        aria-selected="true">Slider Halaman Utama</a>
                                    <a class="nav-item nav-link " id="nav-keluar-tab" data-toggle="tab"
                                        href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                        aria-selected="false">Promo Tambahan</a>
                                </div>
                            </nav>
                        </div>
                        <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-masuk" role="tabpanel"
                                aria-labelledby="nav-masuk-tab">
                                <div class="row">
                                    @foreach ($slider as $item)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body" style="position: relative; ">
                                                <img src="{{asset('uploads/images/banner/'.$item->gambar)}}" alt=""
                                                    class="rounded" style="width: 100%; ">
                                                @if ($item->status == 'Aktif')
                                                <div class="top-left rounded" style="background-color: white">
                                                    {{$item->status}}
                                                </div>
                                                @else
                                                <div class="overlay-div rounded"></div>
                                                <div class="top-left rounded"
                                                    style="background-color: rgb(163, 163, 163); color:white">
                                                    {{$item->status}}
                                                </div>
                                                @endif

                                                <div class="top-right">
                                                    <div class="dropdown dropleft rounded "
                                                        style=" background-color: white;">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{route('ecommerce.banner.show',[$item->id])}}"><i
                                                                    class="ri-eye-fill"></i>
                                                                Detail</a>

                                                            <a class="dropdown-item"
                                                                href="{{route('ecommerce.banner.edit',[$item->id])}}"><i
                                                                    class="ri-edit-fill"></i>
                                                                Edit</a>

                                                            {{-- <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                                href="#"><i class="ri-delete-bin-fill"></i>
                                                                Hapus</a> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 3 == 0)
                                </div>
                                <div class="row">
                                    @endif
                                    @endforeach
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-keluar" role="tabpanel" aria-labelledby="nav-keluar-tab">

                            </div>
                        </div>

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

                 $('#nav-masuk-tab').css('background-color','black')
                  $('#nav-masuk-tab').css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')

              $('#nav-masuk-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
               })

               $('#nav-keluar-tab').click(function () {
                  $('#nav-masuk-tab').css('background-color','')
                  $('#nav-masuk-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })



               $(document).on('click','.hapus', function () {
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
                            url:"{{url('warehouse/finishing/')}}/"+id,
                            method:"DELETE",
                            success:function(data){

                                if(data.status){
                                    swal("Maaf, data tidak bisa dihapus!");

                                }else{
                                    swal("Success! data berhasil dihapus!", {
                                    icon: "success",
                                    });

                                    setTimeout(function () {  location.reload(true) },1500)
                                }
                            }
                       })

                    } else {

                    }
                    });

               })
     })
</script>
@endpush
