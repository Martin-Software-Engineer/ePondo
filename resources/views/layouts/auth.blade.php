<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/app-assets/images/logo/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="/manifest.json">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('app-assets/images/additional_pictures/logo2.png')}}" />
    <title>ePondo</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/themes/bordered-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    @yield('css')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Header Navbar
include('landing.partials.header')
END: Header Navbar -->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern ligh-layout blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card ">
                            <div class="card-body">
                                <a href="/" class="brand-logo">
                                    <span class="brand-logo">
                                        <img src="{{asset('/app-assets/images/logo/logo.png')}}" style="width: 100px">
                                    </span>
                                </a>

                                @yield('content')

                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    @yield('page_js')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->
    @yield('js')
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

