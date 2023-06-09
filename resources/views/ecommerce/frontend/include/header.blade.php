@php
$kategori = \App\SubKategori::select('nama_kategori')->groupBy('nama_kategori')->get();
@endphp

<header class="header-area">
    <div class="header-large-device">
        <div class="header-middle header-middle-padding-tb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="{{route('landingpage.index')}}"><img
                                    src="{{asset('/assets/img/M2N 1.png')}}" width="40%" alt="logo">
                                    <p style="display: inline; font-size:12pt; color:black"><b>M2N STORE</b></p>
                                </a>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-7">
                        <div class="categori-search-wrap">
                            <div class="categori-style-1">
                                <select class="nice-select nice-select-style-1" id="cari_kategori">
                                    <option value="Semua Kategori" @if(isset($data)) @if($data=='Semua Kategori' )
                                        selected @endif @endif>Semua Kategori</option>
                                    @forelse ($kategori as $item)
                                    <option value="{{$item->nama_kategori}}" @if(isset($data)) @if($data==$item->
                                        nama_kategori) selected @endif @endif>
                                        {{ strlen($item->nama_kategori) > 17 ?
                                            substr($item->nama_kategori, 0, 14) . '...' : $item->nama_kategori }}
                                    </option>
                                    @empty

                                    @endforelse

                                </select>
                            </div>
                            <div class="search-wrap-3">
                                <form action="{{route('frontend.product.show_cari')}}">
                                    <input placeholder="Cari Produk...." type="text" id="search" name="cari">
                                    <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="header-action header-action-flex float-left">
                            <div class="same-style-2 same-style-2-font-inc header-cart mt-2">


                                @if (auth()->check())
                                @if (auth()->user()->hasRole('ecommerce'))
                                <a class="cart-active" href="#">
                                    <i class="ri-shopping-cart-line"></i>
                                    <span class="pro-count green totalcart">
                                        {{App\Helpers\AppHelper::instance()->total_keranjang()}}
                                    </span>
                                </a>


                                @endif
                                @else
                                <a class="cart" href="{{route('frontend.auth.login')}}">
                                    <i class="ri-shopping-cart-line"></i>
                                </a>
                                @endif


                            </div>
                            <div class="same-style-2 same-style-2-font-inc mt-2">
                                @if (auth()->check())
                                @if (auth()->user()->hasRole('ecommerce'))
                                <a class="" href="{{route('frontend.notifikasi.index')}}">
                                    <i class="ri-notification-2-line"></i><span class="pro-count "></span>

                                </a>
                                @endif
                                @else
                                <a class="" href="{{route('frontend.auth.login')}}">
                                    <i class="ri-notification-2-line"></i><span class="pro-count"></span>

                                </a>

                                @endif
                            </div>
                            <div class="same-style-2 same-style-2-font-inc mt-2">
                                <a href="">|</a>
                            </div>
                            <div class="same-style-2 same-style-2-font-inc">
                                @if (auth()->check())
                                @if (auth()->user()->hasRole('ecommerce'))
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (!empty(auth()->user()->foto))
                                    <img class="rounded-circle"
                                        src="{{asset('uploads/images/user/'.auth()->user()->foto)}}"
                                        alt="Card image cap" style="width:25%">
                                    @else

                                    <img src="{{asset('assets/img/avatar/avatar-3.png')}}" style="width:25%"
                                        class="rounded-circle" alt="Card image cap">
                                    @endif

                                    {{\AppHelper::instance()->nama_header(auth()->user()->name)}}</a>
                                <div class="dropdown-menu" style="width: 70%">
                                    <a class="dropdown-item" href="{{route('frontend.user.index')}}"
                                        style="font-size:16px">Profil</a>
                                    <a class="dropdown-item" href="{{route('frontend.user.pembelian.index')}}"
                                        style="font-size:16px">Pembelian</a>
                                    <a class="dropdown-item" href="{{route('frontend.favorit.index')}}" style="font-size:16px">Favorit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('frontend.auth.logout')}}"
                                        style="font-size:16px">Logout</a>
                                </div>

                                @endif
                                @else
                                <a type="button" href="{{route('frontend.auth.login')}}"
                                    class="btn btn-primary text-white" style="border-radius: 10px">Masuk</a>
                                @endif


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="header-small-device small-device-ptb-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="mobile-logo">
                        <a href="/">
                            <img alt="" src="{{asset('/assets/img/M2N 1.png')}}">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="header-action header-action-flex">
                        <div class="same-style-2 same-style-2-font-inc header-cart">

                            @if (auth()->check())
                            @if (auth()->user()->hasRole('ecommerce'))
                            <a class="cart-active" href="#">
                                <i class="ri-shopping-cart-line"></i>
                                <span class="pro-count green totalcart">
                                    {{App\Helpers\AppHelper::instance()->total_keranjang()}}
                                </span>
                            </a>


                            @endif
                            @else
                            <a class="cart" href="{{route('frontend.auth.login')}}">
                                <i class="ri-shopping-cart-line"></i>
                            </a>
                            @endif
                        </div>
                        <div class="same-style-2 same-style-2-font-inc">
                            @if (auth()->check())
                            @if (auth()->user()->hasRole('ecommerce'))
                            <a class="" href="{{route('frontend.notifikasi.index')}}">
                                <i class="ri-notification-2-line"></i><span class="pro-count green"></span>

                            </a>
                            @endif
                            @else
                            <a class="" href="{{route('frontend.auth.login')}}">
                                <i class="ri-notification-2-line"></i><span class="pro-count"></span>

                            </a>

                            @endif
                        </div>
                        <div class="same-style-2 same-style-2-font-inc">
                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="icon-user"></i></a>
                            <div class="dropdown-menu" style="width: 70%">
                                @if (auth()->check())
                                @if (auth()->user()->hasRole('ecommerce'))
                                <a class="dropdown-item" href="{{route('frontend.user.index')}}"
                                    style="font-size:16px">Profil</a>
                                <a class="dropdown-item" href="{{route('frontend.user.pembelian.index')}}"
                                    style="font-size:16px">Pembelian</a>
                                <a class="dropdown-item" href="{{route('frontend.favorit.index')}}" style="font-size:16px">Favorit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('frontend.auth.logout')}}"
                                    style="font-size:16px">Logout</a>
                                @endif
                                @else
                                <a class="dropdown-item" href="{{route('frontend.auth.login')}}"
                                style="font-size:16px">Masuk</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
