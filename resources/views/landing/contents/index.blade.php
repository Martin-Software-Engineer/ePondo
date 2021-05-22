@extends('landing.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')

@include('landing.partials.banner')

<div class="events_section layout_padding_campaigns_carousel">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">CAMPAIGNS</h1>
             <a href="{{route('campaigns')}}" class="ml-2">Browse more</a>
          </div>
       </div>
       <div class="row">
            @forelse($campaigns as $campaign)
                <div class="col-md-4"  >
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img_7"><a href="{{route('campaign_view', $campaign->id)}}"><img src="{{$campaign->thumbnail_url != '' ? $campaign->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></a></div>
                                <!-- <div class="date_bt">
                                    <div class="date_text active"><a href="#">{{date('d', strtotime($campaign->target_date))}}</a></div>
                                    <div class="date_text"><a href="#">{{date('M', strtotime($campaign->target_date))}}</a></div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="give_taital_1 overflow-ellipsis"><a href="{{route('campaign_view', $campaign->id)}}">{{$campaign->title}}</a></h1>
                                <p class="ipsum_text_1 ">{{$campaign->description}}</p>
                                <div><p class="give_taital_1">Category</p></div>
                                <div class="progress-wrapper progress_bar">
                                    <div id="example-caption-2">Php {{$campaign->progress->current_value}} Raised / Php {{$campaign->progress->target_value}}</div>
                                    <div class="progress progress-bar-primary">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%" aria-describedby="example-caption-2"></div>
                                    </div>
                                </div>
                                <!-- <h5 class="raised_text_1 give_ipsum_1">Raised: ₱{{$campaign->raised}} <span class="goal_text">Goal: ₱{{$campaign->target_amount}}</span></h5> -->
                                <div class="row">
                                    <div class="col">
                                        <h5 class="raised_text_1">₱{{$campaign->progress->current_value}}<br>Raised</h5>
                                    </div>
                                    <div class="col">
                                        <h5 class="goal_text">₱{{$campaign->progress->target_value}}<br>Target</h5>
                                    </div>
                                </div>
                                <div class="donate_btn_main">
                                    <div class="donate_btn_1"><a href="{{route('campaign_view', $campaign->id)}}">Donate Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @empty 
            @endforelse
        </div> 
    </div>
</div>

<div class="events_section layout_padding_services_carousel">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">SERVICES</h1>
             <a href="{{route('services')}}" class="ml-2">Browse more</a>
          </div>
        </div>
       <div class="row">
            @forelse($services as $service)
                <div class="col-md-4">
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img_7"><a href="{{route('service_view', $campaign->id)}}"><img src="{{$service->thumbnail_url != '' ? $service->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></a></div>                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="give_taital_1 overflow-ellipsis"><a href="{{route('service_view', $campaign->id)}}">{{$service->title}}</a></h1>
                                <p class="ipsum_text_1 ">{{$service->description}}</p>
                                <div><p class="give_taital_1">Category</p></div>
                                <div><p class="give_taital_1">{{$service->location}}</p></div>
                                <div style="margin: 0 0 0 20px;"><img src="{{asset('app-assets/images/additional_pictures/star.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star.png')}}"><img src="{{asset('app-assets/images/additional_pictures/star.png')}}"></div>
                                <h5 class="service_price">Price: ₱{{$service->price}} | {{$service->duration_hours}} Hours</h5>
                                <div class="service_btn_main">
                                    <div class="service_btn_1"><a href="{{route('service_view', $service->id)}}">Avail</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty 
            @endforelse
        </div> 
    </div>
</div>

<div class="fundraise_section ">
    <div class="fundraise_section_main">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-start align-items-center">
               <h1 class="news_taital"></h1>
            </div>
        </div>
        <div class="row">
            <div class="fundraise_img align-items-start"><img src="{{asset('app-assets/images/additional_pictures/concept_model_800x400_v3.png')}}"></div>
        </div>
        
        <div class="row">
          <div class="col-lg-4">
             <div class="box_main">
                <!-- <h4 class="volunteer_text">Jobseeker</h4>
                <img src="{{asset('app-assets/images/additional_pictures/jobseeker_v3.png')}}"></div>
                <p class="lorem_text">Create Campaign & Service</p>
                <p class="lorem_text">The role of a jobseeker is to create campaigns and offer services in support to these campaigns. In return the jobseeker's campaign will be published publicly for audiences to reach.</p> -->
                <div class="icon_1"><img src="images/icon-1.png"></div>
                <h4 class="volunteer_text">Create Campaign</h4>
                <p class="lorem_text">Fundraise your cause through creating a campaign on the platform</p>
                <div class="join_bt"><a href="#">Read More</a></div>
                <!-- <p class="lorem_text">Creation of campaigns are made in order to help jobseekers raise funds for certain causes</p> -->

             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main">
                <!-- <h4 class="volunteer_text">Backer</h4>
                <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/backer_v3.png')}}"></div>
                <p class="lorem_text">Donate to Campaign</p>
                <p class="lorem_text">The role of a backer is to support any desired campaign. They will be able to contribute monetary support to these campaigns.</p> -->
                <div class="icon_1"><img src="images/icon-2.png"></div>
                <h4 class="volunteer_text">Avail Service</h4>
                <p class="lorem_text">Browse through the different service offerings by the jobseekers</p>
                <div class="join_bt"><a href="#">Read More</a></div>
                <!-- <p class="lorem_text">Backers are able to avail services produced by Jobseekers</p>
                <div class="join_bt"><a href="#">Read More</a></div> -->
             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main"> 
           <!-- <h4 class="volunteer_text">Customer</h4>
                <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/customer_v3.png')}}"></div>
                <p class="lorem_text">Avail Service</p>
                <p class="lorem_text">The role of the customer is to be able to avail the different services offered on the platform by the different jobseekers. These services are offered in support of the jobseekers campaigns.</p> -->
                <div class="icon_1"><img src="images/icon-3.png"></div>
                <h4 class="volunteer_text">Donate</h4>
                <p class="lorem_text">Our platform is made so you can browse through our website and donate to various campaigns</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
        </div>
    </div>
</div>

 <div class="section_4_quote layout_padding_quote">
    <div class="container">
       <div class="row">
          <!-- <div class="col-sm-12 d-flex justify-content-start align-items-center"> -->
          <div class="col justify-content-start align-items-center">
              <div class="row">
                <h1 class="news_taital_quote">"Giving is not just about making a donation. It is making a difference."</h1>
              </div>
              <div class="row">
                <h1 class="news_taital_quote">- Kathy Calvin</h1>
              </div>
          </div>
       </div>
    </div>
</div>

<div class="section_5_footernav layout_padding_footernav">
    <div class="container">
       <div class="row">
          <div class="col-sm-3 d-flex justify-content-start align-items-start">
             <div class="about_img"><img src="{{asset('app-assets/images/additional_pictures/navbar_logo.png')}}"></div>
          </div>
          <div class="col-sm-3 d-flex justify-content-start align-items-start ">
             <ul>
                <li><h4 class="footernav_heading_text">CAMPAIGNS</h4></li>
                <li>Education</li>
                <li>Medical and Health</li>
                <li>Animals</li>
                <li>Non-Profit and Charity</li>
                <li>Memorial and Funeral</li>
                <li>Emergencies</li>
             </ul>
          </div>
          <div class="col-sm-3 d-flex justify-content-start align-items-start ">
          <ul>
                <li><h4 class="footernav_heading_text">SERVICES</h4></li>
                <li>Education</li>
                <li>Personal & Home Care</li>
                <li>Storekeeper</li>
                <li>Food</li>
             </ul>
          </div>
          <div class="col-sm-3 d-flex justify-content-start align-items-start ">
          <ul>
                <li><h4 class="footernav_heading_text">How it works ?</h4></li>
                <li>About Us</li>
                <li>What is crowdfunding ?</li>
             </ul>
          </div>
       </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>   
      
@endsection