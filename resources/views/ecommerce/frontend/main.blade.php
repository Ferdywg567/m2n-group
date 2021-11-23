<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garment - Ecommerce</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('ecommerce/assets/images/favicon.png')}}">

    <!-- All CSS is here
	============================================ -->

    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/signericafat.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/cerebrisans.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/elegant.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/vendor/linear-icon.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/easyzoom.css')}}">

    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/plugins/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('ecommerce/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <!-- Use the minified version files listed below for better performance and remove the files listed above
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }


        /* The Modal (background) */
        .modalSearch {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            /* background-color: rgb(0, 0, 0); */
            /* Fallback color */
            /* background-color: rgba(0, 0, 0, 0.4); */
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content-search {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 40%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .orange {
            color: #FF3B30
        }

        .btn-primary {
            background-color: #FF3B30 !important;
            border: none !important;
        }

        .shadow {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .rounded {
            border-radius: 5px;
        }

        /* For small devices (e.g. smartphones) */

        .mobile-logo a img {
            max-width: 80%;
            /* display: inline-block; */
        }

        .pro-add-to-cart a {
            border-radius: 10px;
        }

        /* For medium devices (e.g. tablets) */
        @media (min-width: 420px) {
            .logo-img a img {
                max-width: 48%;
            }
        }

        /* For large devices (e.g. desktops) */
        @media (min-width: 760px) {
            .logo-img a img {
                max-width: 85%;
            }
        }

        body {
            font-family: 'Heebo', serif;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        @include('ecommerce.frontend.include.header')
        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href="#"><i class="icon_close"></i></a>
                <div class="cart-content">
                    <h3>Shopping Cart</h3>
                    <ul>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="{{asset('ecommerce/assets/images/cart/cart-1.jpg')}}" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="#">Simple Black T-Shirt</a></h4>
                                <span> 1 × $49.00 </span>
                            </div>
                            <div class="cart-delete">
                                <a href="#">×</a>
                            </div>
                        </li>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="{{asset('ecommerce/assets/images/cart/cart-2.jpg')}}" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="#">Norda Backpack</a></h4>
                                <span> 1 × $49.00 </span>
                            </div>
                            <div class="cart-delete">
                                <a href="#">×</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-total">
                        <h4>Subtotal: <span>$170.00</span></h4>
                    </div>
                    <div class="cart-checkout-btn">
                        <a class="btn-hover cart-btn-style" href="cart.html">view cart</a>
                        <a class="no-mrg btn-hover cart-btn-style" href="checkout.html">checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header start -->
        @yield('content')
        <div class="service-area pt-20 pb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1">
                        <div class="single-service-wrap-2 mb-30">
                            <div class="service-icon-2">
                                <i class="ri-truck-line" style="color:#FF3B30"></i>
                            </div>
                            <div class="service-content-2">
                                <h5 style="font-weight: bold">Gratis Ongkir</h5>
                                <p style="font-size: 10px">Jika melebihi order 10 lusin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1 service-border-1-none-md">
                        <div class="single-service-wrap-2 mb-30">
                            <div class="service-icon-2">
                                <i class="ri-shield-check-line" style="color:#FF3B30"></i>
                            </div>
                            <div class="service-content-2">
                                <h5 style="font-weight: bold">100% Pembayaran Aman </h5>
                                <p style="font-size: 10px">Jaminan pembayaran yang aman</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1">
                        <div class="single-service-wrap-2 mb-30">
                            <div class="service-icon-2">
                                <i class="ri-user-voice-line" style="color:#FF3B30"></i>
                            </div>
                            <div class="service-content-2">
                                <h5 style="font-weight: bold">24/7 Dukungan Khusus</h5>
                                <p style="font-size: 10px">Kapan pun & dimana pun</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="single-service-wrap-2 mb-30">
                            <div class="service-icon-2">
                                <i class="ri-calendar-check-line" style="color:#FF3B30"></i>
                            </div>
                            <div class="service-content-2">
                                <h5 style="font-weight: bold">Tawaran Setiap Hari</h5>
                                <p style="font-size: 10px">Diskon s/d 50%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('ecommerce.frontend.include.footer')
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="{{asset('ecommerce/assets/images/product/product-1.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="{{asset('ecommerce/assets/images/product/product-3.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="{{asset('ecommerce/assets/images/product/product-6.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="{{asset('ecommerce/assets/images/product/product-3.jpg')}}" alt="">
                                    </div>
                                </div>
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active nav-style-6">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img
                                                src="{{asset('ecommerce/assets/images/product/quickview-s1.jpg')}}"
                                                alt=""></a>
                                        <a data-toggle="tab" href="#pro-2"><img
                                                src="{{asset('ecommerce/assets/images/product/quickview-s2.jpg')}}"
                                                alt=""></a>
                                        <a data-toggle="tab" href="#pro-3"><img
                                                src="{{asset('ecommerce/assets/images/product/quickview-s3.jpg')}}"
                                                alt=""></a>
                                        <a data-toggle="tab" href="#pro-4"><img
                                                src="{{asset('ecommerce/assets/images/product/quickview-s2.jpg')}}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                                <div class="product-details-content quickview-content">
                                    <h2>Simple Black T-Shirt</h2>
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
                                    <p>Seamlessly predominate enterprise metrics without performance based process
                                        improvements.</p>
                                    <div class="pro-details-price">
                                        <span class="new-price">$75.72</span>
                                        <span class="old-price">$95.72</span>
                                    </div>
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul>
                                                <li><a class="dolly" href="#">dolly</a></li>
                                                <li><a class="white" href="#">white</a></li>
                                                <li><a class="azalea" href="#">azalea</a></li>
                                                <li><a class="peach-orange" href="#">Orange</a></li>
                                                <li><a class="mona-lisa active" href="#">lisa</a></li>
                                                <li><a class="cupid" href="#">cupid</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-size">
                                        <span>Size:</span>
                                        <div class="pro-details-size-content">
                                            <ul>
                                                <li><a href="#">XS</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-quality">
                                        <span>Quantity:</span>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                    <div class="product-details-meta">
                                        <ul>
                                            <li><span>Categories:</span> <a href="#">Woman,</a> <a href="#">Dress,</a>
                                                <a href="#">T-Shirt</a>
                                            </li>
                                            <li><span>Tag: </span> <a href="#">Fashion,</a> <a href="#">Mentone</a> , <a
                                                    href="#">Texas</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-action-wrap">
                                        <div class="pro-details-add-to-cart">
                                            <a title="Add to Cart" href="#">Add To Cart </a>
                                        </div>
                                        <div class="pro-details-action">
                                            <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                                            <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                                            <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                            <div class="product-dec-social">
                                                <a class="facebook" title="Facebook" href="#"><i
                                                        class="icon-social-facebook"></i></a>
                                                <a class="twitter" title="Twitter" href="#"><i
                                                        class="icon-social-twitter"></i></a>
                                                <a class="instagram" title="Instagram" href="#"><i
                                                        class="icon-social-instagram"></i></a>
                                                <a class="pinterest" title="Pinterest" href="#"><i
                                                        class="icon-social-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->



        <!-- The Modal -->
        <div id="modalSearch" class="modalSearch">

            <!-- Modal content -->
            <div class="modal-content-search">
                <span class="close">&times;</span>
                <table>
                    <tbody id="data_cari">
                        <tr>
                            <td>Kaos Polo bersaku</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <!-- All JS is here
============================================ -->

    <script src="{{asset('ecommerce/assets/js/vendor/modernizr-3.11.7.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/vendor/jquery-v3.6.0.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/vendor/jquery-migrate-v3.3.2.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/jquery.instagramfeed.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/jquery-ui-touch-punch.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/sticky-sidebar.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/easyzoom.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('ecommerce/assets/js/plugins/ajax-mail.js')}}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <!-- Use the minified version files listed below for better performance and remove the files listed above
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
    <!-- Main JS -->
    <script src="{{asset('ecommerce/assets/js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            var modal = document.getElementById("modalSearch");
            $('#search').on('keyup', function () {
                var cari = $(this).val()
                cari = cari.toLowerCase()
                $.ajax({
                    url:"{{route('frontend.product.get_cari')}}",
                    method:"GET",
                    data:{
                        cari:cari
                    }, success:function(response){
                        if(response.status){
                            console.log(response);
                            var produk = response.data;
                            var datahtml = ""
                            for (let index = 0; index < produk.length; index++) {
                                const element = produk[index];
                                datahtml += `<tr>
                                                <td><a href="{{route('frontend.product.show_cari')}}?cari=${element}">${element}</a></td>
                                            </tr>`

                            }


                            if(cari.length == 0){
                                $('#modalSearch').hide()
                            }else if(produk.length == 0){
                                datahtml += `<tr>
                                                <td style="text-align:center">Pencarian tidak ditemukan</td>
                                            </tr>`
                                $('#modalSearch').show()
                            }else{
                                $('#modalSearch').show()
                            }
                            $('#data_cari').html(datahtml)
                        }
                    }
                })



             })

             window.onclick = function(event) {
                    if (event.target == modal) {
                        $('#modalSearch').hide()
                    }
             }

             $('#cari_kategori').on('change', function () {
                 var kategori = $(this).find(':selected').val()
                 window.location.href = "{{route('frontend.product.kategori')}}"+"?kategori="+kategori
              })
            })
    </script>

    @stack('scripts')
</body>

</html>
