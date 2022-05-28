<header class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
            <h5 class=" mt-3"><a href="/" class="text-decoration-none text-black navbar-brand pl-5"><b>{{ env('APP_NAME') }}</b></a></h5>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="nav-link px-3 bg-white text-dark border-0"> LOGOUT <i
                            class="bi bi-box-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</header>
<a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="toggle front fs-3 text-decoration-none text-dark navbar-nav ml-5" id="sidenav-toggle"><i class="bi bi-justify"></i></a>
