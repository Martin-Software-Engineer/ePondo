@extends('landing.layouts.main')

@section('content')
<!-- <div class="mt-5">
   <a href="#how" class="w3-bar-item w3-button">About</a>
   <a href="#vision" class="w3-bar-item w3-button">Menu</a>
   <a href="#mission" class="w3-bar-item w3-button">Contact</a>
</div> -->

 <!-- <div class="about_section" id="how">
   <div class="container">
      <div class="row mt-4">
         <div class="col-sm-4">
            <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/logo2.png')}}"></div>
         </div>
         <div class="col-sm-8">
            <h2 class="about_taital">HOW IT WORKS</h2>
            <p class="about_text"></p>
         </div>
      </div>
   </div>
 </div> -->

 <div class="fundraise_section ">
    <div class="fundraise_section_main">
      <!-- ePondo Process Flow - Start -->
        <div class="row">
            <div class="fundraise_img align-items-start"><img src="{{asset('app-assets/images/additional_pictures/concept_model_800x400_v3.png')}}"></div>
        </div>
        <div class="row">
         <p>Ipsum aliquyam tempor ea lorem dolores stet invidunt lorem ipsum stet. 
         Ea est sit ipsum rebum. Duo stet voluptua amet consetetur. Stet amet dolore sadipscing et. 
         Stet dolor diam kasd invidunt sit ut sit at. Duo ipsum diam consetetur invidunt
         Ipsum aliquyam tempor ea lorem dolores stet invidunt lorem ipsum stet. 
         Ea est sit ipsum</p>
        </div>
        <div class="row mt-4">
         <div class="col-sm-2">
            <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/reward.png')}}"></div>
         </div>
         <div class="col-sm-10 ">
            <h1>What is Rewards Crowdfunding ?</h1>
            <p>Sit ipsum eos amet voluptua sit sit. Amet sed aliquyam et magna et dolore ipsum duo, ipsum ut consetetur sea.</p>
         </div>
        </div>
      <!-- ePondo Process Flow - End -->  
        <!-- <div class="row">
          <div class="col-lg-4">
             <div class="box_main">
                <div class="icon_1"><img src="images/icon-1.png"></div>
                <h4 class="volunteer_text">Create Campaign</h4>
                <p class="lorem_text">Fundraise your cause through creating a campaign on the platform</p>
                <div class="join_bt"><a href="{{route('howitworks')}}">Read More</a></div>
                <div class="join_bt"><a href="{{route('howitworks')}}#mission">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main"> 
                <div class="icon_3"><img src="images/icon-3.png"></div>
                <h4 class="volunteer_text">Donate</h4>
                <p class="lorem_text">Our platform is made so you can browse through our website and donate to various campaigns</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
            <div class="box_main">
                <div class="icon_1"><img src="images/icon-2.png"></div>
                <h4 class="volunteer_text">Avail Service</h4>
                <p class="lorem_text">Browse through the different service offerings by the jobseekers</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
        </div> -->
    </div>
</div>

<div class="user_role_section" id="createcampaign">
   <div class="container">
       <!-- Jobseeker Title - Start -->
       <div class="row mt-2" style="border-bottom: 1px solid #ffff; padding-bottom: 20px;">
            <div class="col-sm-2">
                <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/jobseeker.png')}}"></div>
            </div>
            <div class="col-sm-10">
                <h1 class="user_title">Jobseeker</h1>
                <p class="user_desc">Descirption.   Est aliquyam et rebum kasd sit. Eos sea ipsum voluptua no sed voluptua takimata amet et, amet dolores kasd dolor diam sit, no no no sed nonumy et. Vero diam amet ipsum sit stet sed, et magna gubergren amet sit.</p>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_4.png')}}"></div>
                     </div>
                     <div class="col-sm-8" >
                        <h3 class="user_title">Create Campaign</h3>
                        <p class="user_desc">Amet dolore sadipscing diam invidunt voluptua est sit sea sit dolores. Justo at accusam ea et dolor sea. Gubergren nonumy.</p>
                     </div>
                  </div>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service_2.png')}}"></div>
                     </div>
                     <div class="col-sm-8">
                        <h3 class="user_title">Create Service</h3>
                        <p class="user_desc">Amet dolore sadipscing diam invidunt voluptua est sit sea sit dolores. Justo at accusam ea et dolor sea. Gubergren nonumy.</p>
                     </div>
                  </div>
            </div>
       </div>
       <div class="row mt-2" style="padding-top:10px;">
            <div class="col-sm-2  ">
                <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/bac_cus_200x200.png')}}"></div>
            </div>
            <div class="col-sm-10">
                <h1 class="user_title">Backer/ Customer</h1>
                <p class="user_desc">Description. Sed sed elitr justo lorem eirmod nonumy diam consetetur gubergren, dolore et sea nonumy magna accusam takimata duo tempor lorem, et kasd nonumy justo diam erat, amet duo sit eirmod dolores ipsum. Justo eirmod takimata sed invidunt labore no sanctus.</p>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_5.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="donate">
                     <h3 class="user_title">Donate to Campaigns</h3>
                     <p class="user_desc">Amet dolore sadipscing diam invidunt voluptua est sit sea sit dolores. Justo at accusam ea et dolor sea. Gubergren nonumy.</p>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="availservice">
                     <h3 class="user_title">Avail Services</h3>
                     <p class="user_desc">Amet dolore sadipscing diam invidunt voluptua est sit sea sit dolores. Justo at accusam ea et dolor sea. Gubergren nonumy.</p>
                  </div>
                </div>
            </div>
       </div>
       
   </div>
       <!-- Jobseeker Title - End -->

       <!-- Jobseeker Actions - Start -->
       <!-- <div class="row mt-2" style="border-bottom: 1px solid #ffff; padding-bottom: 20px;">
          <div class="row">
            <div class="col-sm-2  ">
                  <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/jobseeker.png')}}"></div>
               </div>
               <div class="col-sm-10  ">
                  <h1 class="user_title">Jobseeker</h1>
                  <h4 class="user_desc">About Jobseeker Description</h4>
               </div>
            </div>
       </div> -->
       <!-- Jobseeker Actions - End -->
    
</div>

 <!-- <div class="about_section2" id="vision">
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
         </div>
      </div>
   </div>
</div> -->
@endsection