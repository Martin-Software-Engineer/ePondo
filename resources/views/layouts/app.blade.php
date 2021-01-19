<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
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
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">   
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
                </div>
                    
                    
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


                        <ul class="navbar-nav ml-auto">
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                           
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                    
                    </ul>
                </div>
            </div>
        </nav>
        @endcan

        <main class="container">
            @include('partials.alerts')
            @yield('content')
        </main>
    </body>
</html>
