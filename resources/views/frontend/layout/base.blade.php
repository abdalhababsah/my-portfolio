<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="theme-color" content="#28ec8d">
    <link rel="icon" href="assets/images/favicon.png" sizes="32x32" type="image/png">
    <title>Iconicwebs - Personal Portfolio or CV/Resume HTML Template</title>

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
</head>

<body class="bg-color12 bg-blend-luminosity dark-layer2 opc9 bg-att-fixed scheme1 dark"
    style="background-image: url({{ asset('frontend/assets/images/pattern-bg.png') }});">
    <main>
        <div class="page-loader">
            <div class="loader">
                <div class='loader-style-1 panelLoad'>
                    <div class='cube-face cube-face-front'>I</div>
                    <div class='cube-face cube-face-back'>C</div>
                    <div class='cube-face cube-face-left'>O</div>
                    <div class='cube-face cube-face-right'>N</div>
                    <div class='cube-face cube-face-bottom'>I</div>
                    <div class='cube-face cube-face-top'>C</div>
                </div>
                <span class="cube-face">Iconicwebs</span>
            </div>
        </div><!-- Page Loader -->
        @include('frontend.layout.header')
        @include('frontend.layout.sidepanel')



        @yield('content')
    </main><!-- Main Wrapper -->

    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ResizeSensor.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/theia-sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
</body>

</html>
