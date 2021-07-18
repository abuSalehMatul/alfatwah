<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlFatwah') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('admin_asset/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ asset('admin_asset/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}"
        rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('admin_asset/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('admin_asset/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('admin_asset/css/colors/default.css') }}" id="theme" rel="stylesheet">
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

    @yield('css')

    <style>
        .space-position {
            position: relative;
            top: 20px;
            margin: 10px;
        }

        .hover-red:hover {
            font-weight: 600;
        }

        .hover-red a:hover {
            color: #03136D !important;
            background: none !important;
        }

        #side-menu>li>a {
            padding: 0px;
        }

        .container-fluid {
            background: white !important;
        }

        .custom-badge {
            background: #f7f5f5;
            color: #03136D !important;
        }

        .badge-info {
            background-color: #03136D;
        }

        .btn-success {
            background: #03136D !important;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #03136D;
        }

    </style>
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="app_backend">
        <div id="wrapper">
            @include('backend.layouts.topbar')

            @include('backend.layouts.sidebar')

            <div id="page-wrapper">
                @yield('content')
                <!-- /.container-fluid -->
                <footer class="footer text-center"> Developed By SJOpt . All rights Reserved By Alfatawa-alhanafia
                </footer>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
    </div>

    <!-- /#wrapper -->
    <script src="{{ asset('js/appBackend.js') }}"></script>

    <script src="{{ asset('admin_asset/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

    <script src="{{ asset('admin_asset/js/custom.min.js') }}"></script>
    {{-- <script>
        tinymce.init({
          selector: '#mytextarea'
        });
        tinymce.init({
          selector: '#mytextareaquestion'
        });
    </script> --}}
    @yield('js')
</body>

</html>
