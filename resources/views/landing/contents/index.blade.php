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
       <div class="row mt-2">
            <div class="col-sm-6 d-flex justify-content-start align-items-center ">
                <h1 class="news_taital">CAMPAIGNS</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end align-items-center">
                <a href="{{route('campaigns')}}" >Browse more ></a>
            </div>
       </div>
       <div class="row">
            @forelse($campaigns as $campaign)
                <div class="col-md-4 mb-3">
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img_7"><a href="{{route('campaign_view', $campaign->id)}}">
                                    <img src="{{$campaign->thumbnail_url != '' ? $campaign->thumbnail_url : 
                                    asset('app-assets/images/pages/no-image.png')}}" class="img_7"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="give_taital_1 overflow-ellipsis">
                                    <a href="{{route('campaign_view', $campaign->id)}}">{{$campaign->title}}</a>
                                </h1>
                                <p class="card_c_category">
                                    @foreach($campaign->categories as $category)
                                        {{$category->name}} @if(!$loop->last)/@endif
                                    @endforeach
                                </p>
                                <h3 class="card_c_jname">By : {{$campaign->jobseeker->userinformation->firstname}} {{$campaign->jobseeker->userinformation->lastname}}<hr></h3>
                                <p class="card_c_desc">{{$campaign->description}}</p>
                                <div class="progress-wrapper progress_bar">
                                    <div id="example-caption-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="campaign_raised_text">Php {{$campaign->progress->current_value}} <br>Raised</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="campaign_target_text" style="text-align: right;">Php {{$campaign->progress->target_value}} <br>Target</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-bar-primary">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" 
                                            aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%; background-color:#120a78" 
                                            aria-describedby="example-caption-2">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="card_c_targetd">{{date('F d, Y', strtotime($campaign->target_date))}}</p>
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
       <div class="row mt-2">
            <div class="col-sm-6 d-flex justify-content-start align-items-center ">
                <h1 class="news_taital">SERVICES</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end align-items-center">
                <a href="{{route('services')}}" class="ml-2">Browse more ></a>
            </div>
       </div>
       <div class="row">
            @forelse($services as $service)
                <div class="col-md-4 mb-3">
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img_7"><a href="{{route('service_view', $service->id)}}"><img src="{{$service->thumbnail_url != '' ? $service->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></a></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="give_taital_1 overflow-ellipsis"><a href="{{route('service_view', $service->id)}}">{{$service->title}}</a></h1>
                                @foreach($service->categories as $category)
                                <p class="card_c_category">
                                    
                                        {{$category->name}} @if(!$loop->last)/@endif
                                    
                                </p>
                                @endforeach

                                <div class="row-md-12 s_img_jname">
                                    <div class="col-md-6 s_jname_spacing">
                                        <h3 class="s_j_name" >By: {{$service->jobseeker->userinformation->firstname}} {{$service->jobseeker->userinformation->lastname}}</h3>
                                    </div>
                                    @if($service->ratings > 0)
                                    <div class="col-md-6 s_image">
                                        @for($i = 0; $i < $service->ratings; $i++)
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        @endfor
                                        ({{$service->ratings}})
                                    </div>
                                    @endif
                                </div>

                                <hr>
                                <p class="ipsum_text_1 ">{{$service->description}}</p>
                                
                                <div>
                                    <h3 class="s_location"><span class="s_hlocation">Location:</span> {{$service->location}}</h3>
                                </div>
                                <div>
                                <h3 class="s_duration"><span class="s_hduration">Duration:</span>
                                    @if( $service->duration_hours > 1 ) {{$service->duration_hours}} Hrs @elseif( $service->duration_hours == 0 )  @else {{$service->duration_hours}} Hr @endif
                                    @if( $service->duration_minutes > 1 ) {{$service->duration_minutes}} Mins @elseif( $service->duration_minutes == 0 )  @else {{$service->duration_minutes}} Min @endif
                                </h3>
                                </div>
                                <h5 class="service_price">₱{{$service->price}}</h5>
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
                <div class="icon_1"><img src="images/icon-1.png"></div>
                <h4 class="volunteer_text">Create Campaign</h4>
                <p class="lorem_text">Fundraise your cause through creating a campaign on the platform</p>
                <div class="join_bt"><a href="{{route('howitworks')}}#createcampaign">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="box_main"> 
                <div class="icon_3"><img src="images/icon-3.png"></div>
                <h4 class="volunteer_text">Donate</h4>
                <p class="lorem_text">Our platform is made so you can browse through our website and donate to various campaigns</p>
                <div class="join_bt"><a href="{{route('howitworks')}}#donate">Read More</a></div>
             </div>
          </div>
          <div class="col-lg-4">
            <div class="box_main">
                <div class="icon_1"><img src="images/icon-2.png"></div>
                <h4 class="volunteer_text">Avail Service</h4>
                <p class="lorem_text">Browse through the different service offerings by the jobseekers</p>
                <div class="join_bt"><a href="{{route('howitworks')}}#availservice">Read More</a></div>
             </div>
          </div>
        </div>
    </div>
</div>

 <div class="section_4_quote layout_padding_quote">
    <div class="container">
       <div class="row">
          <div class="col justify-content-start align-items-center">
              <div class="row m-0">
                <h1 class="news_taital_quote">"Giving is not just about making a donation. It is making a difference."</h1>
              </div>
              <div class="row justify-content-end m-0">
                <h1 class="news_taital_author ">- Kathy Calvin</h1>
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