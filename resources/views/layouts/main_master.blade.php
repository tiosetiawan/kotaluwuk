<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- css --}}
    <link href="{{ asset('/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/lib/bootstrap/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/lib/sidenav/sidenav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
    {{-- end css --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    {{-- looping data css controller --}}
    @foreach ($data['css'] as $dt)
        <link rel="stylesheet" href="{{ asset($dt) }}">
    @endforeach
</head>

<body class="d-flex flex-column">
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
<script> window.url = "@php echo url('/') @endphp"</script>
<script src="{{ asset('/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/lib/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/lib/sidenav/sidenav.min.js') }}"></script>
<script src="{{ asset('/js/global.js') }}"></script>
<script>$('[data-sidenav]').sidenav();</script>
{{-- end js --}}

{{-- looping data js controller --}}
@foreach ($data['js'] as $dt)
<script src="{{ asset($dt) }}"></script>
@endforeach

</html>
