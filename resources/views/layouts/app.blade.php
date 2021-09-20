
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

        <style>
            .chat {
              list-style: none;
              margin: 0;
              padding: 0;
            }
          
            .chat li {
              margin-bottom: 10px;
              padding-bottom: 5px;
              border-bottom: 1px dotted #B3A9A9;
            }
          
            .chat li .chat-body p {
              margin: 0;
              color: #777777;
            }
          
            .panel-body {
              overflow-y: scroll;
              height: 350px;
            }
          
            ::-webkit-scrollbar-track {
              -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
              background-color: #F5F5F5;
            }
          
            ::-webkit-scrollbar {
              width: 12px;
              background-color: #F5F5F5;
            }
          
            ::-webkit-scrollbar-thumb {
              -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
              background-color: #555;
            }
          </style>
          
    </head>
    <body>
      
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
                    <a href="#" class="desktop-item">Job Categories</a>
                </div>
                <li>


            <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
        
        <nav>
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
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                                @csrf
                                </form>
                    </li>
                    @endcan

                    @can('is-JobSeeker')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobseeker.campaigns.index') }}">My Campaigns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobseeker.myprofile.index') }}">My Profile</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                                @csrf
                                </form>
                    </li>
                    @endcan
                    



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