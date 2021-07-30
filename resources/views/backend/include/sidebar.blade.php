<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="#">GARMENT</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">Ts</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header"></li>
    <li @yield('dashboard')>
      <a class="nav-link" href="{{ route('dashboard.index') }}">
        <i class="fas fa-columns"></i> <span>Dashboard</span>
      </a>
    </li>

    <li @yield('bahan')>
        <a class="nav-link" href="{{route('bahan.index')}}">
            <i class="fas fa-tshirt"></i> <span>Bahan</span>
        </a>
    </li>

    <li @yield('potong')>
        <a class="nav-link" href="{{route('potong.index')}}">
            <i class="fas fa-cut"></i> <span>Potong</span>
        </a>
    </li>

    <li @yield('jahit')>
        <a class="nav-link" href="{{route('jahit.index')}}">
            <i class="fas fa-user-cog"></i> <span>Jahit</span>
        </a>
    </li>

    <li @yield('trpinjaman')>
        <a class="nav-link" href="#">
            <i class="fas fa-water"></i> <span>Cuci</span>
        </a>
    </li>
    <li @yield('trpinjaman')>
        <a class="nav-link" href="#">
            <i class="fa fa-tools"></i> <span>Perbaikan</span>
        </a>
    </li>
    <li @yield('trpinjaman')>
        <a class="nav-link" href="#">
            <i class="fas fa-trash"></i> <span>Sampah</span>
        </a>
    </li>
    <li @yield('trpinjaman')>
        <a class="nav-link" href="#">
            <i class="fas fa-file"></i> <span>Rekapitulasi</span>
        </a>
    </li>
    <hr>
    <li @yield('trpinjaman')>
        <a class="nav-link" href="#">
            <i class="fas fa-undo"></i> <span>Retur</span>
        </a>
    </li>
  </ul>
</aside>
