<style>
    span {
        font-size: 12px;
    }
</style>

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{asset('assets/img/logo.png')}}" alt="" srcset="" width="30">
        <a href="#">
            GARMENT</a>
    </div>

    <ul class="sidebar-menu" style="padding: 35px; margin-top:-20px;">
        <li class="menu-header"></li>
        <li @yield('dashboard')>
            <a class="nav-link" href="{{ route('ecommerce.dashboard.index') }}">
                <i class="ri-dashboard-fill"></i> <span>Beranda</span>
            </a>
        </li>
        <li @yield('produk')>
            <a class="nav-link" href="{{route('ecommerce.produk.index')}}">
                <i class="ri-t-shirt-fill"></i><span>Produk</span>
            </a>
        </li>
        <li @yield('transaksi')>
            <a class="nav-link" href="{{route('ecommerce.transaksi.index')}}">
                <i class="ri-arrow-left-right-fill"></i> <span>Transaksi</span>
            </a>
        </li>
        <li @yield('customer')>
            <a class="nav-link" href="{{route('ecommerce.customer.index')}}">
                <i class="ri-user-fill"></i> <span>Customer</span>
            </a>
        </li>
        <li @yield('promo')>
            <a class="nav-link" href="{{route('ecommerce.promo.index')}}">
                <i class="ri-percent-line"></i><span>Promo</span>
            </a>
        </li>
        <li @yield('banner')>
            <a class="nav-link" href="{{route('ecommerce.banner.index')}}">
                <i class="ri-artboard-fill"></i> <span>Banner</span>
            </a>
        </li>
        <li @yield('layout')>
            <a class="nav-link" href="{{route('ecommerce.layout.index')}}">
                <i class="ri-layout-fill"></i><span>Layout</span>
            </a>
        </li>
        <li @yield('rekapitulasi')>
            <a class="nav-link" href="{{route('ecommerce.rekapitulasi.index')}}">
                <i class="ri-booklet-fill"></i><span>Rekapitulasi</span>
            </a>
        </li>

    </ul>
</aside>
