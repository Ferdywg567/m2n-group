<form class="form-inline mr-auto" action="">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
    </ul>
    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-white">@yield('title-nav') <span class="badge badge-success rounded">
                    @if (auth()->user()->hasRole('production'))
                    PRODUCTION
                    @elseif (auth()->user()->hasRole('warehouse'))
                    WAREHOUSE
                    @endif
                </span></h3>
        </div>
    </div>
</form>
<ul class="navbar-nav navbar-right mr-3">

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form" action="{{route('backend.logout')}}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>
