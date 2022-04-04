@extends('ecommerce.frontend.main')
@section('content')
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="clickalbe-sidebar-wrap">
        <a class="sidebar-close"><i class="icon_close"></i></a>
        <div class="mobile-header-content-area">
            <div class="header-offer-wrap-2 mrg-none mobile-header-padding-border-4">
                <p><span>FREE SHIPPING</span> world wide for all orders over $199</p>
            </div>
            <div class="mobile-search mobile-header-padding-border-1">
                <form class="search-form" action="#">
                    <input type="text" placeholder="Search here…">
                    <button class="button-search"><i class="icon-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-padding-border-2">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="index.html">Home</a>
                            <ul class="dropdown">
                                <li><a href="index.html">Home version 1 </a></li>
                                <li><a href="index-2.html">Home version 2</a></li>
                                <li><a href="index-3.html">Home version 3</a></li>
                                <li><a href="index-4.html">Home version 4</a></li>
                                <li><a href="index-5.html">Home version 5</a></li>
                                <li><a href="index-6.html">Home version 6</a></li>
                                <li><a href="index-7.html">Home version 7</a></li>
                                <li><a href="index-8.html">Home version 8</a></li>
                                <li><a href="index-9.html">Home version 9</a></li>
                                <li><a href="index-10.html">Home version 10</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children "><a href="#">shop</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children"><a href="#">shop layout</a>
                                    <ul class="dropdown">
                                        <li><a href="shop.html">standard style</a></li>
                                        <li><a href="shop-list.html">shop list style</a></li>
                                        <li><a href="shop-fullwide.html">shop fullwide</a></li>
                                        <li><a href="shop-no-sidebar.html">grid no sidebar</a></li>
                                        <li><a href="shop-list-no-sidebar.html">list no sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
                                        <li><a href="store-location.html">store location</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#">Products Layout</a>
                                    <ul class="dropdown">
                                        <li><a href="#">tab style 1</a></li>
                                        <li><a href="product-details-2.html">tab style 2</a></li>
                                        <li><a href="product-details-sticky.html">sticky style</a></li>
                                        <li><a href="product-details-gallery.html">gallery style </a></li>
                                        <li><a href="product-details-affiliate.html">affiliate style</a></li>
                                        <li><a href="product-details-group.html">group style</a></li>
                                        <li><a href="product-details-fixed-img.html">fixed image style </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="about-us.html">about us </a></li>
                                <li><a href="cart.html">cart page</a></li>
                                <li><a href="checkout.html">checkout </a></li>
                                <li><a href="my-account.html">my account</a></li>
                                <li><a href="wishlist.html">wishlist </a></li>
                                <li><a href="compare.html">compare </a></li>
                                <li><a href="contact.html">contact us </a></li>
                                <li><a href="order-tracking.html">order tracking</a></li>
                                <li><a href="login-register.html">login / register </a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children "><a href="#">Blog</a>
                            <ul class="dropdown">
                                <li><a href="blog.html">blog standard </a></li>
                                <li><a href="blog-no-sidebar.html">blog no sidebar </a></li>
                                <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                <li><a href="blog-details.html">blog details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact us</a></li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="main-categori-wrap mobile-menu-wrap mobile-header-padding-border-3">
                <a class="categori-show" href="#">
                    <i class="lnr lnr-menu"></i> All Department <i class="icon-arrow-down icon-right"></i>
                </a>
                <div class="categori-hide-2">
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children "><a href="#">Clothing </a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Sleeveless shirt</a></li>
                                            <li><a href="shop.html">Cotton T-shirt</a></li>
                                            <li><a href="shop.html">Trench coat</a></li>
                                            <li><a href="shop.html">Cargo pants</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Wedding dress</a></li>
                                            <li><a href="shop.html">Gym clothes</a></li>
                                            <li><a href="shop.html">Cotton T-shirt </a></li>
                                            <li><a href="shop.html">Long coat</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Kids Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Winter Wear </a></li>
                                            <li><a href="product-details-2.html">Occasion Gowns</a></li>
                                            <li><a href="product-details-tab1.html">Birthday Tailcoat</a></li>
                                            <li><a href="product-details-tab2.html">Stylish Unicorn</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Women</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Sleeveless shirt</a></li>
                                            <li><a href="shop.html">Cotton T-shirt</a></li>
                                            <li><a href="shop.html">Trench coat</a></li>
                                            <li><a href="shop.html">Cargo pants</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Wedding dress</a></li>
                                            <li><a href="shop.html">Gym clothes</a></li>
                                            <li><a href="shop.html">Cotton T-shirt </a></li>
                                            <li><a href="shop.html">Long coat</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Men </a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Sleeveless shirt</a></li>
                                            <li><a href="shop.html">Cotton T-shirt</a></li>
                                            <li><a href="shop.html">Trench coat</a></li>
                                            <li><a href="shop.html">Cargo pants</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Wedding dress</a></li>
                                            <li><a href="shop.html">Gym clothes</a></li>
                                            <li><a href="shop.html">Cotton T-shirt </a></li>
                                            <li><a href="shop.html">Long coat</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Kids Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Winter Wear </a></li>
                                            <li><a href="product-details-2.html">Occasion Gowns</a></li>
                                            <li><a href="product-details-tab1.html">Birthday Tailcoat</a></li>
                                            <li><a href="product-details-tab2.html">Stylish Unicorn</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Baby Girl </a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Sleeveless shirt</a></li>
                                            <li><a href="shop.html">Cotton T-shirt</a></li>
                                            <li><a href="shop.html">Trench coat</a></li>
                                            <li><a href="shop.html">Cargo pants</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Wedding dress</a></li>
                                            <li><a href="shop.html">Gym clothes</a></li>
                                            <li><a href="shop.html">Cotton T-shirt </a></li>
                                            <li><a href="shop.html">Long coat</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="shop.html">Baby Boy </a></li>
                            <li><a href="shop.html">Accessories </a></li>
                            <li><a href="shop.html">Shoes </a></li>
                            <li><a href="shop.html">Shirt </a></li>
                            <li><a href="shop.html">T-Shirt </a></li>
                            <li><a href="shop.html">Coat </a></li>
                            <li><a href="shop.html">Jeans </a></li>
                            <li><a href="shop.html">Collection </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="mobile-header-info-wrap mobile-header-padding-border-3">
                <div class="single-mobile-header-info">
                    <a href="store-location.html"><i class="lastudioicon-pin-3-2"></i> Store Location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a class="mobile-language-active" href="#">Language <span><i class="icon-arrow-down"></i></span></a>
                    <div class="lang-curr-dropdown lang-dropdown-active">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">German</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-mobile-header-info">
                    <a class="mobile-currency-active" href="#">Currency <span><i class="icon-arrow-down"></i></span></a>
                    <div class="lang-curr-dropdown curr-dropdown-active">
                        <ul>
                            <li><a href="#">USD</a></li>
                            <li><a href="#">EUR</a></li>
                            <li><a href="#">Real</a></li>
                            <li><a href="#">BDT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-contact-info mobile-header-padding-border-4">
                <ul>
                    <li><i class="icon-phone "></i> (+612) 2531 5600</li>
                    <li><i class="icon-envelope-open "></i> norda@domain.com</li>
                    <li><i class="icon-home"></i> PO Box 1622 Colins Street West Australia</li>
                </ul>
            </div>
            <div class="mobile-social-icon">
                <a class="facebook" href="#"><i class="icon-social-facebook"></i></a>
                <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                <a class="pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="slider-area">
    <div class="hero-slider-active-1 nav-style-1 dot-style-2 dot-style-2-position-2 dot-style-2-active-black">
        @forelse ($banner as $item)
        <div class="single-hero-slider single-animation-wrap slider-height-2 custom-d-flex custom-align-item-center bg-img hm2-slider-bg res-white-overly-xs"
            style="background-image:url({{asset('uploads/images/banner/'.$item->gambar)}});">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-12">
                        <div class="hero-slider-content-4 slider-animated-1">
                            <h4 class="animated">Lookbook</h4>
                            <h1 class="animated">Denim Mixed <br>Layering Combine <br>collect</h1>
                            <p class="animated">We love seeing how our Raifa wearers like to wear their Norda</p>
                            <div class="btn-style-1">
                                <a class="animated btn-1-padding-1" href="#">Explore Now</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        @empty

        @endforelse

    </div>
</div>

<div class="product-area pb-80 mt-4">
    <div class="container">
        <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-15">
            <div class="section-title-3">
                <h2>Produk Terlaris</h2>
            </div>
            <div class="tab-style-3 nav">
                <a href="{{route('frontend.product.kategori')}}?kategori=Semua Kategori" class="active">Lihat Semua Produk </a>

            </div>
        </div>
        <div class="tab-content jump">
            <div class="row">
                @forelse ($limit as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="single-product-wrap mb-35 shadow rounded">
                        <div class="product-img product-img-zoom mb-15">
                            <a href="{{route('frontend.product.show',[$item->id])}}">
                                <img src="{{asset('uploads/images/produk/'.$item->detail_gambar[0]->filename)}}" alt="">
                            </a>
                            <div class="product-action-2 tooltip-style-2">
                                <button title="Wishlist" class="wishlist" @if(auth()->check())  @if(\AppHelper::instance()->favorit_data(auth()->user()->id, $item->id)) style="background-color:black;color:white" @endif @endif data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 text-left ml-2">
                            <h3><a
                                    href="{{route('frontend.product.show',[$item->id])}}">{{ucwords($item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan)}}</a>
                            </h3>
                            <div class="product-price-2">
                                {{-- @if ($item->promo_id == null)
                                <span class="new-price">@rupiah($item->harga)</span>
                                @else
                                <span class="new-price">@rupiah($item->harga_promo)</span>
                                <span class="old-price">@rupiah($item->harga)</span>
                                @endif --}}

                                @if ($item->detail_produk->min('harga') == $item->detail_produk->max('harga'))
                                  <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                                @else
                                  <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->min('harga'))}} - {{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                                @endif

                            </div>
                            <div class="product-rating-wrap pb-15">
                                <div class="product-rating">
                                    @for ($i=1;$i<=5;$i++)
                                    @if (round(\AppHelper::instance()->avg_ulasan($item->id)) >= $i)
                                    <i class="icon_star"></i>
                                    @else
                                    <i class="icon_star gray"></i>
                                    @endif

                                    @endfor

                                </div>
                                <span>({{\AppHelper::instance()->avg_ulasan($item->id)}})</span>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 product-content-position text-left">
                            <h3><a
                                    href="{{route('frontend.product.show',[$item->id])}}">{{ucwords($item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan)}}</a>
                            </h3>
                            <div class="product-price-2">
                                {{-- @if ($item->promo_id == null)
                                <span class="new-price">@rupiah($item->harga)</span>
                                @else
                                <span class="new-price">@rupiah($item->harga_promo)</span>
                                <span class="old-price">@rupiah($item->harga)</span>
                                @endif --}}
                                @if ($item->detail_produk->min('harga') == $item->detail_produk->max('harga'))
                                <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @else
                                <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->min('harga'))}} - {{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @endif
                            </div>
                            <div class="product-rating-wrap">
                                <div class="product-rating">
                                    @for ($i=1;$i<=5;$i++)
                                    @if (round(\AppHelper::instance()->avg_ulasan($item->id)) >= $i)
                                    <i class="icon_star"></i>
                                    @else
                                    <i class="icon_star gray"></i>
                                    @endif

                                    @endfor

                                </div>
                                <span>({{\AppHelper::instance()->avg_ulasan($item->id)}})</span>
                            </div>
                            <div class="pro-add-to-cart pb-10">
                                <a href="{{route('frontend.product.show',[$item->id])}}"
                                    class="btn btn-primary btn-block">Lihat Produk</a>
                                {{-- <button class="btn btn-primary btn-block">Lihat Produk</button> --}}
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
<div class="banner-area padding-10-row-col pb-80">
    <div class="container">
        <div class="row">

            @forelse ($promo as $item)
            <div class="col-lg-4 col-md-6 col-12" style="border: none">
                <div class="banner-wrap mb-10" style="border: none">
                    <div class="banner-img  banner-img-zoom">
                        <a href="#"><img
                                src="{{asset('uploads/images/banner/'.$item->gambar)}}" style="border: none" alt=""></a>
                    </div>

                </div>
            </div>

            @empty

            @endforelse

        </div>
    </div>
</div>
<div class="product-area pb-80">
    <div class="container">
        <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-15">
            <div class="section-title-3">
                <h2>Rekomendasi Untukmu</h2>
            </div>

        </div>
        <div class="tab-content jump">
            <div class="row">
                @forelse ($rekomendasi as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="single-product-wrap mb-35 shadow rounded">
                        <div class="product-img product-img-zoom mb-15">
                            <a href="{{route('frontend.product.show',[$item->id])}}">
                                <img src="{{asset('uploads/images/produk/'.$item->detail_gambar[0]->filename)}}"
                                    alt="">
                            </a>
                            <div class="product-action-2 tooltip-style-2">
                                <button title="Wishlist" data-id="{{$item->id}}" class="wishlist-bottom" @if(auth()->check())  @if(\AppHelper::instance()->favorit_data(auth()->user()->id, $item->id)) style="background-color:black;color:white" @endif @endif ><i class="icon-heart"></i></button>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 text-left ml-2">

                            <h3><a href="{{route('frontend.product.show',[$item->id])}}">{{ucwords($item->nama_produk)}}</a></h3>
                            <div class="product-price-2">
                                {{-- @if ($item->promo_id == null)
                                <span class="new-price">@rupiah($item->harga)</span>
                                @else
                                <span class="new-price">@rupiah($item->harga_promo)</span>
                                <span class="old-price">@rupiah($item->harga)</span>
                                @endif --}}
                                @if ($item->detail_produk->min('harga') == $item->detail_produk->max('harga'))
                                <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @else
                                <span class="new-price" style="font-size: 16px">{{\AppHelper::instance()->rupiah($item->detail_produk->min('harga'))}} - {{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @endif
                            </div>
                            <div class="product-rating-wrap pb-15">
                                <div class="product-rating">
                                    @for ($i=1;$i<=5;$i++)
                                    @if (round(\AppHelper::instance()->avg_ulasan($item->id)) >= $i)
                                    <i class="icon_star"></i>
                                    @else
                                    <i class="icon_star gray"></i>
                                    @endif

                                    @endfor

                                </div>
                                <span>({{\AppHelper::instance()->avg_ulasan($item->id)}})</span>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 product-content-position text-left">
                            <h3><a href="{{route('frontend.product.show',[$item->id])}}">{{ucwords($item->nama_produk)}}</a></h3>
                            <div class="product-price-2">
                                {{-- @if ($item->promo_id == null)
                                <span class="new-price">@rupiah($item->harga)</span>
                                @else
                                <span class="new-price">@rupiah($item->harga_promo)</span>
                                <span class="old-price">@rupiah($item->harga)</span>
                                @endif --}}
                                @if ($item->detail_produk->min('harga') == $item->detail_produk->max('harga'))
                                <span class="new-price">{{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @else
                                <span class="new-price" style="font-size: 14px">{{\AppHelper::instance()->rupiah($item->detail_produk->min('harga'))}} - {{\AppHelper::instance()->rupiah($item->detail_produk->max('harga'))}}/seri</span>
                              @endif
                            </div>
                            <div class="product-rating-wrap">
                                <div class="product-rating">
                                    @for ($i=1;$i<=5;$i++)
                                    @if (round(\AppHelper::instance()->avg_ulasan($item->id)) >= $i)
                                    <i class="icon_star"></i>
                                    @else
                                    <i class="icon_star gray"></i>
                                    @endif

                                    @endfor

                                </div>
                                <span>({{\AppHelper::instance()->avg_ulasan($item->id)}})</span>
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

        </div>
    </div>
</div>

@endsection
