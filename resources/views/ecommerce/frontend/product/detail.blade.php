@extends('ecommerce.frontend.main')

@section('content')
<style>
    .btn-cart {
        padding: 12px 150px;
        font-size: 14px;
    }

    .btn-outline-primary {
        color: #FF3B30;
        border-color: #FF3B30;
        padding: 12px 180px;
        font-size: 14px;
    }

    .btn-outline-primary:hover {
        background: #FF3B30;
        color: white;
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

    .product-details-tab .btn-wishlist:hover{
        background-color: black;
        color: white;
    }
</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="breadcrumb-content text-left">
            <ul>
                <li>
                    <a href="/">Beranda</a>
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
                        <img src="{{asset('ecommerce/assets/images/product-details/product-detail-1.png')}}"
                            class="rounded-lg" alt="">
                        <img src="{{asset('ecommerce/assets/images/product-details/product-detail-2.png')}}"
                            class="rounded-lg" alt="">
                        <img src="{{asset('ecommerce/assets/images/product-details/product-detail-3.png')}}"
                            class="rounded-lg" alt="">
                        <img src="{{asset('ecommerce/assets/images/product-details/product-detail-4.png')}}"
                            class="rounded-lg" alt="">

                    </div>
                    <div class="img-overlay">
                        <button class="btn btn-sm btn-wishlist rounded-circle"><i class="ri-heart-line"></i></button>
                    </div>

                    <div class="product-dec-right-detail product-dec-slider-small-2 product-dec-small-style2">
                        <div class="product-dec-small active">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-1.png')}}"
                                class="rounded-lg" alt="">
                        </div>
                        <div class="product-dec-small">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-2.png')}}"
                                class="rounded-lg" alt="">
                        </div>
                        <div class="product-dec-small">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-3.png')}}"
                                class="rounded-lg" alt="">
                        </div>
                        <div class="product-dec-small">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-4.png')}}"
                                class="rounded-lg" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content pro-details-content-mt-md">
                    <h2>Kaos Polos 24s</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <div class="product-digit">
                                <span>5.0</span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>62 Reviews</span>
                            <span>242 orders</span>
                        </div>
                    </div>

                    <div class="pro-details-price">
                        <span class="old-price">Rp. 155,000</span>
                        <span class="new-price ml-2">Rp. 120,000</span>
                        <h4><b> / seri</b></h4>
                    </div>

                    <div class="pro-details-quality">
                        <span>Jumlah:</span>
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                        </div>
                    </div>
                    <p>* 1 seri berisikan size S, M, L (3 pcs).</p>

                    <div class="pro-details-action-wrap mt-1">
                        <div class="pro-details-add-to-cart">
                            <button type="button" class="btn btn-primary btn-cart"><i class="ri-shopping-cart-line"></i>
                                Tambah ke keranjang</button>
                            <hr style="height: 0;border: 1px solid #C4C4C4;">
                            <button type="button" class="btn btn-outline-primary">Beli Langsung</button>
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
                            <p>Crafted in premium watch quality, fenix Chronos is the first Garmin timepiece to combine
                                a durable metal case with integrated performance GPS to support navigation and sport. In
                                the tradition of classic tool watches it features a tough design and a set of modern
                                meaningful tools.</p>
                            <p> advanced performance metrics for endurance sports, Garmin quality navigation features
                                and smart notifications. In fenix Chronos top-tier performance meets sophisticated
                                design in a highly evolved timepiece that fits your style anywhere, anytime. Solid
                                brushed 316L stainless steel case with brushed stainless steel bezel and integrated
                                EXOTM antenna for GPS + GLONASS support. High-strength scratch resistant sapphire
                                crystal. Brown vintage leather strap with hand-sewn contrast stitching and nubuck inner
                                lining and quick release mechanism.</p>
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
                            <h2>1 review for Sleeve Button Cowl Neck</h2>
                            <div class="single-review">
                                <div class="review-img">
                                    <img src="{{asset('ecommerce/assets/images/product-details/client-1.png')}}" alt="">
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-name">
                                            <h5><span>John Snow</span> - March 14, 2019</h5>
                                        </div>
                                        <div class="review-rating">
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                        </div>
                                    </div>
                                    <p>Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna
                                        molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam
                                        egestas libero ac turpis pharetra, in vehicula lacus scelerisque</p>
                                </div>
                            </div>
                        </div>
                        <div class="ratting-form-wrapper">
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
                        </div>
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
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-4.png')}}" alt="">
                        </a>

                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>

                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-left ml-2">
                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
                        </div>
                        <div class="product-rating-wrap pb-10">
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

                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
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
                        <div class="pro-add-to-cart">
                            <button class="btn btn-primary btn-block" >Lihat Produk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-1.png')}}" alt="">
                        </a>

                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>

                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-left ml-2">
                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
                        </div>
                        <div class="product-rating-wrap pb-10">
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

                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
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
                        <div class="pro-add-to-cart">
                            <button class="btn btn-primary btn-block" >Lihat Produk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-2.png')}}" alt="">
                        </a>

                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>

                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-left ml-2">
                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
                        </div>
                        <div class="product-rating-wrap pb-10">
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

                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
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
                        <div class="pro-add-to-cart">
                            <button class="btn btn-primary btn-block" >Lihat Produk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-3.png')}}" alt="">
                        </a>

                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>

                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-left ml-2">
                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
                        </div>
                        <div class="product-rating-wrap pb-10">
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

                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
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
                        <div class="pro-add-to-cart">
                            <button class="btn btn-primary btn-block" >Lihat Produk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap shadow rounded">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('ecommerce/assets/images/product-details/product-detail-4.png')}}" alt="">
                        </a>

                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>

                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-left ml-2">
                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
                        </div>
                        <div class="product-rating-wrap pb-10">
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

                        <h3><a href="product-details.html">Kaos Hitam Polos</a></h3>
                        <div class="product-price-2">
                            <span class="new-price">Rp. 32,000</span>
                            <span class="old-price">Rp. 45,000</span>
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
                        <div class="pro-add-to-cart">
                            <button class="btn btn-primary btn-block" >Lihat Produk</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
            $('#nav-masuk-tab').css('background-color','black')
                  $('#nav-masuk-tab').css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')

              $('#nav-masuk-tab').click(function () {
                  $(this).css('background-color','black')
                  $(this).css('color','white')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
               })

               $('#nav-keluar-tab').click(function () {
                  $('#nav-masuk-tab').css('background-color','')
                  $('#nav-masuk-tab').css('color','black')
                  $('#nav-selesai-tab').css('background-color','')
                  $('#nav-selesai-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })


               $('#nav-selesai-tab').click(function () {
                  $('#nav-masuk-tab').css('background-color','')
                  $('#nav-masuk-tab').css('color','black')
                  $('#nav-keluar-tab').css('background-color','')
                  $('#nav-keluar-tab').css('color','black')
                  $(this).css('color','white')
                  $(this).css('background-color','black')
               })

               $('.one-time').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: true
                });


                // $('.pro-dec-big-img-slider').slick('unslick', $('.btn-wishlist').index());
        })
</script>
@endpush