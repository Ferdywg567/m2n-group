@extends('ecommerce.frontend.main')

@section('content')
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a onclick="GoBackWithRefreshUrl();return false;" href="#" class="text-left"><i class="ri-arrow-left-line"></i> Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -80px !important;">
                <h3 class="text-center">{{$data}}</h3>
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
                        @forelse ($produk as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="single-product-wrap mb-35 shadow rounded">
                                <div class="product-img product-img-zoom mb-15">
                                    <a href="{{route('frontend.product.show',[$item->id])}}">
                                        <img src="{{asset('uploads/images/produk/'.$item->detail_gambar[0]->filename)}}"
                                            alt="">
                                    </a>
                                    <div class="product-action-2 tooltip-style-2">
                                        <button title="Wishlist" class="wishlist" @if(auth()->check())  @if(\AppHelper::instance()->favorit_data(auth()->user()->id, $item->id)) style="background-color:black;color:white" @endif @endif ><i class="icon-heart"></i></button>
                                    </div>
                                </div>
                                <div class="product-content-wrap-2 text-left ml-2">

                                    <h3><a href="{{route('frontend.product.show',[$item->id])}}">Kaos Hitam Polos</a></h3>
                                    <div class="product-price-2">
                                        @if ($item->promo_id == null)
                                        <span class="new-price">@rupiah($item->harga)</span>
                                        @else
                                        <span class="new-price">@rupiah($item->harga_promo)</span>
                                        <span class="old-price">@rupiah($item->harga)</span>
                                        @endif
                                    </div>
                                    <div class="product-rating-wrap pb-15">
                                        <div class="product-rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star gray"></i>
                                        </div>
                                        <span>(2)</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap-2 product-content-position text-left">
                                    <h3><a href="{{route('frontend.product.show',[$item->id])}}">Kaos Hitam Polos</a></h3>
                                    <div class="product-price-2">
                                        @if ($item->promo_id == null)
                                        <span class="new-price">@rupiah($item->harga)</span>
                                        @else
                                        <span class="new-price">@rupiah($item->harga_promo)</span>
                                        <span class="old-price">@rupiah($item->harga)</span>
                                        @endif
                                    </div>
                                    <div class="product-rating-wrap">
                                        <div class="product-rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star gray"></i>
                                        </div>
                                        <span>(2)</span>
                                    </div>
                                    <div class="pro-add-to-cart pb-10">
                                        <a href="{{route('frontend.product.show',[$item->id])}}"
                                            class="btn btn-primary btn-block">Lihat Produk</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse

                    </div>
                    <div class="pro-pagination-style text-center mt-10">
                        <ul>
                            <li><a class="prev" href="#"><i class="icon-arrow-left"></i></a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a class="next" href="#"><i class="icon-arrow-right"></i></a></li>
                        </ul>
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
