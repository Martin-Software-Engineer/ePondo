@extends('landing.layouts.main')
@section('stylesheets')
<style>
    .paypal-should-focus .paypal-button:focus, .paypal-should-focus .paypal-button-card:focus {
          outline: solid 2px Highlight;
          outline: auto 0px -webkit-focus-ring-color !important;
          outline-offset: 0 !important;
      }
      
      .card-payment .card-body{
        padding-top: 15px !important;
        padding-bottom: 15px !important;
      }
      .topay{
        font-size: 18px;
        font-weight: 500;
      }
      .topay .topay-amount{
        font-size: 20px;
        font-weight: 600;
      }

      .stripe-payment{
        width: 100%;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
          0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
      }

      .stripe-payment input{
        border-radius: 6px;
        margin-bottom: 6px;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        font-size: 16px;
        width: 100%;
        background: white;
      }

      .stripe-payment .result-message {
        line-height: 22px;
        font-size: 16px;
      }
      .stripe-payment .result-message a {
        color: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
      }
      .stripe-payment .hidden {
        display: none;
      }
      .stripe-payment #card-error {
        color: rgb(105, 115, 134);
        text-align: left;
        font-size: 13px;
        line-height: 17px;
        margin-top: 12px;
      }
      .stripe-payment #card-element {
        border-radius: 4px 4px 0 0 ;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        width: 100%;
        background: white;
      }
      .stripe-payment #payment-request-button {
        margin-bottom: 32px;
      }
      /* Buttons and links */
      .stripe-payment button, #pay-by-card{
        background: #5469d4;
        color: #ffffff;
        font-family: Arial, sans-serif;
        border-radius: 0 0 4px 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
      }
      .stripe-payment button:hover,#pay-by-card:hover {
        filter: contrast(115%);
      }
      .stripe-payment button:disabled, #pay-by-card:disabled {
        opacity: 0.5;
        cursor: default;
      }
      /* spinner/processing state, errors */
      .stripe-payment .spinner,
      .stripe-payment .spinner:before,
      .stripe-payment .spinner:after {
        border-radius: 50%;
      }
      .stripe-payment .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
      }
      .stripe-payment .spinner:before,
      .stripe-payment .spinner:after {
        position: absolute;
        content: "";
      }
      .stripe-payment .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
      }
      .stripe-payment .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
      }
      @-webkit-keyframes loading {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @keyframes loading {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
</style>
@endsection

@section('content')
<div class="events_section layout_padding_campaignspage">
    <div class="container">
        <!-- Campaign Header - Start -->
        <div class="row">
            <div class="col-sm-12">
                <h1 class="campaign_title">{{$campaign->title}}</h1>
                <span class="campaign_category">
                    @foreach($campaign->categories as $category)
                        {{$category->name}} @if(!$loop->last)/@endif
                    @endforeach
                </span>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="progress-wrapper campaign_progress_bar">
                            <div id="example-caption-2">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="campaign_raised_text">Php {{$campaign->progress->current_value}} <br>Raised</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="campaign_target_text">Php {{$campaign->progress->target_value}} <br>Target </h6>
                                        <h6 class="campaign_target_date">({{date('F d, Y', strtotime($campaign->target_date))}})</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-bar-primary">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" 
                                    aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%" 
                                    aria-describedby="example-caption-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 campaign_donate_btn">
                        <div class="donate_btn btn btn-block " data-campaign-id="{{$campaign->id}}">
                            <h2 class="donate_now"><img src="{{asset('app-assets/images/additional_pictures/icon-4.png')}}" class="donate_now_img">Donate Now!</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Campaign Header - End -->

        <!-- Campaign Content - Start -->
        <div class="row">
            <div class="col-md-8">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($campaign->photos as $photo)
                            <div class="carousel-item @if($loop->index == 0) active @endif ">
                                <img class="d-block w-100 campaign_images" src="{{Storage::url($photo->url)}} " alt="Second slide">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Campaign Summary</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="jobseeker-tab" data-toggle="tab" href="#jobseeker" role="tab" aria-controls="jobseeker" aria-selected="false">Jobseeker Profile</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating" aria-selected="false">Rating & Feedback</a>
                    </li> -->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade " id="summary" role="tabpanel" aria-labelledby="summary-tab">
                        <div class="card">
                            <!-- <div class="card-header">About Campaign</div> -->
                            <div class="card-body">
                                {{$campaign->description}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="jobseeker" role="tabpanel" aria-labelledby="jobseeker-tab">
                        <div class="card">
                            <div class="card-body">
                            <!-- Profile Header -->
                                <div class="row section_profile_header">
                                    <div class="col-sm-3">
                                        <img src="{{asset('app-assets/images/additional_pictures/customer_v2.png')}}" class="campaign_profile_avatar" alt="">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="col-sm-9">
                                            <h1>{{$campaign->jobseeker->userinformation->firstname}}
                                                {{$campaign->jobseeker->userinformation->lastname}}</h1>
                                            <div class="row pl-3">
                                                <img src="{{asset('app-assets/images/additional_pictures/phone.png')}}" class="campaign_header_icons" alt="">
                                                <h6>{{$campaign->jobseeker->userinformation->phone}}</h6>
                                            </div>
                                            <div class="row pl-3">
                                                <img src="{{asset('app-assets/images/additional_pictures/email.png')}}" class="campaign_header_icons" alt="">
                                                <h6>{{$campaign->jobseeker->email}}</h6>
                                            </div>
                                            <div class="row pl-3">
                                                <img src="{{asset('app-assets/images/additional_pictures/location.png')}}" class="campaign_header_icons" alt="">
                                                <h6>{{$campaign->jobseeker->userinformation->address}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Profile Description -->
                                <div class="row section_profile_desc">
                                    <!-- Details -->
                                    <div class="col-sm-6 section_details">
                                        <h6>Age: {{$campaign->jobseeker->userinformation->age}}</h6>
                                        <h6>Gender: ??</h6>
                                        <h6>Kids: 
                                            @forelse($campaign->jobseeker->kids as $kid)
                                                @if(!$loop->last)
                                                    {{$kid->fullname.','}}
                                                @else
                                                    {{$kid->fullname}}
                                                @endif
                                            @empty 
                                            <span>N/A</span>
                                            @endforelse
                                        </h6>
                                        <h6>Dependents: 
                                            @forelse($campaign->jobseeker->dependents as $dependent)
                                                @if(!$loop->last)
                                                    {{$dependent->fullname.','}}
                                                @else
                                                    {{$dependent->fullname}}
                                                @endif
                                            @empty 
                                            <span>N/A</span>
                                            @endforelse
                                        </h6>
                                        <h6>Job: {{$campaign->jobseeker->userinformation->current_job}}</h6>
                                        <h6>Skills: 
                                            @forelse($campaign->jobseeker->skills as $skill)
                                                @if(!$loop->last)
                                                    {{$skill->work_skill.','}}
                                                @else
                                                    {{$skill->work_skill}}
                                                @endif
                                            @empty 
                                            <span>N/A</span>
                                            @endforelse
                                        </h6>
                                        <h6>Work Experience: 
                                            @forelse($campaign->jobseeker->workexperiences as $workexp)
                                                @if(!$loop->last)
                                                    {{$workexp->description.','}}
                                                @else
                                                    {{$workexp->description}}
                                                @endif
                                            @empty 
                                            <span>N/A</span>
                                            @endforelse
                                        </h6>
                                    </div>
                                    <!-- About Me -->
                                    <div class="col-sm-6">
                                    <h3>About Me</h3>
                                    <h6>{{$campaign->jobseeker->userinformation->bio}}</h6>
                                    </div>
                                </div>
                            <!-- Living State -->
                                <div class="row section_living_state">
                                    <div class="col-sm-12">
                                        <h3>Living State</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Income -->
                                    <div class="col-sm-6 section_income">
                                        <h5>Average Daily Income: Php {{$campaign->jobseeker->userinformation->daily_income}}</h5>
                                        <h6>Main Source Income: {{$campaign->jobseeker->userinformation->main_source_income}}</h6>
                                        <h6>Other Source Income: {{$campaign->jobseeker->userinformation->extra_source_income}}</h6>
                                    </div>
                                    <!-- Expenses -->
                                    <div class="col-sm-6">
                                        <h5>Average Daily Expenses: Php {{$campaign->jobseeker->userinformation->daily_expenses}}</h5>
                                        <h6>Type of Housing: {{$campaign->jobseeker->userinformation->type_of_housing}}</h6>
                                        <h6>Meals per Day: {{$campaign->jobseeker->userinformation->daily_meals}}</h6>
                                        <h6>Water: {{$campaign->jobseeker->userinformation->water_access}}</h6>
                                        <h6>Electricity: {{$campaign->jobseeker->userinformation->electricity_access}}</h6>
                                        <h6>Clothes: {{$campaign->jobseeker->userinformation->clean_clothes_access}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <div class="card">
                            <div class="card-body">
                                {{$campaign->description}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">...</div> -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <!-- <div class="card-header text-center">
                        <h3 class="card-title">{{$campaign->title}}</h3>
                        <p>{{$campaign->description}}</p>
                    </div> -->

                    <!-- <div class="card-body">
                        <div class="donate_btn btn btn-block btn-success" data-campaign-id="{{$campaign->id}}">Donate Now!</div>
                    </div> -->

                    <!-- <div class="card-footer d-flex justify-content-start"> -->
                    <div class="card-header text-center">
                        <div class="row">
                            <img src="{{asset('app-assets/images/additional_pictures/customer_v2.png')}}" class="campaign_profile_avatar" alt="">
                        </div>
                        <div class="info">
                            <!-- <h6>Posted By</h6> -->
                            <!-- <h3><strong>{{$campaign->jobseeker->username}}</strong></h3> -->
                            <h3><strong>{{$campaign->jobseeker->userinformation->firstname}} {{$campaign->jobseeker->userinformation->lastname}} </strong></h3>
                        </div>
                    </div>
                    <div class="card-body c_j_body">
                        <div class="row">
                            <p class="campaign_jobseeker_about"> 
                            This portion will be the Jobseeker "About Me" data. My name is Carla Lacy, I am the 
                            grandmother of Aiden Leos’s 15-year-old sister, Alexis Cloonan. I have a very close bond and relationship with Aidans 
                            mother and family. I have been asked to speak on their behalf and been given permission by the mother, Joanna Cloonan 
                            to organize this fundraiser on behalf of her and the family’s needs. 
                            </p>
                            <h5 class="c_j_vm">View More ></h5>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header text-center">
                        <div class="info">
                            <strong>Messages</strong>
                        </div>
                    </div>
                    <div class="card-body c_j_body">
                        <div class="row">
                            <h6 class="campaign_jobseeker_about">1 Donor Name/Message/Date/Amount</h6>
                            <h6 class="campaign_jobseeker_about">2 Donor Name/Message/Date/Amount</h6>
                            <h6 class="campaign_jobseeker_about">3 Donor Name/Message/Date/Amount</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Campaign Content - End -->
    </div>

    <div class="container">
        <!-- Service Tiles - Start -->
        <div class="row pt-4">
            <div class="col-sm-12">
                <h1 class="news_taital">Avail My Services</h1>
            </div>
        
        </div>
        <div class="row">
            <div class="col-sm-3 pt-4">
                <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7">
                                <a href="#">
                                    <img src="https://images.unsplash.com/photo-1614945201491-b867f6031bdd?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="img_7">
                                </a>
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="give_taital_1 overflow-ellipsis"><a href="#">Title</a></h1>
                            <div style="margin: 0 0 0 20px;"><img src=""><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"></div>
                            <p class="ipsum_text_1 ">by: Jobseeker Name</p>
                            <p class="ipsum_text_1 ">description</p>
                            <div>
                                <p class="ipsum_text_1">Category</p>
                            </div>
                            <div>
                                <p class="ipsum_text_1">Location: </p>
                            </div>
                            <div>
                                <p class="ipsum_text_1">Duration:  Hr/s</p>
                            </div>
                            <h5 class="service_price">₱</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 pt-4">
                <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7">
                                <a href="#">
                                    <img src="https://images.unsplash.com/photo-1614945201491-b867f6031bdd?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="img_7">
                                </a>
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="give_taital_1 overflow-ellipsis"><a href="#">Title</a></h1>
                            <div style="margin: 0 0 0 20px;"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star_1.png')}}"></div>
                            <p class="ipsum_text_1 ">by: Jobseeker Name</p>
                            <p class="ipsum_text_1 ">description</p>
                            <div>
                                <p class="ipsum_text_1">Category</p>
                            </div>
                            <div>
                                <p class="ipsum_text_1">Location: </p>
                            </div>
                            <div>
                                <p class="ipsum_text_1">Duration:  Hr/s</p>
                            </div>
                            <h5 class="service_price">₱</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Tiles - End -->
    </div>
</div>
      
@endsection

@section('modals')
<div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Donation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('campaign.donate')}}" class="donation_form">
            @csrf
            <input type="hidden" name="campaign_id">
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="campaign-title"></h2>
                    </div>
                </div>
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 class="card-title">Your Info</h5>
                        @guest
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">Firstname</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Lastname</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" name="email_address" class="form-control">
                                </div>
                            </div>
                        </div>
                        @endguest
                        @auth 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name">Firstname</label>
                                        <input type="text" name="first_name" class="form-control" value="{{auth()->user()->information->firstname}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name">Lastname</label>
                                        <input type="text" name="last_name" class="form-control" value="{{auth()->user()->information->lastname}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" class="form-control" value="{{auth()->user()->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_anonymous" value="1" id="disableUserInfoInputs">
                                    <label class="form-check-label" for="disableUserInfoInputs">
                                        Would you like to donate anonymously?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="php">PHP</option>
                                        <option value="usd">USD</option>
                                    </select>
                                    <input type="number" name="amount" step=".01" placeholder="Amount in PHP/USD" class="form-control" required>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message to Jobseeker/Campaign (optional)</label>
                                    <textarea name="message" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Transaction Fee</h5>
                                <h5>Payment Processing Fee</h5>
                                <h5><strong>Total Amount</strong></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>5%</h5>
                                <h5>3%</h5>
                                <h5 class="total_amount"></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Donate Now!</button>
            </div>
        </form>
      </div>
    </div>
</div>    
<div class="modal fade" id="selectPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:400px" role="document">
      <div class="modal-content">
        <div class="loader"></div>
        <div class="card card-payment text-center hide">
          <div class="card-header pb-0">
            <h2 class="card-title"></h2>
          </div>
          <div class="card-body">
              <h3 class="topay"></h3>
              <div class="links">
                <div id="paypal-button"></div>
              </div>
              <p class="mt-1">or</p>
              <button type="button" id="pay-by-card">
                <span id="button-text">Pay with Card</span>
              </button>
              <form id="payment-form" class="stripe-payment d-none">
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <button id="submit">
                  <div class="spinner hidden" id="spinner"></div>
                  <span id="button-text">Pay</span>
                </button>
                <p id="card-error" role="alert"></p>
                <p class="result-message hidden">
                  Payment succeeded, see the result in your
                  <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                </p>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $(function(){
        'use strict'
        var donateModal = $('#donateModal'), 
            donationForm = $('.donation_form'),
            selectPaymentModal = $('#selectPaymentMethodModal'),
            cardPayment = $('.card-payment'),
            checkboxAnonymous = $('input[name=is_anonymous]');

        $('.donate_btn').on('click', async function(){
            var campaignId = $(this).data('campaignId');
            const campaign = await $.get(`/campaign/${campaignId}/details`);
            donateModal.find('.campaign-title').text(campaign.title);
            donateModal.find('form').find('input[name=campaign_id]').val(campaign.id);
            donateModal.modal('show');
        });

        checkboxAnonymous.on('change', function(){
            if($(this).is(':checked')){
                donationForm.find('input[name=first_name]').prop('disabled', true);
                donationForm.find('input[name=last_name]').prop('disabled', true);
                donationForm.find('input[name=email_address]').prop('disabled', true);
            }else{
                donationForm.find('input[name=first_name]').prop('disabled', false);
                donationForm.find('input[name=last_name]').prop('disabled', false);
                donationForm.find('input[name=email_address]').prop('disabled', false);
            }
        });

        donationForm.find('input[name=amount]').on('keyup', function(){
            var totalAmount = 0;
            var currency = donationForm.find('select[name=currency]').val();

            if(donationForm.find('input[name=amount]').val() > 0){
                totalAmount = donationForm.find('input[name=amount]').val()
            }

            $('.total_amount').text(`${currency.toUpperCase()} ${totalAmount}`);
        });

        donationForm.find('select[name=currency]').on('change', function(){
            var totalAmount = 0;
            var currency = donationForm.find('select[name=currency]').val();

            if(donationForm.find('input[name=amount]').val() > 0){
                totalAmount = donationForm.find('input[name=amount]').val()
            }

            $('.total_amount').text(`${currency.toUpperCase()} ${totalAmount}`);
        });

        donationForm.on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function(){
                    donationForm.find('button[type=submit]').prop('disabled', true);
                },
                success: function(resp){
                    if(resp.success){
                        donationForm.find('button[type=submit]').prop('disabled', false);
                        donationForm.find('input[name=amount]').val('');
                        donationForm[0].reset();
                        checkboxAnonymous.trigger('change');
                        donateModal.modal('hide');

                        cardPayment.find('#paypal-button').attr('data-donation-id', resp.donation_id);
                        cardPayment.find('#paypal-button').attr('data-currency', resp.currency);
                        cardPayment.find('#pay-by-card').attr('data-donation-id', resp.donation_id);
                        cardPayment.find('#pay-by-card').attr('data-currency', resp.currency);

                        cardPayment.find('.card-title').html(`<strong>Pay your Donation.<br>`);
                        cardPayment.find('.topay').html(`Amount to pay  <span class='topay-amount'>${resp.currency} ${resp.donation_amount}</span>`);

                        selectPaymentModal.modal('show');
                    }
                }
            });
        });

        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                size: 'responsive',
                color: 'blue',
                shape: 'pill',
                label: 'paypal',
                tagline: 'false'
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
            // 2. Make a request to your server
                var donation_data = $('#paypal-button').data();
                return actions.request.post("{{route('api.donation_create_paypal')}}", {
                    donation_id : donation_data.donationId,
                    currency : donation_data.currency
                }).then(function(res) {
                    // 3. Return res.id from the response
                    return res.id;
                });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
            // 2. Make a request to your server
            return actions.request.post("{{route('api.donation_execute_paypal')}}", {
                paymentID: data.paymentID,
                payerID:   data.payerID
            })
                .then(function(res) {
                    if(res.state = 'approved'){
                        $('#selectPaymentMethodModal').modal('hide');
                        Swal.fire({
                            title: 'Payment Successful',
                            text: 'Your donation was successful, Thank You!',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        })
                    }
                });
            }
        }, '#paypal-button');

        var stripe = Stripe("{{env('STRIPE_PUB_KEY')}}");

        var stripePayment = function(donation_id, currency){
            var donate = { donation_id, currency  };

            fetch("{{route('api.donation_create_stripe')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(donate)
            }).then(function(result) {
                return result.json();
            }).then(function(data) {
                var elements = stripe.elements();
                var style = {
                    base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#32325d"
                    }
                    },
                    invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                    }
                };
                var card = elements.create("card", { style: style });
                // Stripe injects an iframe into the DOM
                card.mount("#card-element");
                card.on("change", function (event) {
                    // Disable the Pay button if there are no card details in the Element
                    document.querySelector("button").disabled = event.empty;
                    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
                });
                var form = document.getElementById("payment-form");
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    // Complete payment when the submit button is clicked
                    payWithCard(stripe, card, data.clientSecret);
                });
            });

        }

        
        // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
        stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer
                    showError(result.error.message);
                } else {
                    // The payment succeeded!
                    orderComplete(result.paymentIntent.id);
                }
            });
        };

        /* ------- UI helpers ------- */
        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId) {
            $.ajax({
                url: "{{route('api.donation_confirm_stripe')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: paymentIntentId
                }, 
                success: function(resp){
                    if(resp.success){
                        $('#selectPaymentMethodModal').modal('hide');
                        Swal.fire({
                            title: 'Payment Successful',
                            text: 'Your donation was successful, Thank You!',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        })
                    }
                }
            });
            document.querySelector("button").disabled = true;
        };

        $('#pay-by-card').on('click', function(){
            var data = $(this).data();
            $(this).addClass('d-none');
            $('.stripe-payment').removeClass('d-none');
            stripePayment(data.donationId, data.currency);
        });
    });
</script>
@endsection