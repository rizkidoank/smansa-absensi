<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Sistem Absensi</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="{{asset('css/bootstrap-spacelab.min.css')}}" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="{{url('/css/additional.css')}}"/>
        <link rel="stylesheet" href="{{url('/css/animate.min.css')}}"/>
        @yield('stylesheet')
    </head>
    <body style="background-image: url(/images/bg.jpg)">
    @yield('content')

    </body>

    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/additional.js')}}"></script>
    @yield('script')
</html>
