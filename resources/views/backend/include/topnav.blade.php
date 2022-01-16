<style>
    .dropdown-item-unread {
        background-color: #eeeeee !important
    }

    .notification .badge {
        position: absolute;
        top: -10px;
        right: 8px;
        padding: 5px 8px;
        border-radius: 50%;
        background-color: red;
        font-size: 10px;
        color: white;
    }
</style>
@php
if(auth()->user()->hasRole('production')){
$jumlah = \App\Notification::where('role','production')->where('read',0)->count();
$notif = \App\Notification::where('role','production')->orderBy('created_at','DESC')->get();
}else{
$jumlah = \App\Notification::where('role','warehouse')->where('read',0)->count();
$notif = \App\Notification::where('role','warehouse')->orderBy('created_at','DESC')->get();
}
@endphp
<form class="form-inline mr-auto" action="">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg text-dark"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
    </ul>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-dark">@yield('title-nav') </h3>
                </div>
                <div class="col-md-4 @yield('cssnav')">
                    <span class="badge badge-success rounded" style="height: 80%">
                        <h6>
                            @if (auth()->user()->hasRole('production'))
                            PRODUKSI
                            @elseif (auth()->user()->hasRole('warehouse'))
                            GUDANG
                            @endif
                        </h6>

                    </span>
                </div>
            </div>


        </div>
    </div>
</form>
<ul class="navbar-nav navbar-right mr-3">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
            class="nav-link notification notification-toggle mr-2  nav-link-lg"
            aria-expanded="true" id="btnnotif"><img src="{{asset('assets/icon/notification-fill.png')}}" alt=""
                srcset=""><span class="badge">{{$jumlah}}</span></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right ">
            <div class="dropdown-header">
                <div class="row">
                    <div class="col-md-6">
                        Notifikasi
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('notifikasi.index')}}" class="btn btn-primary">Baca Semua</a>
                    </div>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons" tabindex="3"
                style="overflow: hidden; outline: none; touch-action: none;">

                @forelse ($notif as $item)
                <a href="{{$item->url}}" data-id="{{$item->id}}"
                    class="dropdown-item notif-item @if($item->read != 1) dropdown-item-unread @endif">
                    <div class="dropdown-item-icon bg-success text-white">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="dropdown-item-desc">
                        <b>{{ucfirst($item->description)}}</b>
                        <div class="time">{{date('H:i:s',strtotime($item->created_at))}}</div>
                    </div>
                </a>
                @empty
                @endforelse
            </div>
        </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block text-dark">Hi, {{auth()->user()->name}}</div>
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
