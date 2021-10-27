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
        {{-- <li @yield('dashboard')>
            <a class="nav-link" href="{{ route('offline.dashboard.index') }}">
                <i class="ri-dashboard-fill"></i> <span>Beranda</span>
            </a>
        </li> --}}
        <li @yield('transaksi')>
            <a class="nav-link" href="{{route('offline.transaksi.create')}}">
                <i class="ri-arrow-left-right-fill"></i> <span>Transaksi</span>
            </a>
        </li>

        <li @yield('produk')>
            <a class="nav-link" href="{{route('offline.produk.index')}}">
                <i class="ri-t-shirt-fill"></i><span>Produk</span>
            </a>
        </li>

        <li @yield('rekapitulasi')>
            <a class="nav-link" href="{{route('offline.rekapitulasi.index')}}">
                <i class="ri-booklet-fill"></i><span>Rekapitulasi</span>
            </a>
        </li>

    </ul>
</aside>
