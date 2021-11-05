@extends('landing.layouts.main')

@section('content')
 <div class="fundraise_section ">
    <div class="fundraise_section_main">
      <!-- ePondo Process Flow - Start -->
        <div class="row">
            <div class="fundraise_img align-items-start"><img src="{{asset('app-assets/images/additional_pictures/concept_model_800x400_v3.png')}}"></div>
        </div>
         <div class="col-sm-12">
            <div class="row">
               <div class="just">ePondo is a Rewards Crowdfunding Platform. The goal of ePondo is to create a space where Filipinos can fundraise
                   for their desired campaigns and support their livelihood by providing services. ePondo operates on a Web-based application that
                    can be accessed on your preferred web browser. The web-based application caters to two specific users which are the jobseekers
                     and backers. The "Jobseekers" are users looking to fundraise and provide their services on the platform. The ""Backers" on
                      the other hand are users that support the campaigns through monetary donations or avail services posted by the jobseekers. The 
                      integration of a rewards model allows jobseekers to merit rewards per completed service order. To learn more how ePondo works,
                       please continue reading.
               </div>
            </div>
         </div>
        <div class="row mt-4">
         <div class="col-sm-2">
            <div class="user_avatar align-items-start"><img src="{{asset('app-assets/images/additional_pictures/reward.png')}}"></div>
         </div>
         <div class="col-sm-10">
            <h1>What is Rewards Crowdfunding ?</h1>
            <div class="just">Rewards Crowdfunding as the term states consists of two words which are 'rewards' and 'crowdfunding'. Reward 
            is any form of recognition that is given in leu of someone’s action. Crowdfunding is the practice by which one raises many 
            small amounts of monetary support from a large number of people. ePondo is all about the “bayanihan” Filipino trait, helping 
            one another. Therefore, ePondo created a unique rewards system that enables Jobseekers to be rewarded as they progress through
             the application and provide services to their customers. The rewards are classified into different tiers. To unlock these 
             tiers, the jobseekers must attain a certain amount of points. The rewards are tied up with the services. This means that the
              jobseekers will only receive a reward for every completed service order for their customer. And the reward given will 
              coincide with their reward tier classification.</div>
         </div>
        </div>
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
            <div class="col-sm-2 mb-4">
                <div class="user_avatar align-items-start mb-4"><img src="{{asset('app-assets/images/additional_pictures/bac_cus_200x200.png')}}"></div>
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
</div>
@endsection