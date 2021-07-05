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
            <div class="just">ePondo is a Rewards Crowdfunding Platform. The goal of ePondo is to create a space where Filipinos can 
            fundraise for their desired campaigns and also support their livelihood by also providing services. ePondo operates on a 
            Web-based application that can be accessed on your preferred web browser. The web-based application caters to two 
            specific users which are the jobseekers and the backers or customers. The jobseekers are users that are looking to 
            fundraise and provide their services on the platform. The backers/customers on the other hand are users that support the 
            campaigns through donations or avail the different services posted by the jobseekers.  Rewards are given to jobseekers as 
            they progress along the web-application and unlock the different reward tiers. To learn more how ePondo works, please continue reading.
            </div>
         </div>
        <div class="row mt-4">
         <div class="col-sm-2">
            <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/reward.png')}}"></div>
         </div>
         <div class="col-sm-10">
            <h1>What is Rewards Crowdfunding ?</h1>
            <div class="just">Rewards Crowdfunding as the term states consists of two words which are rewards and crowdfunding. Reward 
            is any form of recognition that is given in leu of someone’s action. Crowdfunding is the practice by which one raises many 
            small amounts of monetary support from a large number of people. ePondo is all about the “bayanihan” Filipino trait, helping 
            one another. Therefore, ePondo created a unique rewards system that enables Jobseekers to be rewarded as they progress through
             the application and provide services to their customers. The rewards are classified into different tiers. To unlock these 
             tiers, the jobseekers must attain a certain amount of points. The rewards are tied up with the services. This means that the
              jobseekers will only receive a reward for every completed service order for their customer. And the reward given will 
              coincide with their reward tier classification.</div>
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
                <p class="user_desc"> 	Jobseekers are categorized into two groups. The first group consists of Filipinos that are in need 
                  of monetary support for their causes such as Medical, Educational, Emergencies etc. The second group consists of Filipinos that
                  are looking for customers/clients to provide their services to. Through this platform they will be able to create fundraising
                  campaigns and create service postings. Further details on these will be explained below. </p>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_4.png')}}"></div>
                     </div>
                     <div class="col-sm-8" >
                        <h3 class="user_title">Create Campaign</h3>
                        <p class="user_desc"> 	As a Jobseeker you will be able to create campaign postings. Each campaign post will contain a
                         title, description, category, target date, target amount and campaign photos. These details will all be displayed in its
                          very own campaign page. On the campaign page users will be able to see the campaign details, the amount raised, jobseeker
                           public profile, donation messages and also the service postings by the jobseeker at the bottom.  </p>
                     </div>
                  </div>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service_2.png')}}"></div>
                     </div>
                     <div class="col-sm-8">
                        <h3 class="user_title">Create Service</h3>
                        <p class="user_desc">	As a jobseeker you will also be able to create service postings.  Each service post will contain a 
                           title, description, category, price, duration, location and service photos. These details will all be displayed in its very
                           own service page. On the service page users will be able to see the service details, the jobseeker public profile, service
                           rating & feedback and also the campaign postings by the jobseeker at the bottom.</p>
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
                <p class="user_desc">	Backer and Customer are two different roles but are categorized into one user as they serve the same purpose of
                     supporting Jobseekers. Backer is the term used to represent Filipinos that are looking to donate to the different campaigns. Customer
                     on the other hand is the term used to represent Filipinos that would like to avail services. Through this platform they will be able
                     to donate to campaigns and avail services. Further details on these will be explained below.</p>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_5.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="donate">
                     <h3 class="user_title">Donate to Campaigns</h3>
                     <p class="user_desc">	As a backer you will be able to browse through the different campaigns posted by the Jobseeker. Once you have
                           found a campaign that resonates with the causes that are close to you, you have the option to donate your monetary support towards
                          it. Know that the platform is fully non-profit therefore no fees or charges are applied to your donation besides the standard 
                          processing payment fees issued by the bank. </p>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="availservice">
                     <h3 class="user_title">Avail Services</h3>
                     <p class="user_desc">	As a backer you will be able to browse through the different services posted by the Jobseeker. Once you have found
                         a service that you would like to avail you need only now to click the avail service button to begin the process. The platform will
                         facilitate the service process to ensure that from start to finish you are covered.</p>
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