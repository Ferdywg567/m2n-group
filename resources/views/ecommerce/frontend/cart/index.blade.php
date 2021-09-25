@extends('ecommerce.frontend.main')

@section('content')
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="/" class="text-left"><i class="ri-arrow-left-line"></i> Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -80px !important;">
                <h3 class="text-center">Keranjang</h3>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area  pb-120">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="all" style="width: 15px"></th>
                                    <th>Produk</th>
                                    <th></th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="cart" id="" style="width: 15px"></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img
                                                src="{{asset('ecommerce/assets/images/product-details/product-detail-4.png')}}"
                                                alt="" width="80"></a>
                                    </td>
                                    <td class="product-name" style="text-align: left">
                                        <a href="#" style="">Simple Black T-Shirt</a>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" style="font-size: 11px; color:#8E8E93"><i
                                                        class="ri-heart-add-line"></i> Tambahkan ke favorit</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="product-price-cart"><span class="amount">$260.00</span></td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">$110.00</td>
                                    <td class="product-remove">
                                        <a href="#"><i class="icon_close"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="cart" id="" style="width: 15px"></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img
                                                src="{{asset('ecommerce/assets/images/product-details/product-detail-1.png')}}"
                                                alt="" width="80"></a>
                                    </td>
                                    <td class="product-name" style="text-align: left"><a href="#">Norda Simple
                                            Backpack</a>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" style="font-size: 11px; color:#8E8E93"><i
                                                        class="ri-heart-add-line"></i> Tambahkan ke favorit</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="product-price-cart"><span class="amount">$180.00</span></td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">$180.00</td>
                                    <td class="product-remove">
                                        <a href="#"><i class="icon_close"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="cart" id="" style="width: 15px"></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img
                                                src="{{asset('ecommerce/assets/images/product-details/product-detail-3.png')}}"
                                                alt="" width="80"></a>
                                    </td>
                                    <td class="product-name" style="text-align: left"><a href="#">Simple Black T-Shirt
                                        </a>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" style="font-size: 11px; color:#8E8E93"><i
                                                        class="ri-heart-add-line"></i> Tambahkan ke favorit</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="product-price-cart"><span class="amount">$170.00</span></td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">$170.00</td>
                                    <td class="product-remove">
                                        <a href="#"><i class="icon_close"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="row pt-50">
            <div class="col-md-12">
                <div class="card" style="background-color: black">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-white pt-5">Total : Rp. 1,000,000</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-light pl-5 pr-5"><i class="ri-money-dollar-circle-line"></i> Checkout</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
