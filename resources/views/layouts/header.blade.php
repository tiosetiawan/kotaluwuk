<header class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <h4 class="mt-2"><a href="{{ url('/dashboard') }}"
                class="text-decoration-none text-black navbar-brand pl-5"><b>{{ env('APP_NAME') }}</b></a></h4>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/dashboard') }}"> <i
                                        class="bi bi-layout-text-window-reverse"></i> My Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form  action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i>
                                        Logout  
                                    </button>
                                </form>
                        </ul>
                    </li>
                    @endauth
            </div>
        </div>
    </div>
</header>

<a href="javascript:;" class="toggle front fs-3 text-decoration-none text-dark navbar-nav ml-5" id="sidenav-toggle">
    <i class="bi bi-justify"></i>
</a>
