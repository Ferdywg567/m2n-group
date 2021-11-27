@if (auth()->check())
<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" href="#"><i class="icon_close"></i></a>
        <div class="cart-content">
            <h3>Keranjang Belanja</h3>
            <div id="data-keranjang-sidebar">
                {{-- <ul>
                    @php
                    $subtotal = 0;
                    @endphp
                    @forelse (\AppHelper::instance()->data_keranjang() as $item)
                    @php
                    $subtotal += $item->subtotal;
                    @endphp
                    <li class="single-product-cart">
                        <div class="cart-img">
                            <a href="#"><img
                                    src="{{asset('uploads/images/produk/'.$item->produk->detail_gambar[0]->filename)}}"
                                    alt=""></a>
                        </div>
                        <div class="cart-title">
                            <h4><a href="#">{{$item->produk->nama_produk}}</a></h4>
                            <span> {{$item->jumlah}} × @rupiah($item->harga) </span>
                        </div>

                    </li>

                    @empty

                    @endforelse

                </ul>
                <div class="cart-total">
                    <h4>Subtotal: <span>@rupiah($subtotal)</span></h4>
                </div>
                <div class="cart-checkout-btn">
                    <a class="btn-hover cart-btn-style" href="{{route('frontend.keranjang.index')}}">Lihat
                        Keranjang</a>
                    <a class="no-mrg btn-hover cart-btn-style" href="checkout.html">Checkout</a>
                </div> --}}
            </div>

        </div>
    </div>
</div>
@endif
