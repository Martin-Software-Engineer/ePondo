<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="msapplication-TileColor" content="#ffffff">
    <!-- <meta name="msapplication-TileImage" content="{{asset('/app-assets/images/logo/ms-icon-144x144.png')}}"> -->
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="/manifest.json">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style_myaccount.css')}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('app-assets/images/additional_pictures/logo2.png')}}" />
    <title>{{ config('app.name','ePondo') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    <link href="{{asset('app-assets/vendors/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <!-- END: Vendor CSS-->
    @yield('vendors_css')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">

    @yield('external_css')

    @yield('stylesheets')

    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tags-input.css') }}">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns footer-static menu-expanded pace-done navbar-sticky" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <div id="main-content-wrapper">
        @include('admin.partials.header')
        @include('admin.partials.menu')

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                    @yield('header')
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('admin.partials.footer')

        @yield('modals')
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    @yield('vendors_js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}">
    </script>
    <!-- END: Page Vendor JS-->
    @yield('external_js')

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    @yield('scripts')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

    </script>
</body>
<!-- END: Body-->

</html>
