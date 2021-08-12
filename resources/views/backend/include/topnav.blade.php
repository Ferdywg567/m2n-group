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
    <li class="dropdown dropdown-list-toggle show"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep" aria-expanded="true"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right show">
          <div class="dropdown-header">Notifications
            <div class="float-right">
              <a href="#">Mark All As Read</a>
            </div>
          </div>
          <div class="dropdown-list-content dropdown-list-icons" tabindex="3" style="overflow: hidden; outline: none; touch-action: none;">
            <a href="#" class="dropdown-item dropdown-item-unread">
              <div class="dropdown-item-icon bg-primary text-white">
                <i class="fas fa-code"></i>
              </div>
              <div class="dropdown-item-desc">
                Template update is available now!
                <div class="time text-primary">2 Min Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-info text-white">
                <i class="far fa-user"></i>
              </div>
              <div class="dropdown-item-desc">
                <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                <div class="time">10 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
              </div>
              <div class="dropdown-item-desc">
                <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                <div class="time">12 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-danger text-white">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="dropdown-item-desc">
                Low disk space. Let's clean it!
                <div class="time">17 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-info text-white">
                <i class="fas fa-bell"></i>
              </div>
              <div class="dropdown-item-desc">
                Welcome to Stisla template!
                <div class="time">Yesterday</div>
              </div>
            </a>
          </div>
          <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
          </div>
        <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr" style="width: 9px; z-index: 1000; cursor: default; position: absolute; top: 58px; left: 341px; height: 350px; touch-action: none; opacity: 0.3; display: block;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 7px; height: 306px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; touch-action: none;"></div></div><div id="ascrail2002-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 9px; z-index: 1000; top: 399px; left: 0px; position: absolute; cursor: default; display: none; width: 341px; opacity: 0.3;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 7px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;"></div></div></div>
      </li>
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
