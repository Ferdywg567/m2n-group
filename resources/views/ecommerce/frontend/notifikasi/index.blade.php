@extends('ecommerce.frontend.main')

@section('content')
<style>
    h5,
    h6,
    h4 {
        font-family: 'Heebo', sans-serif;
    }

</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{route('landingpage.index')}}" class="text-left"><i class="ri-arrow-left-line"></i>
                    Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -100px !important;">
                <h3 class="text-center">Notifikasi</h3>
            </div>
        </div>
    </div>
</div>
<div class="shop-area pt-20 pb-120">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12">

                <div class="shop-bottom-area">
                    <div class="row">
                        @forelse ($notif as $item)
                        <div class="col-12 d-flex justify-content-center">
                            <div class="card shadow" style="width: 90%;background-color:#F6FAFB;border:none">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>{{$item->pesan}} </h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <h5 style="color: #CB077C"> {{\AppHelper::instance()->time_elapsed_string($item->created_at)}}</h5>
                                            <h5>{{$item->created_at}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function GoBackWithRefreshUrl(event) {
        history.go(-1)
    }

</script>
@endpush
