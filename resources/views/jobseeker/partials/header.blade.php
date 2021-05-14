<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item mr-1"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Home" data-original-title="Home"><i class="ficon" data-feather="home"></i></a></li>
            <li class="nav-item mr-1"><a class="nav-link" href="{{route('chats')}}" data-toggle="tooltip" data-placement="top" title="Messages" data-original-title="Messages"><i class="ficon" data-feather="message-square"></i></a></li>
            <li class="nav-item mr-1"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Notifications" data-original-title="Notifications"><i class="ficon" data-feather="bell"></i></a></li>
            <li class="nav-item mr-1">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout" data-original-title="Logout"><i class="ficon" data-feather="power"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{auth()->user()->username}}</span>
                        <span class="user-status">
                            @foreach(auth()->user()->roles as $role)
                                @if(!$loop->last)
                                    {{$role->name}}/
                                @else 
                                    {{$role->name}}
                                @endif
                            @endforeach
                        </span>
                    </div>
                    
                    @if(auth()->user()->avatar != '')
                    <span class="avatar">
                        <img class="round" src="{{Storage::url(auth()->user()->avatar)}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                    @else 
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar colorClass">
                            
                                <!-- <span class="avatar-content avatar-header"></span> -->
                                <!-- strtoupper(System::get_avatar(auth()->user()->username)) -->
                                <!--  -->
                            </div>
                            <div class="d-flex flex-column">
                                <span class="emp_name text-truncate font-weight-bold"></span>
                                <small class="emp_post text-truncate text-muted"></small>
                            </div>
                        </div>
                    @endif
                    
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->