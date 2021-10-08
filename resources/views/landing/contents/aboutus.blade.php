@extends('landing.layouts.main')

@section('content')
 <div class="about_section">
   <div class="container">
      <div class="row mt-4">
         <div class="col-sm-4">
            <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/logo2.png')}}"></div>
         </div>
         <div class="col-sm-8">
            <h2 class="about_taital">About Us</h2>
            <p class="about_text">
            ePondo is a rewards crowdfunding platform that aims to create a space for Filipinos to fundraise while
               creating a livelihood. The web-application provides the platform to help Filipinos fundraise for their
               desired campaign but also provide their services in support to their campaigns. This project aims to
               empower Filipinos and provide them opportunity despite the challenges they face today.
            </p>
         </div>
      </div>
   </div>
 </div>
 <div class="about_section2">
   <div class="container">
      <div class="row mt-4">
         <div class="col-sm-4">
            <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/vision.png')}}"></div>
         </div>
         <div class="col-sm-8">
            <h2 class="about_taital">Vision</h2>
            <p class="about_text">
            To create a safe space for Filipinos to be empowered and provide opportunity despite the challenges we face today
            </p>
         </div>
      </div>
   </div>
 </div>

 <div class="about_section3">
   <div class="container">
      <div class="row mt-4">
         <div class="col-sm-4">
            <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/background.png')}}"></div>
         </div>
         <div class="col-sm-8">
            <h2 class="about_taital">Background</h2>
            <p class="about_text">
            This web-application was created to provide assistance to the Filipinos families that need financial support.
               The team sought after a solution that would address the problem as well as provide an avenue for growth and
               opportunity. ePondo was formed to support the need for financial support while providing the opportunity for
               creating a livelihood.
            </p>
         </div>
         
      </div>
   </div>
</div>
@endsection