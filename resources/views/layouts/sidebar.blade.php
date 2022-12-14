<nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
	<div class="sidenav-brand ml-5">
		<a class="toggle back" id="sidenav-toggle"><i class="fa fa-angle-left"></i></a>
		<a class="avatar-username" href="{{ url('/dashboard') }}"> <img class="img-responsive logo-sidebar center-block" width="80" height="30" src="{{ asset('/img/kotaluwuk-small.png') }}"></a>
	</div>

	<ul class="navbar-nav sidenav-menu mt-2">
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}">
                <span class="sidenav-link-icon"><i class="bi bi-house-door"></i></span>
                <span class="sidenav-link-title">Dashboard</span>
            </a>
        </li>

        @php
         $menus = menus()
        @endphp

        @foreach ($menus as $menu)
            @if (isset($menu['children']) AND $menu['child'] == 'Y' )
                <li>
                    <a href="javascript:;" data-sidenav-dropdown-toggle>
                        <span class="sidenav-link-icon"><i class="{{ $menu['icon'] }}"></i></span>
                        <span class="sidenav-link-title">{{ $menu['menu'] }}</span>
                        <span class="sidenav-dropdown-icon {{ Request::is(strtolower($menu['menu']).'*') ? '' : 'show' }}" data-sidenav-dropdown-icon><i class="bi bi-caret-right"></i></span>
                        <span class="sidenav-dropdown-icon {{ Request::is(strtolower($menu['menu']).'*') ? 'show' : '' }}" data-sidenav-dropdown-icon><i class="bi bi-caret-down"></i></span>
                    </a>{{ "\n" }}
                    <ul class="sidenav-dropdown" data-sidenav-dropdown style="{{ Request::is(strtolower($menu['menu']).'*') ? 'display: block;' : '' }}">
                        @foreach ($menu['children'] as $child)
                            <li class="nav-item {{ Request::is(strtolower($menu['menu']).'/'.strtolower($child['menu'])) ? 'active' : '' }}">
                                <a href="{{ url($child['route_name']) }}">
                                    <span class="sidenav-link-icon"><i class="{{ $child['icon'] }}"></i></span>
                                    <span class="sidenav-link-title">{{ $child['menu'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
            <li class="nav-item {{ Request::is(strtolower(str_replace(' ', '_', $menu['menu']))) ? 'active' : '' }}">
                <a href="{{ url($menu['route_name']) }}">
                    <span class="sidenav-link-icon"><i class="{{ $menu['icon'] }}"></i></span>
                    <span class="sidenav-link-title">{{ $menu['menu'] }}</span>
                </a>
            </li>
            @endif
        @endforeach  
        
	</ul>
 </nav>
