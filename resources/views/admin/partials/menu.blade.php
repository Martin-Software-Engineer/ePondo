<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
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
                        <img src="{{asset('app-assets/images/portrait/small/noface.png')}}" alt="Profile Picture" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @if(request()->segment(2) == 'campaigns') active @endif"><a class="d-flex align-items-center" href="{{route('admin.campaigns.index')}}"><span class="menu-title text-truncate">Campaigns</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'donations') active @endif"><a class="d-flex align-items-center" href="{{route('admin.donations.index')}}"><span class="menu-title text-truncate">Campaign Donation</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'services') active @endif"><a class="d-flex align-items-center" href="{{route('admin.services.index')}}"><span class="menu-title text-truncate">Services</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'service-orders') active @endif"><a class="d-flex align-items-center" href="{{route('admin.service-orders.index')}}"><span class="menu-title text-truncate">Service Orders</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'invoice') active @endif"><a class="d-flex align-items-center" href="{{route('admin.invoice.index')}}"><span class="menu-title text-truncate">Invoice</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'payouts') active @endif"><a class="d-flex align-items-center" href="{{route('admin.payouts.index')}}"><span class="menu-title text-truncate">Payout Requests</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'claimrequests') active @endif"><a class="d-flex align-items-center" href="{{route('admin.claimrequests.index')}}"><span class="menu-title text-truncate">Claim Requests</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'ratings') active @endif"><a class="d-flex align-items-center" href="{{route('admin.ratings.index')}}"><span class="menu-title text-truncate">Rating & Feedback</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'rewards') active @endif"><a class="d-flex align-items-center" href="{{route('admin.rewards.index')}}"><span class="menu-title text-truncate">Rewards & Points</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'users') active @endif"><a class="d-flex align-items-center" href="{{route('admin.users.index')}}"><span class="menu-title text-truncate">Users Management</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'jobseekers') active @endif"><a class="d-flex align-items-center" href="{{route('admin.jobseekers.index')}}"><span class="menu-title text-truncate">Jobseeker Public Profile</span></a></li>
            <li class="nav-item @if(request()->segment(2) == 'reports') active @endif"><a class="d-flex align-items-center" href="{{route('admin.reports.index')}}"><span class="menu-title text-truncate">Reports</span></a></li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->