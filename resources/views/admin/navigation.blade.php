<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						@empty(Auth::user()->foto)
							<img src="{{ url('admin/images/nophotos.png') }}" alt="Profile" class="img-radius">
						@else
							<img src="{{ url('admin/images')}}/{{Auth::user()->foto}}" alt="Profile" class="img-radius">
						@endempty
						<div class="user-details">
                            <span>{{ Auth::user()->nama }}</span>
							<div id="more-details">{{ Auth::user()->role }}
							{{-- <i class="fa fa-chevron-down m-l-5"></i> --}}
							</div>
						</div>
					</div>
					{{-- <div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
							<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
							<li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div> --}}
				</div>
				
				<ul class="nav pcoded-inner-navbar "></br>
				<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
					    <a href="{{ url('/dashboardcount') }}" class="nav-link "><span class="pcoded-micon">
							<i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{ url('/user') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Kelola User</span></a>
					</li>

					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout">
						</i></span><span class="pcoded-mtext">Master Data</span></a>
					    <ul class="pcoded-submenu">
						<li class="nav-item">
					    <a href="{{ url('/anak_asuh') }}" class="nav-link ">Anak Asuh</a>
					</li>
						<li><a href="{{ url('/donatur') }}">Donatur</a></li>
					<li class="nav-item">
					    <a href="{{ url('/donasi') }}">Donasi</a></li>
					</li>
					<li class="nav-item">
					    <a href="{{ url('/metode_pembayaran') }}">Metode Pembayaran</a></li>
					</li>
					</ul>

					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box">
						</i></span><span class="pcoded-mtext">Blog</span></a>
					    <ul class="pcoded-submenu">
						<li class="nav-item">
					    <a href="{{ url('/categories') }}" class="nav-link ">Kategori</a>
					</li>
						<li><a href="{{ url('/tags') }}">Tags</a></li>
					<li class="nav-item">
					    <a href="{{ url('/posts') }}">Kegiatan</a></li>
					    </ul>
					</li>
					
					<li class="nav-item">
					    <a href="{{ url('/posts/trash') }}" class="nav-link "><span class="pcoded-micon">
						<i class="feather icon-trash"></i></span><span class="pcoded-mtext">Trash</span></a>
					</li>

					<li class="nav-item">
					    <a href="{{ route('logout') }}" class="dud-logout" title="Logout" class="nav-link"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<span class="pcoded-micon">
						<i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Log Out</span></a>
					</li>
				</ul>
				
			</div>
		</div>
	</nav>