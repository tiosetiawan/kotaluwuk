<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- css --}}
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-icons.css">
    {{-- end css --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
     {{-- toastr --}}
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    {{-- looping data css controller --}}
    @foreach ($data['css'] as $dt)
        <link rel="stylesheet" href="{{ $dt }}">
    @endforeach
   
</head>

<body>
    @yield('container')
</body>

{{-- js --}}
<script src="/lib/jquery/jquery.min.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
<script src="/js/global.js"></script>
{{-- end js --}}

{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

 {{-- looping data js controller --}}
@foreach ($data['js'] as $dt)
<script src="{{ $dt }}"></script>
@endforeach

</html>
