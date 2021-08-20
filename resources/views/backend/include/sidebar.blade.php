<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{asset('assets/img/logo.png')}}" alt="" srcset="" width="30">
        <a href="#">
            GARMENT</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">Ts</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header"></li>
        @if (auth()->user()->hasRole('production'))
        <li @yield('dashboard')>
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="ri-dashboard-fill"></i> <span>Dashboard</span>
            </a>
        </li>
        <li @yield('bahan') >
            <a class="nav-link"  href="{{route('bahan.index')}}">
                <i class="ri-t-shirt-fill"></i> <span>Bahan</span>
            </a>
        </li>
        <li @yield('potong')>
            <a class="nav-link" href="{{route('potong.index')}}">
                <i class="ri-scissors-line"></i><span>Potong</span>
            </a>
        </li>
        <li @yield('jahit')>
            <a class="nav-link" href="{{route('jahit.index')}}">
                <i class="ri-user-settings-fill"></i> <span>Jahit</span>
            </a>
        </li>
        <li @yield('cuci')>
            <a class="nav-link" href="{{route('cuci.index')}}">
                <i class="ri-hand-coin-fill"></i> <span>Cuci</span>
            </a>
        </li>
        <li @yield('perbaikan')>
            <a class="nav-link" href="{{route('perbaikan.index')}}">
                <i class="ri-refresh-fill"></i></i> <span>Perbaikan</span>
            </a>
        </li>
        <li @yield('sampah')>
            <a class="nav-link" href="{{route('sampah.index')}}">
                <i class="ri-delete-bin-2-fill"></i><span>Sampah</span>
            </a>
        </li>
        <li @yield('rekapitulasi')>
            <a class="nav-link" href="{{route('rekapitulasi.index')}}">
                <i class="ri-booklet-fill"></i><span>Rekapitulasi</span>
            </a>
        </li>
        <hr>
        <li @yield('retur')>
            <a class="nav-link" href="{{route('retur.index')}}">
                <i class="ri-logout-box-fill"></i> <span>Retur</span>
            </a>
        </li>
        @endif


        @if (auth()->user()->hasRole('warehouse'))
        <li @yield('dashboard')>
            <a class="nav-link" href="{{ route('warehouse.dashboard.index') }}">
                <i class="ri-dashboard-fill"></i> <span>Dashboard</span>
            </a>
        </li>

        <li @yield('finishing')>
            <a class="nav-link" href="{{route('warehouse.finishing.index')}}">
                <i class="ri-check-double-line"></i><span>Finishing</span>
            </a>
        </li>
        <li @yield('warehouse')>
            <a class="nav-link" href="{{route('warehouse.warehouse.index')}}">
                <i class="ri-home-gear-fill"></i> <span>Warehouse</span>
            </a>
        </li>
        <li @yield('retur')>
            <a class="nav-link" href="{{route('warehouse.retur.index')}}">
                <i class="ri-logout-box-fill"></i> <span>Retur</span>
            </a>
        </li>
        <li @yield('rekapitulasi')>
            <a class="nav-link" href="{{route('warehouse.rekapitulasi.index')}}">
                <i class="ri-booklet-fill"></i> <span>Rekapitulasi</span>
            </a>
        </li>
        @endif
    </ul>
</aside>
