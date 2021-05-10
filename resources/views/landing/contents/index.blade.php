@extends('landing.layouts.main')

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
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7"><img src="{{$campaign->thumbnail_url}}" class="img_7"></div>
                            <div class="date_bt">
                                <div class="date_text active"><a href="#">{{date('d', strtotime($campaign->target_date))}}</a></div>
                                <div class="date_text"><a href="#">{{date('M', strtotime($campaign->target_date))}}</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="give_taital_1">{{$campaign->title}}</h1>
                            <p class="ipsum_text_1">{{$campaign->description}}</p>
                            <h5 class="raised_text_1">Raised: ₱{{$campaign->raised}} <span class="goal_text">Goal: ₱{{$campaign->target_amount}}</span></h5>
                            <div class="donate_btn_main">
                                <div class="donate_btn_1"><a href="{{route('campaign_view', $campaign->id)}}">Donate Now</a></div>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7"><img src="{{$service->thumbnail_url != '' ? $service->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></div>                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="give_taital_1">{{$service->title}}</h1>
                            <p class="ipsum_text_1">{{$service->description}}</p>
                            <h5 class="raised_text_1">Price: ₱{{$service->price}} <span class="goal_text">Duration: {{$service->duration}}/Hours</span></h5>
                            <div class="donate_btn_main">
                                <div class="donate_btn_1"><a href="{{route('service_view', $service->id)}}">Avail</a></div>
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
        <div class="fundraise_img"><img src="{{asset('app-assets/images/additional_pictures/concept_model_800x400_v3.png')}}"></div>
        </div>
        
        <div class="row">
          <div class="col-lg-4">
             <div class="box_main">
             <h4 class="volunteer_text">Jobseeker</h4><div class="icon_1">
             <img src="{{asset('app-assets/images/additional_pictures/jobseeker_v3.png')}}"></div>
                <p class="lorem_text">Create Campaign & Service</p>
                <p class="lorem_text">The role of a jobseeker is to create campaigns and offer services in support to these campaigns. In return the jobseeker's campaign will be published publicly for audiences to reach.</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main">
                <h4 class="volunteer_text">Backer</h4>
                <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/backer_v3.png')}}"></div>
                <p class="lorem_text">Donate to Campaign</p>
                <p class="lorem_text">The role of a backer is to support any desired campaign. They will be able to contribute monetary support to these campaigns.</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main"> 
                <h4 class="volunteer_text">Customer</h4>
                <div class="icon_1"><img src="{{asset('app-assets/images/additional_pictures/customer_v3.png')}}"></div>
                <p class="lorem_text">Avail Service</p>
                <p class="lorem_text">The role of the customer is to be able to avail the different services offered on the platform by the different jobseekers. These services are offered in support of the jobseekers campaigns.</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
        </div>
    </div>
 </div>

 <div class="events_section layout_padding_services_carousel">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">Are you ready to start fundraising ?</h1>
          </div>
       </div>
    </div>
</div>

<div class="events_section layout_padding_campaigns_carousel">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">ePondo tool nav bar guide</h1>
          </div>
       </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>   
      
@endsection