<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alfatawa Alhanafia</title>
    <link rel="shortcut icon" type="image/jpg" href="{{asset('logo.png')}}" />
    <link rel="apple-touch-icon" href="{{asset('logo.png')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Font Awesome Icon-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @if(app()->getLocale() == "en")
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    h1,h2,h3,h4,h5,h6,p,div,span{
        text-align: left !important;
    }
    @media(max-width: 768px){
        .nav-auth{
            display: block;
        }
    }

    @media(min-width: 769px){
        .nav-auth{
            display: none;
        }
    }
    </style>
    @endif

    @if(app()->getLocale() == "bn")
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        
    body {
        font-family: 'Baloo Da 2', cursive;
    }
    h1,h2,h3,h4,h5,h6,p,div,span{
        text-align: left !important;
    }
    </style>
    @endif
    @if(app()->getLocale() == "ar")
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,div,span{
        text-align: right !important;
        }
    </style>

    @endif


    @yield('css')
</head>

<body>
    <div id="app">
        @include('frontend.layouts.topbar')
        @include('frontend.layouts.navbar')
        @yield('content')
        @include('frontend.layouts.footer')
    </div>


    <script src="{{ asset('js/app.js?v=1.2') }}" defer></script>

    <script>
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>

    <script>
        //sticky navbar
        $(window).scroll(function() {
            let position = $(this).scrollTop();
            if (position >= 250) {
                $('#MyNavbar').addClass('fixed-top');
            } else {
                $('#MyNavbar').removeClass('fixed-top');
            }
        })
    </script>

    <script type="text/javascript">
        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>
    @yield('js')
</body>

</html>
