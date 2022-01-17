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
                <div class="user_desc"> 	Jobseekers are categorized into two groups. The first group consists of Filipinos that are in need 
                  of monetary support for their causes such as Medical, Educational, Emergencies etc. The second group consists of Filipinos that
                  are looking for customers/clients to provide their services to. Through this platform they will be able to create fundraising
                  campaigns and create service postings. Further details on these will be explained below. </div>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_4.png')}}"></div>
                     </div>
                     <div class="col-sm-8" >
                        <h3 class="user_title">Create Campaign</h3>
                        <div class="user_desc"> 	As a Jobseeker you will be able to create campaign postings. Each campaign post will contain a
                         title, description, category, target date, target amount and campaign photos. These details will all be displayed in its
                          very own campaign page. On the campaign page users will be able to see the campaign details, the amount raised, jobseeker
                           public profile, donation messages and also the service postings by the jobseeker at the bottom.  </div>
                     </div>
                  </div>
                  <div class="row mt-4">
                     <div class="col-sm-4">
                        <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service_2.png')}}"></div>
                     </div>
                     <div class="col-sm-8">
                        <h3 class="user_title">Create Service</h3>
                        <div class="user_desc">	As a jobseeker you will also be able to create service postings.  Each service post will contain a 
                           title, description, category, price, duration, location and service photos. These details will all be displayed in its very
                           own service page. On the service page users will be able to see the service details, the jobseeker public profile, service
                           rating & feedback and also the campaign postings by the jobseeker at the bottom.</div>
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
                <div class="user_desc">	Backer and Customer are two different roles but are categorized into one user as they serve the same purpose of
                     supporting Jobseekers. Backer is the term used to represent Filipinos that are looking to donate to the different campaigns. Customer
                     on the other hand is the term used to represent Filipinos that would like to avail services. Through this platform they will be able
                     to donate to campaigns and avail services. Further details on these will be explained below.</div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/donation_5.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="donate">
                     <h3 class="user_title">Donate to Campaigns</h3>
                     <div class="user_desc">	As a backer you will be able to browse through the different campaigns posted by the Jobseeker. Once you have
                           found a campaign that resonates with the causes that are close to you, you have the option to donate your monetary support towards
                          it. Know that the platform is fully non-profit therefore no fees or charges are applied to your donation besides the standard 
                          processing payment fees issued by the bank. </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/service.png')}}"></div>
                  </div>
                  <div class="col-sm-8" id="availservice">
                     <h3 class="user_title">Avail Services</h3>
                     <div class="user_desc">	As a backer you will be able to browse through the different services posted by the Jobseeker. Once you have found
                         a service that you would like to avail you need only now to click the avail service button to begin the process. The platform will
                         facilitate the service process to ensure that from start to finish you are covered.</div>
                  </div>
                </div>
            </div>
       </div>
   </div>
</div>

<div class="fundraise_section ">
    <div class="fundraise_section_main">
      <!-- ePondo Process Flow - Start -->
         <div class="col-sm-12">
           <div class="row">
             <div class="col"style="width: 100%;align-items: center;text-align: center;">
               <h1 class="mt-4 mb-2" style="font-weight:500;font-size: color:#041151;">Common Questions</h1>
             </div>
           </div>
           <div class="accordion" id="accordionExample">
             <!-- Card 1 - Start -->
            <div class="card">
              <div class="card-header" id="headingOne">
                <h1 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How to Sign-Up ?
                  </button>
                </h5>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Go to ePondo Home Page (www.ePondo.co). Click the 'Sign-Up' Button OR proceed to Log-In Page and click the 'Create an account' link.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Fill in all the necessary information such as; Username, Email, Password, First Name, Last Name, User Role. Click the 'Sign-Up' Button once you are finished. You will be routed back to the ePondo Home Page.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Verify Email. Check your Email Inbox for the verification link in order to complete your Sign-Up Process.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Congratulations! You have successfully Signed-Up. You may now Log-In to your Account.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card 1 - End -->
            <!-- Card 2 - Start -->
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How to Donate to a Campaign ?
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Login to your Account</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Select Campaign to Donate</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Click the 'Donate' button</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Fill in all the necessary data. Then click the 'Donate Now!' button</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Process payment via the Paypal Service. Using your Paypal Account or Debit/Credit Card</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span> Donation Successful! Check your Account and Email to verify your transactions. Thank you!</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card 2 - End -->
            <!-- Card 3 - Start -->
            <div class="card text-align-start">
              <div class="card-header align-items-start" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    How to Avail Services ?
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Login to your Account</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Select Service to Avail</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Click the 'Avail Service' button</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Fill in all the necessary data. Then click the 'Avail Service!' button</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Wait 1-3 days for Jobseeker to Accept your Service Order Request</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span> Order will be processed by the Jobseeker, once Service Order has been Accepted.  You may contact your Jobseeker for questions and updates. Please double check and ensure all details are correct.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 7 </span> Service Order Delivery Day. Once Jobseeker has delivered your service order, you will be notified for  processing of payment.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 8 </span> Process Payment. For Online Payment (OP) View your Invoice and click the 'Pay' button. For Cash-On-Delivery (COD) your Invoice will be available once Service Order is Accepted, please view the Invoice beforehand and prepare the exact amount  before the delivery date.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 9 </span> Feedback & Rating of your Service Order is required once Payment is Succesful.</div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col" style="text-align: left;">
                      <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 10 </span> Congratulations. Service Order Completed!</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card 3 - End -->
          </div>
         </div>
    </div>
</div>
@endsection
