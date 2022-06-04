<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- css --}}
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/lib/sidenav/sidenav.min.css">
    <link rel="stylesheet" href="/css/global.css">
    {{-- end css --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    {{-- looping data css controller --}}
    @foreach ($data['css'] as $dt)
        <link rel="stylesheet" href="{{ $dt }}">
    @endforeach

    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')
            
                @yield('container')
        </div>
    </div>
    @include('layouts.footer')
    @include('layouts.modal')
</body>

{{-- js --}}
<script src="/lib/jquery/jquery.min.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
<script src="/lib/sidenav/sidenav.min.js"></script>
<script src="/js/global.js"></script>
<script>$('[data-sidenav]').sidenav();</script>
{{-- end js --}}


{{-- looping data js controller --}}
@foreach ($data['js'] as $dt)
<script src="{{ $dt }}"></script>
@endforeach


</html>
