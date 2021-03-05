<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('/assets/js/script.js')}}"></script>

</head>
<body>
    <h1>@yield('title')</h1>
    <div class="right">
        @yield('registration')
    </div>
    <div class="center-left">
        @yield('msg')
        @yield('form')
    </div>
    <div class="content">
        @yield('content')
    </div>
    
    <div class="footer">
        @yield('footer')
    </div>
</body>
</html>