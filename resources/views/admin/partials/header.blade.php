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
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">John Doe</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="page-profile.html">
                        <i class="mr-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href=""><i class="mr-50" data-feather="message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href=""><i class="mr-50" data-feather="settings"></i> Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->