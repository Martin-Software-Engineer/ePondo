@extends('landing.layouts.main')

@section('content')
<!-- <div class="about_section layout_padding">
    <div class="container">
       <div class="row">
          <div class="col-sm-8">
             <h2 class="about_taital">about Chrity</h2>
             <p class="about_text">many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If youmany variations of passages of Lorem Ipsum 
                available, but the majority have suffered 
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you many
                variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, byinjected humour, or randomised words which don't look even slightly believable. If you
             </p>
             <div class="readmore_bt"><a href="#">Read more</a></div>
          </div>
          <div class="col-sm-4">
             <div class="about_img"><img src="images/about-img.png"></div>
          </div>
       </div>
    </div>
 </div> -->
 <div class="about_section">
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
                  <!-- <div class="readmore_bt"><a href="#">Read more</a></div> -->
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
                  <!-- <div class="readmore_bt"><a href="#">Read more</a></div> -->
               </div>
               
            </div>
         </div>
</div>
@endsection