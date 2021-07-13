<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item mr-1"><a class="nav-link" href="/" data-toggle="tooltip" data-placement="top" title="Home" data-original-title="Home"><i class="ficon" data-feather="home"></i></a></li>
            <li class="nav-item mr-1"><a class="nav-link" href="{{route('chats')}}" data-toggle="tooltip" data-placement="top" title="Messages" data-original-title="Messages"><i class="ficon" data-feather="message-square"></i></a></li>
            <li class="nav-item mr-1 dropdown dropdown-notification">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{count(auth()->user()->unreadNotifications)}}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">{{count(auth()->user()->unreadNotifications)}} New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">{{@$notification->data['heading']}}</span></p><small class="notification-text"> {{@$notification->data['text']}}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{route('backer.notifications')}}">Read all notifications</a></li>
                </ul>
            </li>            
            <li class="nav-item mr-1">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout" data-original-title="Logout"><i class="ficon" data-feather="power"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <p class="mb-0">Hello,
                            <span style="display:inline-block" class="user-name font-weight-bolder">{{auth()->user()->userinformation->firstname}}
                        </span>
                    </p>
                    <!-- <p class="mb-0">Hello,
                            <span style="display:inline-block" class="user-name font-weight-bolder">
                                {{auth()->user()->userinformation->firstname}}
                            </span>
                        </p> -->
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
                        <img class="round" src="{{auth()->user()->avatar}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                    @else 
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar colorClass">

                                <span class="avatar-content avatar-menu">{{strtoupper(substr(auth()->user()->username, 0,2))}}</span></div>
                                <!-- <span class="avatar-content avatar-header"></span> -->
                                <!-- strtoupper(System::get_avatar(auth()->user()->username)) -->
                                
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