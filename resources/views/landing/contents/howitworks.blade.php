@extends('landing.layouts.main')

@section('content')

<div class="mt-5">
   <a href="#how" class="w3-bar-item w3-button">About</a>
   <a href="#vision" class="w3-bar-item w3-button">Menu</a>
   <a href="#mission" class="w3-bar-item w3-button">Contact</a>
</div>

 <div class="about_section" id="how">
   <div class="container">
      <div class="row mt-4">
         <div class="col-sm-4">
            <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/logo2.png')}}"></div>
         </div>
         <div class="col-sm-8">
            <h2 class="about_taital">HOW IT WORKS!!!!!</h2>
            <p class="about_text">
            ePondo epondo
            <!-- <div class="readmore_bt"><a href="#">Read more</a></div> -->
         </div>
         
      </div>
   </div>
 </div>
 <div class="about_section2" id="vision">
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
               <!-- <div class="readmore_bt"><a href="#">Read more</a></div> -->
            </div>
         </div>
      </div>
 </div>
 <div class="about_section3" id="mission">
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
            <!-- <div class="readmore_bt"><a href="#">Read more</a></div> -->
         </div>
         
      </div>
   </div>
</div>
@endsection