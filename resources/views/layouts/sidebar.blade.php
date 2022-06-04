<nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
	<div class="sidenav-brand ">
		<a class="toggle back" id="sidenav-toggle"><i class="fa fa-angle-left"></i></a>
		<a class="avatar-username" href="/"> <img class="img-responsive logo-sidebar center-block" width="80" height="30" src="/img/logo-imip.png"></a>
	</div>
	<ul class="navbar-nav sidenav-menu">
        @php
         $menus = menus()
        @endphp
        @foreach ($menus as $menu)
        <li class="nav-item {{ Request::is(strtolower($menu['menu'])) ? 'active' : '' }}">
            <a href="{{ $menu['route_name'] }}">
                <span class="sidenav-link-icon"><i class="{{ $menu['icon'] }}"></i></span>
                <span class="sidenav-link-title">{{ $menu['menu'] }}</span>
            </a>
        </li>
        @endforeach  
	</ul>
 </nav>
