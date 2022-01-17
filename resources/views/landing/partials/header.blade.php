<!-- header section start -->
<div class="header_section">
      <nav class="navbar navbar-expand-xl navbar-light bg-light ">
         <a class="navbar-brand" href="/"><img src="{{asset('app-assets/images/additional_pictures/navbar_logo.png')}}"></a>

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
               <li class="nav-item {{ Request::segment(1) === 'campaigns' ? 'active' : null }}">
                  <a class="nav-link" href="{{route('campaigns')}}">Campaigns</a>
               </li>
               <li class="nav-item {{ Request::segment(1) === 'services' ? 'active' : null }}">
                  <a class="nav-link" href="{{route('services')}}">Services</a>
               </li>
               <li class="nav-item {{ Request::segment(1) === 'aboutus' ? 'active' : null }}">
                  <a class="nav-link" href="{{route('aboutus')}}">About Us</a>
               </li>

               <li class="nav-item {{ Request::segment(1) === 'howitworks' ? 'active' : null }}">
                  <a class="nav-link" href="{{route('howitworks')}}">How it works</a>
               </li>
               <li class="nav-item {{ Request::segment(1) === 'username' ? 'active' : null }}">
               <div class="my-2 my-lg-0">
               @auth
                  @if(auth()->user()->hasAnyRole('Admin'))
                     <a class="nav-link" href="{{route('admin.index')}}">My Account</a>
                  @endif
                  @if(auth()->user()->hasAnyRole('JobSeeker'))
                     <a style="display:inline-block" class="nav-link" href="{{route('jobseeker.index')}}">My Account</a>
                  @endif
                  @if(auth()->user()->hasAnyRole('Backer'))
                     <a class="nav-link" href="{{route('backer.index')}}">My Account</a>
                  @endif
               @endauth
               @guest
                  <a class=" nav-link" href="{{route('login')}}">Log-In (Sign-Up)</a>
               @endguest
               </div>
               </li>
            </div>
         </div>
         
      </nav>
<!-- </div> -->
</div>
<!-- </div> -->

<!-- header section end -->
