@extends('ecommerce.frontend.main')

@section('content')
<style>
    .btn-cart {
        padding: 12px;
        font-size: 14px;
        width: 100%;
    }

    @media (min-width: 576px) {
       .btn-cart {
        padding: 12px 10px;
        font-size: 14px;
        }
        .product-details-tab .btn-wishlist {
        position: absolute;
        top: 8% !important;
        left: 68%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        font-size: 16px;
        text-align: right;
        background-color: white;
    }
    }

    @media (min-width: 768px) {
        .btn-cart {
        padding: 12px 120px;
        font-size: 14px;
        }

        .product-details-tab .btn-wishlist {
        position: absolute;
        top: 6% !important;
        left: 72%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        font-size: 16px;
        text-align: right;
        background-color: white;
    }
    }

    @media (min-width: 992px) {
        .btn-cart {
            padding: 12px 140px;
        font-size: 14px;
        }

        .btn-outline-primary {
        color: #FF3B30;
        border-color: #FF3B30;
        padding: 12px 180px;
        font-size: 14px;
    }

    .product-details-tab .btn-wishlist {
        position: absolute;
        top: 4% !important;
        left: 72% !important;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        font-size: 16px;
        text-align: right;
        background-color: white;
    }
    }

    .btn-outline-primary {
        color: #FF3B30;
        border-color: #FF3B30;
        padding: 12px;
        font-size: 14px;
        width: 100%;
    }

    .btn-outline-primary:hover {
        background: #FF3B30;
        color: white;
    }

    .product-details-tab .btn-wishlist {
        position: absolute;
        top: 9% !important;
        left: 64%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        font-size: 16px;
        text-align: right;
        background-color: white;
    }

    .product-details-tab .btn-wishlist:hover {
        background-color: black;
        color: white;
    }

    .review-img{
        width: 10%;
    }

</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="breadcrumb-content text-left">
            <ul>
                <li>
                    <a href="{{route('landingpage.index')}}">Beranda</a>
                </li>
                <li class="active">Detail Produk</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-tab single-product-wrap">
                    <div class="product-dec-left-detail pro-dec-big-img-slider product-img product-img-zoom">
                        @forelse ($produk->detail_gambar as $item)
                        <img src="{{asset('uploads/images/produk/'.$item->filename)}}" class="rounded-lg" alt="">
                        @empty
                        @endforelse
                    </div>
                    <div class="img-overlay">
                        <button class="btn btn-sm btn-wishlist rounded-circle wishlist" data-id="{{$produk->id}}"
                            @if(auth()->check()) @if(\AppHelper::instance()->favorit_data(auth()->user()->id,
                            $produk->id)) style="background-color:black;color:white" @endif @endif><i
                                class="ri-heart-line"></i></button>
                    </div>

                    <div class="product-dec-right-detail product-dec-slider-small-2 product-dec-small-style2">
                        @forelse ($produk->detail_gambar as $item)

                        <div class="product-dec-small">
                            <img src="{{asset('uploads/images/produk/'.$item->filename)}}" class="rounded-lg" alt="">
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content pro-details-content-mt-md">
                    <h2>{{$produk->nama_produk}}</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                @for ($i=0;$i<\AppHelper::instance()->avg_ulasan($produk->id);$i++)
                                    <i class="icon_star"></i>
                                    @endfor

                                    {{-- <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i> --}}
                            </div>
                            <div class="product-digit">
                                <span>{{\AppHelper::instance()->avg_ulasan($produk->id)}}</span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>{{\AppHelper::instance()->jumlah_ulasan($produk->id)}} Ulasan</span>
                            <span>{{\AppHelper::instance()->jumlah_pesanan($produk->id)}} pesanan</span>
                        </div>
                    </div>

                    <div class="pro-details-price">
                        @if ($produk->promo_id == null)
                        <span class="new-price ml-2">@rupiah($produk->harga)</span>
                        <h4><b> / seri</b></h4>
                        @else
                        <span class="old-price">@rupiah($produk->harga)</span>
                        <span class="new-price ml-2">@rupiah($produk->harga_promo)</span>
                        <h4><b> / seri</b></h4>
                        @endif

                    </div>

                    <div class="pro-details-quality">
                        <div id="data-alert">

                        </div>
                        <span>Jumlah:</span>
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" id="jumlah" value="1">
                        </div>
                    </div>
                    <p>* 1 seri berisikan size S, M, L (3 pcs).</p>

                    <div class="pro-details-action-wrap mt-1">
                        <div class="pro-details-add-to-cart">
                            <button type="button" class="btn btn-primary btn-cart btnTambahKeranjang"><i
                                    class="ri-shopping-cart-line"></i>
                                Tambah ke keranjang</button>
                            <hr style="height: 0;border: 1px solid #C4C4C4;">
                            <button type="button" class="btn btn-outline-primary btn-beli-langsung">Beli
                                Langsung</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-wrapper pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="mb-4">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab" href="#nav-masuk"
                            role="tab" aria-controls="nav-masuk" aria-selected="true">Deskripsi Produk</a>
                        <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai"
                            role="tab" aria-controls="nav-selesai" aria-selected="false">Ulasan</a>
                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab" href="#nav-keluar" role="tab"
                            aria-controls="nav-keluar" aria-selected="false">Size Chart</a>
                    </div>
                </nav>
                <div class="tab-content dec-review-bottom" id="nav-tabContent">
                    <div id="nav-masuk" class="tab-pane active fade show" role="tabpanel"
                        aria-labelledby="nav-masuk-tab">
                        <div class="description-wrap">
                            <p>{{$produk->deskripsi_produk}}.</p>
                        </div>
                    </div>
                    {{-- <div id="des-details2" class="tab-pane">
                        <div class="specification-wrap table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="title width1">Name</td>
                                        <td>Salwar Kameez</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">SKU</td>
                                        <td>0x48e2c</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Models</td>
                                        <td>FX 829 v1</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Categories</td>
                                        <td>Digital Print</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Size</td>
                                        <td>60’’ x 40’’</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Brand </td>
                                        <td>Individual Collections</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Color</td>
                                        <td>Black, White</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="specification-wrap table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="title width1">Top</td>
                                        <td>Cotton Digital Print Chain Stitch Embroidery Work</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Bottom</td>
                                        <td>Cotton Cambric</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Dupatta</td>
                                        <td>Digital Printed Cotton Malmal With Chain Stitch</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <div id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab" class="tab-pane fade">
                        <div class="review-wrapper">
                            <h2>{{\AppHelper::instance()->jumlah_ulasan($produk->id)}} ulasan untuk {{$produk->nama_produk}}</h2>

                           @forelse ($produk->ulasan as $row)
                           <div class="single-review">
                            <div class="review-img">
                                <img src="{{asset('uploads/images/user/'.$row->user->foto)}}" style="width: 80%" alt="">
                            </div>
                            <div class="review-content">
                                <div class="review-top-wrap">
                                    <div class="review-name">
                                        <h5><span>{{$row->user->name}}</span> - {{date('d F, Y',strtotime($row->created_at))}}</h5>
                                    </div>
                                    <div class="review-rating text-right">
                                        @for ($i=1;$i<=5;$i++)
                                        @if (round($row->rating) >= $i)
                                        <i class="yellow icon_star"></i>
                                        @else
                                        <i class="icon_star gray"></i>
                                        @endif

                                        @endfor
                                    </div>
                                </div>
                                <p>{{$row->ulasan}}</p>
                            </div>
                        </div>
                           @empty

                           @endforelse

                        </div>
                        {{-- <div class="ratting-form-wrapper">
                            <span>Add a Review</span>
                            <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                            <div class="ratting-form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <label>Name <span>*</span></label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <label>Email <span>*</span></label>
                                                <input type="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="star-box-wrap">
                                                <div class="single-ratting-star">
                                                    <a href="#"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                    <a href="#"><i class="icon_star"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="rating-form-style mb-20">
                                                <label>Your review <span>*</span></label>
                                                <textarea name="Your Review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related-product pb-50">
    <div class="container pb-50">
        <div class="section-title mb-45 text-left">
            <h3>Produk Terkait</h3>
        </div>
        <div class="related-product-active">
            @forelse ($terkait as $item)
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
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
                                href="{{route('frontend.product.show',[$item->id])}}">{{$item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}</a>
                        </h3>
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
                                href="{{route('frontend.product.show',[$item->id])}}">{{$item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}</a>
                        </h3>
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

        $('#nav-masuk-tab').css('background-color', 'black')
        $('#nav-masuk-tab').css('color', 'white')
        $('#nav-keluar-tab').css('background-color', '')
        $('#nav-keluar-tab').css('color', 'black')
        $('#nav-selesai-tab').css('background-color', '')
        $('#nav-selesai-tab').css('color', 'black')

        $('#nav-masuk-tab').click(function () {
            $(this).css('background-color', 'black')
            $(this).css('color', 'white')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')
        })

        $('#nav-keluar-tab').click(function () {
            $('#nav-masuk-tab').css('background-color', '')
            $('#nav-masuk-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')
            $(this).css('color', 'white')
            $(this).css('background-color', 'black')
        })


        $('#nav-selesai-tab').click(function () {
            $('#nav-masuk-tab').css('background-color', '')
            $('#nav-masuk-tab').css('color', 'black')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $(this).css('color', 'white')
            $(this).css('background-color', 'black')
        })

        $('.one-time').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });

        @if(auth()->check())
        ajax()
        $('.btnTambahKeranjang').on('click', function () {
            var idproduk = "{{$produk->id}}"
            var jumlah = $('#jumlah').val()
            console.log(jumlah);
            $.ajax({
                url: "{{route('frontend.keranjang.store')}}",
                method: "POST",
                data: {
                    id: idproduk,
                    jumlah: jumlah
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status) {
                        setTimeout(function () {
                            getDataSidebar()
                        }, 1500)
                        $('.totalcart').text(response.total)
                    } else {
                        $('#data-alert').html(response.data)
                    }
                }
            })
        })

        $('.qtybutton').on('click', function () {
            $('#data-alert').empty()
        })


        $('.btn-beli-langsung').on('click', function () {
            var jumlah = $('#jumlah').val();
            var id = "{{$produk->id}}"
            $.ajax({
                url: "{{route('frontend.checkout.beli_langsung')}}",
                method: "POST",
                data: {
                    id: id,
                    jumlah: jumlah
                },
                success: function (response) {
                    if (response.status) {
                        window.location.href = "{{route('frontend.checkout.index')}}"
                    } else {
                        $('#data-alert').html(response.data)
                    }
                }
            })
        })
        @else
        $('.btnTambahKeranjang').on('click', function () {
            window.location.href = "{{route('frontend.auth.login')}}"
        })
        $('.btn-beli-langsung').on('click', function () {
            window.location.href = "{{route('frontend.auth.login')}}"
        })
        @endif




        // $('.pro-dec-big-img-slider').slick('unslick', $('.btn-wishlist').index());
    })

</script>
@endpush
