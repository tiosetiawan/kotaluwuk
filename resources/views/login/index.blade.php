@extends('layouts.main_login')

@section('container')
<div id="konten">
    <div class="container-fluid konten-box">
        <div class="row">
            <div class="konten-kanan bg-img">
            </div>
            <div class="konten-kiri">
               
                {{-- <form action="{{ url('tostr') }}" method="POST"> --}}
                    @csrf
                    <div class="login-box">
                        <div class="card-body">
                            <h3 class="text-center mb-3"><a href=""><img width="40%" src="{{ env('APP_LOGO') }}"></a></h3>
                            <h5 class="text-center" style="font-weight: 600;">{{ env('APP_NAME') }}</h5>
                                <div class="form-group mb-2">
                                    <label class="form-label" style="font-weight: 600;">Username</label>
                                    <input class="form-control" type="text" placeholder="Username" name="username" id="username" required>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="font-weight: 600;"> Password</label>
                                    <input class="form-control" type="password" placeholder="Password" name="password"
                                        required>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="mt-4 d-grid gap-2">
                                    <button type="submit" class="btn btn-success" id="btn_login">Login</button>
                                    <button class="btn btn-success d-none" type="button" id="btn_loding" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                      </button>
                                </div>
                        </div>
                    </div>
                {{-- </form> --}}
                <div class="container text-footer sticky-bottom">
                    <hr class="footer">
                    <p align="center">If you have problem in loggin in, please contact our IT
                        Application Development Team 9909</p>
                    <a href="https://imip.co.id/" class="text-success text-decoration-none"><p align="center"> {{ env('APP_FOOTER') }} </p></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
