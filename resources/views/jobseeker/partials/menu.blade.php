<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('jobseeker.index')}}"><span class="brand-logo">
                    <h2 class="brand-text">ePondo</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class=" card-profile mt-3 pt-3">
        <div class="card-body">
            <div class="profile-image-wrapper">
                <div class="profile-image">
                    <div class="avatar">
                        @if(auth()->user()->avatar != '')
                            <img src="{{Storage::url(auth()->user()->avatar)}}" alt="Profile Picture" />
                        @else 
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar colorClass">
                                    <span class="avatar-content avatar-menu">{{strtoupper(substr(auth()->user()->username, 0,2))}}</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate font-weight-bold"></span>
                                    <small class="emp_post text-truncate text-muted"></small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @if(request()->segment(2) == '') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.index')}}"><span class="menu-title text-truncate">My Account</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'profile') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.profile')}}"><span class="menu-title text-truncate">My Public Profile</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'campaigns') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.campaigns.index')}}"><span class="menu-title text-truncate">My Campaigns</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'services') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.services.index')}}"><span class="menu-title text-truncate">My Services</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'orders') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.orders')}}"><span class="menu-title text-truncate">Services Orders</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'invoices') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.invoices')}}"><span class="menu-title text-truncate">Invoice</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'rewards') active @endif"><a class="d-flex align-items-center" href="{{route('jobseeker.rewards')}}"><span class="menu-title text-truncate">Rewards</span></a></li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->