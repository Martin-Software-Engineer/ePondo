@extends('landing.layouts.main')

@section('content')

@include('landing.partials.banner')

<div class="events_section layout_padding">
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

<div class="events_section layout_padding">
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

<div class="fundraise_section">
    <div class="fundraise_section_main">
        <!-- <div class="row">
            <div class="col-sm-12 d-flex justify-content-start align-items-center">
               <h1 class="news_taital">What We Offer</h1>
            </div>
        </div> -->
        <div class="row">
          <div class="col-lg-4">
             <div class="box_main">
                <div class="icon_1"><img src="images/icon-1.png"></div>
                <h4 class="volunteer_text">Create Campaign</h4>
                <p class="lorem_text">Fundraise your cause through creating a campaign on the platform</p>
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
          <div class="col-lg-4">
             <div class="box_main">
                <div class="icon_1"><img src="images/icon-3.png"></div>
                <h4 class="volunteer_text">Donate</h4>
                <p class="lorem_text">Provide support by charitably donating monetary support to the different campaigns</p>
                <div class="join_bt"><a href="#">Read More</a></div>
             </div>
          </div>
        </div>
    </div>
 </div>
@endsection

@section('scripts')
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>   
      
@endsection