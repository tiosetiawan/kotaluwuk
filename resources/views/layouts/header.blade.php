<header class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
            <h5 class=" mt-3"><a href="/" class="text-decoration-none text-black navbar-brand pl-5"><b>{{ env('APP_NAME') }}</b></a></h5>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="/logout" method="post">
                    @csrf
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome back, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/dashboard"> <i class="bi bi-layout-text-window-reverse"></i> My Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                                    </form>
                            </ul>
                        </li>
                    @else
                    <button type="submit" class="nav-link px-3 bg-white text-dark border-0"> LOGOUT <i
                        class="bi bi-box-arrow-right"></i></button>
                    @endauth
                   
                </form>
            </div>
        </div>
    </div>
</header>
<a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="toggle front fs-3 text-decoration-none text-dark navbar-nav ml-5" id="sidenav-toggle"><i class="bi bi-justify"></i></a>
