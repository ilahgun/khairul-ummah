<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
       
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ url ('landingpage/images/logo_ryd.png') }}" class="logoo">
            <span>RYDKU</span></a>

        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
        <li>
        <div class="dropdown drp-user">
            <div class="dropdown dropleft">
            <a href="#"  data-toggle="dropdown"><i class="feather icon-user"></i></a>
        <div class="dropdown-menu dropdown-menu-right profile-notification">
                    <div class="pro-head">
                    @empty(Auth::user()->foto)
                    <img src="{{ url('admin/images/nophotos.png') }}" alt="Profile" class="img-radius">
                    @else
                    <img src="{{ url('admin/images')}}/{{Auth::user()->foto}}" alt="Profile" class="img-radius">
                    @endempty
                    <span>{{ Auth::user()->nama }}</span>
                    <a href="{{ route('logout') }}" class="dud-logout" title="Logout" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-log-out"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </div>
            <ul class="pro-body">
                    <li><a href="{{ url('/profile')}}" class="dropdown-item"><i class="feather icon-user"></i>Profile</a></li>
                    <li><a href="{{ url('/user') }}" class="dropdown-item"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
            </ul>
                    </div>
		            </div>
	            </div>
            </li> 
        </ul> 
    </div>
</header>
