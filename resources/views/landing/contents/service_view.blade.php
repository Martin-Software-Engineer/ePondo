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

      @media only screen and (max-width: 768px){
          .service_title{
              font-size: 26px;
          }
          .service_category{
              font-size: 15px;
          }
          .s_hlocation,.s_hduration{
              font-size: 16px;
          }
          .s_price{
              font-size: 30px;
          }
          .news_taital{
              font-size: 26px;
          }
          .service_btn{
              font-size: .8rem;
          }
      }
</style>
@endsection

@section('content')
<div class="events_section layout_padding_servicespage">
    <div class="container">
    <!-- Service Header - Start -->
        <div class="row">
          <div class="col-sm-12">
             <h1 class="service_title">{{$service->title}}</h1>
            <div class="row s_details">
                <div class="col-sm-4 mt-2">
                    <h4><span class="s_hlocation"> Category: </span> 
                        @foreach($service->categories as $category)
                        <span class="badge badge-info" style="background-color:#120a78;font-size:14px;">{{$category->name}}</span> @if(!$loop->last)@endif
                        @endforeach
                    </h4>
                    <h4><span class="s_hlocation"> Location: </span> {{$service->location}}</h4>
                    <h4> <span class="s_hduration"> Duration: </span>  {{$service->duration_hours}} Hrs {{$service->duration_minutes}} Mins</h4>
                </div>
                <div class="col-sm-4">
                    <h6 class="s_price">Php {{$service->price}}</h6>
                </div>
                <div class="col-sm-4">
                    
                        @guest
                        <div class="service_btn btn btn-block" href="{{route('login')}}">
                            <a href="{{route('login')}}">Log In to Avail Service</a>
                        </div>
                        @endguest
                        @auth
                        <div class="service_btn btn btn-block " data-service-id="{{$service->id}}">
                            <h2 class="donate_now"> <img src="{{asset('app-assets/images/additional_pictures/tap.png')}}" class="donate_now_img">Avail Service</h2>
                        </div>
                        @endauth
                    
                </div>
            </div>
          </div>
        </div>
    <!-- Service Header - End -->
        <div class="row">
            <div class="col-md-8">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                      @foreach($service->photos as $photo)
                      <div class="carousel-item @if($loop->index == 0) active @endif">
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
                <ul class="nav nav-tabs c_tab_space" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active c_tabs" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">About Service</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link c_tabs" id="jobseeker-tab" data-toggle="tab" href="#jobseeker" role="tab" aria-controls="jobseeker" aria-selected="false">Jobseeker Profile</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link c_tabs" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating" aria-selected="false">Rating & Feedback</a>
                    </li> -->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                        <div class="card ">
                            <!-- <div class="card-header">About Service</div> -->
                            <div class="card-body c_summary_area">
                                <!-- {{$service->description}} -->
                                <textarea cols="30" rows="15" class="form-control c_summary" style="border:none; outline:none;">{{$service->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade " id="jobseeker" role="tabpanel" aria-labelledby="jobseeker-tab">
                        <div class="card">
                            <div class="card-body">
                            <!-- Profile Header -->
                                
                            <!-- Profile Description -->
                                <div class="row section_profile_desc">
                                    <div class="col-sm-6 section_details">
                                        <!-- Jobseeker Profile & Name -->
                                            @if($service->jobseeker->avatar != '')
                                                <img src="{{$service->jobseeker->avatar}}" class="rounded-circle j_p_profile" alt="" />
                                            @else 
                                                <img src="{{asset('/app-assets/images/avatars/noface.png')}}" class="rounded-circle j_p_profile" alt="" />
                                            @endif
                                            <h1 class="j_p_name">
                                                {{$service->jobseeker->userinformation->firstname}}
                                                {{$service->jobseeker->userinformation->lastname}}
                                            </h1>
                                            <hr>
                                        <!-- Details -->
                                            <h3 class="j_p_header">Personal Information</h3>
                                            <h6 class="j_p_subtitle">Age:
                                                @if (empty($service->jobseeker->userinformation->age))
                                                <span class="j_p_text">N/A</span>
                                                @else
                                                    <span class="j_p_text">{{$service->jobseeker->userinformation->age}}y.o.</span>
                                                @endif
                                            </h6>
                                            <h6 class="j_p_subtitle">Kids:
                                                <span class="j_p_text">
                                                @forelse($service->jobseeker->kids as $kid)
                                                    @if(!$loop->last)
                                                        {{$kid->fullname.','}}
                                                    @else
                                                        {{$kid->fullname}}
                                                    @endif
                                                @empty 
                                                N/A
                                                @endforelse
                                                </span> 
                                            </h6>
                                            <h6 class="j_p_subtitle">Dependents:
                                                <span class="j_p_text">
                                                @forelse($service->jobseeker->dependents as $dependent)
                                                    @if(!$loop->last)
                                                        {{$dependent->fullname.','}}
                                                    @else
                                                        {{$dependent->fullname}}
                                                    @endif
                                                @empty 
                                                N/A
                                                @endforelse
                                                </span>
                                            </h6>
                                            <h6 class="j_p_subtitle">Job:
                                                @if (empty($service->jobseeker->userinformation->current_job))
                                                <span class="j_p_text">N/A</span>
                                                @else
                                                    <span class="j_p_text">{{$service->jobseeker->userinformation->current_job}}</span>
                                                @endif
                                            </h6>
                                            <h6 class="j_p_subtitle">Skills:
                                                <span class="j_p_text">
                                                @forelse($service->jobseeker->skills as $skill)
                                                    @if(!$loop->last)
                                                        {{$skill->work_skill.','}}
                                                    @else
                                                        {{$skill->work_skill}}
                                                    @endif
                                                @empty 
                                                N/A
                                                @endforelse
                                                </span>
                                            </h6>
                                            <h6 class="j_p_subtitle">Work Experience:
                                                <span class="j_p_text">
                                                @forelse($service->jobseeker->workexperiences as $workexp)
                                                    @if(!$loop->last)
                                                        {{$workexp->description.','}}
                                                    @else
                                                        {{$workexp->description}}
                                                    @endif
                                                @empty 
                                                N/A
                                                @endforelse
                                                </span>
                                            </h6>
                                        
                                   </div>    
                                    <!-- About Me -->
                                    <div class="col-sm-6 j_p_aboutme">
                                        <h3 class="j_p_header">About Me</h3>
                                        <h6 class="campaign_jobseeker_about ">
                                            @if (empty($service->jobseeker->userinformation->bio))
                                                <span style="align-items:center; justify-content:center" class="text-center" > N/A </span> 
                                            @else
                                                {{$service->jobseeker->userinformation->bio}}
                                            @endif
                                        </h6>
                                    </div>
                                    
                                </div>
                            <!-- Living State -->
                                <div class="row section_living_state">
                                    <div class="col-sm-12">
                                        <h3 class="j_p_header">Living State</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Income -->
                                    <div class="col-sm-6 section_income">
                                        <h6 class="j_p_subtitle">Average Daily Income: 
                                                @if (empty($service->jobseeker->userinformation->daily_income))
                                                    <span class="j_p_text">N/A</span>
                                                @else
                                                    <span class="j_p_text">Php {{$service->jobseeker->userinformation->daily_income}}</span>
                                                @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Main Source Income:
                                            @if (empty($service->jobseeker->userinformation->main_source_income))
                                            <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->main_source_income}}</span>
                                            @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Other Source Income:
                                            @if (empty($service->jobseeker->userinformation->extra_source_income))
                                            <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->extra_source_income}}</span>
                                            @endif
                                        </h6>
                                    </div>
                                    <!-- Expenses -->
                                    <div class="col-sm-6">
                                        <h5 class="j_p_subtitle">Average Daily Expenses: 
                                            @if (empty($service->jobseeker->userinformation->daily_expenses))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">Php {{$service->jobseeker->userinformation->daily_expenses}}</span>
                                            @endif
                                        </h5>
                                        <h6 class="j_p_subtitle">Type of Housing:
                                            @if (empty($service->jobseeker->userinformation->type_of_housing))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->type_of_housing}}</span>
                                            @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Meals per Day:
                                            @if (empty($service->jobseeker->userinformation->daily_meals))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->daily_meals}}</span>
                                            @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Water:
                                            @if (empty($service->jobseeker->userinformation->water_access))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->water_access}}</span>
                                            @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Electricity:
                                            @if (empty($service->jobseeker->userinformation->electricity_access))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->electricity_access}}</span>
                                            @endif
                                        </h6>
                                        <h6 class="j_p_subtitle">Clothes:
                                            @if (empty($service->jobseeker->userinformation->clean_clothes_access))
                                                <span class="j_p_text">N/A</span>
                                            @else
                                                <span class="j_p_text">{{$service->jobseeker->userinformation->clean_clothes_access}}</span>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                <!-- Jobseeker Profile -->
                    <!-- Header -->
                    <div class="card-header text-center">
                        <div class="row">
                            @if($service->jobseeker->avatar != '')
                                <img src="{{$service->jobseeker->avatar}}" class="rounded-circle j_p_profile" alt="" />
                            @else 
                                <img src="{{asset('/app-assets/images/avatars/noface.png')}}" class="rounded-circle j_p_profile" alt="" />
                            @endif
                        </div>
                        <div class="info">
                            <h3><strong>{{$service->jobseeker->userinformation->firstname}} {{$service->jobseeker->userinformation->lastname}} </strong></h3>
                        </div>
                    </div>
                    <!-- Body -->
                      <div class="card-body c_j_body">
                        <div class="c_j_about">
                            <h6 class="c_j_about_subhead">About Me:</h6>
                            <h6 class="campaign_jobseeker_about c_j_about_text"> 
                                @if (empty($service->jobseeker->userinformation->bio))
                                    <span style="align-items:center; justify-content:center" class="text-center" > N/A </span> 
                                @else
                                {{$service->jobseeker->userinformation->bio}}
                                @endif
                            </h6>
                        </div>
                    </div>
                <!-- </div> -->
                </div>
                <!-- Rating & Feedback - Start -->
                <div class="card c_message_section">
                    <div class="card-header text-center">
                        <div class="info c_messages">
                            <strong>Rating & Feedback</strong>
                        </div>
                    </div>
                    <div class="card-body c_messages_box">
                        <div class="c_donation_sec c_donation_text">
                        @forelse($service->backer_ratings as $rating)
                            <div class="col-md-6 s_image">
                                @for($i = 0; $i < $rating->rating; $i++)
                                    <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                @endfor
                                ({{$rating->rating}})
                            </div>
                            <h6 class="c_don_mess">
                                {{$rating->feedback}}
                            </h6>
                        @empty
                            <h6>N/A</h6>
                        @endforelse
                        </div>
                    </div>
                </div>
                <!-- Rating & Feedback - End -->
        </div>
    </div>

    <div class="container">
        <!-- Campaign Tiles - Start -->
        <div class="row pt-4">
            <div class="col-sm-12">
                <h1 class="news_taital">Support My Campaigns</h1>
            </div>
        </div>
        <div class="row pb-5">
        @forelse($campaigns as $campaign)
                <div class="col-md-3 pt-4">
                    <!-- Campaign Tile - Start -->
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="c_img"><a href="{{route('campaign_view', $campaign->id)}}">
                                    <img src="{{$campaign->thumbnail_url != '' ? $campaign->thumbnail_url : 
                                    asset('app-assets/images/pages/no-image.png')}}" class="c_img"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <a class="stretched-link" href="{{route('campaign_view', $campaign->id)}}">
                                    <h1 class="card_s_title overflow-ellipsis">{{$campaign->title}}</h1>
                                
                                    <p class="c_card_c_category overflow-ellipsis">
                                    @foreach($campaign->categories as $category)
                                    <span class="badge badge-info" style="background-color:#120a78;font-size:10px;">{{$category->name}}</span> @if(!$loop->last)@endif
                                    @endforeach
                                </p>
                                <h3 class="card_c_jname overflow-ellipsis">By : {{$campaign->jobseeker->userinformation->firstname}} {{$campaign->jobseeker->userinformation->lastname}}<hr class="hr_m"></h3>
                               
                                <div class="c_card_c_desc">{{$campaign->description}}</div>
                               
                                <div class="progress-wrapper progress_bar">
                                    <div id="example-caption-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="c_cam_raised_text">Php {{$campaign->progress->current_value}} <br>Raised</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="c_cam_target_text" style="text-align: right;">Php {{$campaign->progress->target_value}} <br>Target</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-bar-primary">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" 
                                            aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%; background-color:#120a78;" 
                                            aria-describedby="example-caption-2">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="card_c_targetd">{{date('F d, Y', strtotime($campaign->target_date))}}</p>
                                </div>
                                </a>
                                <div class="donate_btn_main">
                                    <div class="donate_btn_1"><a href="{{route('campaign_view', $campaign->id)}}">Donate Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Campaign Tile - End -->
                </div>
            @empty
            <div class="col-sm-3">
                <h3> No Campaigns Posted</h3>
            </div>
            @endforelse
        </div>
        <!-- Campaign Tiles - End -->
    </div>
    
    @forelse($services as $other)
        @if ($loop->first)
        <div class="container mb-4">
            <div class="row pt-4">
                <div class="col-sm-12">
                    <h1 class="news_taital">Avail My Other Services</h1>
                </div>
            </div>
            <div class="row">
            @endif
                <div class="col-sm-3 pt-4">
                    <!-- Service Tiles - Start -->
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c_img">
                                        <a href="{{route('service_view', $other->id)}}">
                                            <img class="c_img" src="{{$other->thumbnail_url != '' ? $other->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" >
                                        </a>
                                    </div>                        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('service_view', $other->id)}}" class="stretched-link"><h1 class="card_s_title overflow-ellipsis">{{$other->title}}</h1>
                                    <p class="card_s_category overflow-ellipsis">
                                    @foreach($other->categories as $category)
                                    <span class="badge badge-info" style="background-color:#120a78;font-size:10px;">{{$category->name}}</span> @if(!$loop->last)@endif
                                    @endforeach
                                    </p>
                                    <div class="row-md-12 s_img_jname">
                                        <div class="col-md-12 s_jname_spacing">
                                            <h3 class="s_j_name overflow-ellipsis" style="width:100%">By: {{@$other->jobseeker->userinformation->firstname}} {{@$other->jobseeker->userinformation->lastname}}</h3>
                                        </div>
                                    </div>
                                    <div class="row-md-12 s_img_jname" style="align-items:center;">
                                        @if($other->ratings > 0)
                                        <div class="s_image">
                                            @for($i = 0; $i < $other->ratings; $i++)
                                            <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                            @endfor
                                        </div>
                                        <h3 class="s_j_name ml-2" style="font-size:9px;text-align:center;align-items:center;">({{$other->ratings}})</h3>
                                        @else
                                        <h3 class="s_j_name" style="font-weight:300;font-size:9px;" >(No Rating)</h3>
                                        @endif
                                    </div>
                                    
                                    <hr class="hr_m_2">
                                    <div class="c_card_c_desc">{{$other->description}}</div>
                                    
                                    <div>
                                        <h3 class="card_s_loc"><strong>Location:</strong> {{$other->location}}</h3>
                                    </div>
                                    <div>
                                    <h3 class="card_s_loc"><strong>Duration:</strong>
                                        @if( $other->duration_hours > 1 ) {{$other->duration_hours}} Hrs @elseif( $other->duration_hours == 0 )  @else {{$other->duration_hours}} Hr @endif
                                        @if( $other->duration_minutes > 1 ) {{$other->duration_minutes}} Mins @elseif( $other->duration_minutes == 0 )  @else {{$other->duration_minutes}} Min @endif
                                    </h3>
                                    </div>
                                    <h5 class="service_price">₱{{$other->price}}</h5></a>
                                    <div class="service_btn_main mt-0">
                                        <div class="service_btn_1"><a href="{{route('service_view', $other->id)}}">Avail</a></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Service Tiles - End -->
                </div>
                
        @if ($loop->last)
            </div>
        </div>
        @endif

        @empty
    
    @endforelse
    <!-- Service Tiles - End -->
</div> 
@endsection

@section('modals')
<div class="modal fade" id="availModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header m_title_area">
          <h3 class="m_title">Avail Service</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('service.avail')}}" class="avail_form">
            @csrf
            <input type="hidden" name="service_id">
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="modal-title m_c_title"></h2>
                    </div>
                </div>
                <div class="card mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jobseeker_name">Jobseeker</label>
                                    <input type="text" name="jobseeker_name" id="jobseeker_name" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_title">Service Title</label>
                                    <input type="text" name="service_title" id="service_title" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_category">Service Category</label>
                                    <input type="text" name="service_category" id="service_category" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_price">Service Price</label>
                                    <input type="text" name="service_price" id="service_price" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_location">Service Location</label>
                                    <input type="text" name="service_location" id="service_location" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_duration">Service Duration</label>
                                    <input type="text" name="service_duration" id="service_duration" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Service Delivery Date</label>
                                    <input type="date" name="render_date" id="render_date" class="form-control">
                                    <span style="font-size:12px;color:#120a78">*Reminder: Not permitted to Cancel Order 3 Days prior to Delivery Date</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Service Delivery Location (Location where service will be rendered/delivered)</label>
                                    <input type="text" name="delivery_address" id="delivery_address" class="form-control">
                                    <!-- <select name="delivery_address" id="delivery_address" class="form-control">
                                        @foreach($regions as $region)
                                            <optgroup label="{{$region->name}}">
                                                @foreach($region->cities as $city)
                                                    <option value="{{$city->name}}, {{$region->name}}">{{$city->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select> -->
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control select2">
                                        <option value="OP">Online Payment (Available: Paypal,Credit Card,Debit Card)</option>
                                        <option value="COD">Cash on Delivery</option>
                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message (Pls. indicate any additional message/requests)</label>
                                    <textarea name="message" id="message" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-block">Avail Service!</button>
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
        var availModal = $('#availModal'), 
            availForm = $('.avail_form'),
            selectPaymentModal = $('#selectPaymentMethodModal'),
            cardPayment = $('.card-payment');
        
        $('.service_btn').on('click', async function(){
            var serviceId = $(this).data('serviceId');
            const service = await $.get(`/service/${serviceId}/details`);
            var categories = [];
            $.each(service.categories, function(index, category){
                categories.push(category.name);
            });
            availModal.find('.modal-title').text(service.title);
            availModal.find('form').find('input[name=service_id]').val(service.id);
            availModal.find('form').find('input[name=jobseeker_name]').val(service.jobseeker.information.firstname + ' ' +service.jobseeker.information.lastname);
            availModal.find('form').find('input[name=service_title]').val(service.title);
            availModal.find('form').find('input[name=service_category]').val(categories.join('/'));
            availModal.find('form').find('input[name=service_price]').val(service.currency+' '+service.price);
            availModal.find('form').find('input[name=service_location]').val(service.location);
            availModal.find('form').find('input[name=service_duration]').val(service.duration_hours+' Hour/s ' + service.duration_minutes + ' Minute/s');
            availModal.modal('show');
        });

        availForm.on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function(){
                    availForm.find('button[type=submit]').prop('disabled', true);
                    availForm.find('.invalid-feedback').remove();
                    availForm.find('.valid-feedback').remove();
                    availForm.find('.invalid-feedback.valid-feedback').remove();
                    availForm.find('input').removeClass('is-invalid');
                    availForm.find('textarea').removeClass('is-invalid');
                },
                success: function(resp){
                    if(resp.success){
                        availForm.find('button[type=submit]').prop('disabled', false);
                        availForm[0].reset();
                        availModal.modal('hide');

                        Swal.fire({
                            title: 'Success',
                            text: resp.msg,
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        })
                    }
                    if(resp.error){
                        availForm.find('button[type=submit]').prop('disabled', false);
                        availForm[0].reset();
                        availModal.modal('hide');

                        Swal.fire({
                            title: 'Error',
                            text: resp.msg,
                            icon: 'error'
                        }).then(function(){
                            location.reload();
                        })
                    }
                },
                error: function(resp){
                    $.each(resp.responseJSON.errors, function(name, error){
                        availForm.find('button[type=submit]').prop('disabled', false);
                        availForm.find('#'+name).siblings('.invalid-feedback').remove();
                        availForm.find('#'+name).siblings('.valid-feedback').remove();
                        availForm.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        availForm.find('#'+name).addClass('is-invalid');
                        availForm.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                        </div>
                        `);
                    });

                }
            });
        });

        paypal.Button.render({
            env: "{{env('PAYPAL_MODE')}}", // Or 'production'
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
                var order_data = $('#paypal-button').data();
                return actions.request.post("{{route('api.order_create_paypal')}}", {
                    order_id : order_data.orderId,
                    currency : order_data.currency
                }).then(function(res) {
                    // 3. Return res.id from the response
                    return res.id;
                });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
            // 2. Make a request to your server
            return actions.request.post("{{route('api.order_execute_paypal')}}", {
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
        
        var stripePayment = function(order_id, currency){
            var donate = { order_id, currency  };

            fetch("{{route('api.order_create_stripe')}}", {
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
                url: "{{route('api.order_confirm_stripe')}}",
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
                            text: 'Your payment was successful, Thank You!',
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
            stripePayment(data.orderId, data.currency);
        });

    });
</script>    
@endsection