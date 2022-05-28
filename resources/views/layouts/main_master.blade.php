<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- css --}}
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    {{-- end css --}}

    {{-- looping data css controller --}}
    @foreach ($data['css'] as $dt)
        <link rel="stylesheet" href="{{ $dt }}">
    @endforeach
   
</head>

<body>
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')
            
                @yield('container')
        </div>
    </div>
</body>

{{-- js --}}
<script src="/lib/jquery/jquery-3.6.0.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>

<script src="/js/global.js"></script>
{{-- end js --}}

{{-- looping data js controller --}}
@foreach ($data['js'] as $dt)
<link rel="stylesheet" href="{{ $dt }}">
@endforeach

</html>
