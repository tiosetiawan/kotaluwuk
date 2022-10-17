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
                            <div class="mt-5"></div>
                            <h3 class="text-left mb-3"><a href=""><img width="50%" src="{{ asset(env('APP_LOGO')) }}"></a></h3>
                            <p class="text-left" style="font-size: 8pt;">Login Dashboard. </p>
                                <div class="form-group mb-2">
                                    <label class="form-label" style="font-weight: 600;">Username</label>
                                    <input class="form-control" type="text" placeholder="Username" name="username" id="username" required>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="font-weight: 600;"> Password</label>
                                    <input class="form-control" type="password" placeholder="Password" name="password" id="password"
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
                <div class="container text-footer">
                    <hr>
                    <p align="center">Let's explore Banggai</p>
                    <a href="https://kotaluwuk.com/" class="text-success text-decoration-none"><p align="center"> {{ env('APP_FOOTER') }} </p></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
