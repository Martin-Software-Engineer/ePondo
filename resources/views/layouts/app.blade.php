
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    <link rel="stylesheet" href="css/style3.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Included token for all pages -->

        <title>{{ config('app.name','ePondo') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" class="href">

        <!-- JS -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
       <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">-->
            <nav style="">
            <div class="wrapper">
            <div class="logo"><a href="#">ePONDO</a></div>
            <input type="radio" name="slide" id="menu-btn">
            <input type="radio" name="slide" id="cancel-btn">
            <ul class="nav-links">
                <label for="cancel-btn" class="btn cancel-btn"><i class="fas fa-times"></i></label>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li>
                    <a href="#" class="desktop-item">Campaign Categories</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Campaign Categories</label>
                    <ul class="drop-menu">
                    <li><a href="#">Education</a></li>
                    <li><a href="#">Medical and Health</a></li>
                    <li><a href="#">Animals</a></li>
                    <li><a href="#">Non-profit and Charity</a></li>
                    <li><a href="#">Memorial and Funeral</a></li>
                    <li><a href="#">Emergencies</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="desktop-item">Job Categories</a>
                    <input type="checkbox" id="showJob">
                    <label for="showJob" class="mobile-item">Job Categories</label>
                    <div class="job-box">
                        <div class="content">
                            <div class="row">
                                <img src="css/bg.jpg" alt="">
                            </div>
                            <div class="row">
                                <header>Education Services</header>
                                <ul class="job-links">
                                <li><a href="#">Math Tutor</a></li>
                                <li><a href="#">Science Tutor</a></li>
                                <li><a href="#">Physics Tutor</a></li>
                                <li><a href="#">Humanities Tutor</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Home Care Services</header>
                                <ul class="job-links">
                                <li><a href="#">Babysitter</a></li>
                                <li><a href="#">Driver</a></li>
                                <li><a href="#">Gardener</a></li>
                                <li><a href="#">Messenger</a></li>
                                <li><a href="#">Cook</a></li>
                                <li><a href="#">Laundry</a></li>
                                <li><a href="#">Housekeeper</a></li>
                                <li><a href="#">Car Washer</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Food Services</header>
                                <ul class="job-links">
                                <li><a href="#">Kitchen Staff</a></li>
                                <li><a href="#">Assistant Cook</a></li>
                                <li><a href="#">Baker</a></li>
                                <li><a href="#">Waiter/Waitress</a></li>
                                <li><a href="#">Utility Staff</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Storekeeper Services</header>
                                <ul class="job-links">
                                <li><a href="#">Store Crew</a></li>
                                <li><a href="#">Assistant</a></li>
                                <li><a href="#">Manager</a></li>
                                </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#">Community</a></li>
                <li class="book-a-table text-center"><a href="login">Login</a></li>

            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>
            <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">{{ config('app.name','ePondo') }}</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>

                <div class="collapse navbar-collapse">
                    <a href="/Campaigns">Campaigns</a>
                    <a href="/Jobs">Services</a>
                    <a href="/Products">Products</a>
                    <a href="#" class="desktop-item">Job Categories</a>
                </div>
                <li>


                        <ul class="navbar-nav ml-auto"> -->

                        <!-- Authentication Links -->
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                                @csrf
                                </form>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('') }}</a>
                                </li>


                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('') }}</a>
                                </li>
                            @endif
                        @endauth
                    <!-- </div> -->
                    @endif

            </div>
        </nav>

        @can('logged-in')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    @can('is-Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                    @endcan

                    @can('is-JobSeeker')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobseeker.campaigns.index') }}">My Campaigns</a>
                    </li>
                    @endcan

                    <li class="nav-item active">
                        <a class="nav-link" href="/MyProfile">My Profile</a>
                    </li>



                    </ul>
                </div>
            </div>
        </nav>
        @endcan

        <main class="container">
            @include('partials.alerts')
        </main>
            @yield('content')
    </body>
</html>

 <!-- <div class="form-inline my-2 my-lg-0">
                        @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                                @csrf
                                </form>

                            @else
                                <a href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                        @endif-->

<!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
