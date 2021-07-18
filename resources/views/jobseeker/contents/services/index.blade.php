@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('stylesheets')
    <style>
        .card-empty{
            background-size: cover;
            background-color: rgba(115, 103, 240, 0.12) !important;
        }
    </style>
@endsection
@section('content')
<section>
    <div class="row mb-2">
        <div class="col-md-9">
            <h2 class="float-left mb-0">Services</h2>
        </div>
        <div class="col-md-3">
            <!-- <a class="float-right btn btn-primary btn-round" href="{{route('jobseeker.services.create')}}">Create</a> -->
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <a class=" s_create_btn_2" href="{{route('jobseeker.services.create')}}">Create +</a>
            
        </div>
    </div>
</section>
<section>
<div class="row match-height">
    @forelse($services as $service)
    <div class="col-md-4 col-lg-3">
        <!-- <div class="card text-center">
            <img class="card-img-top" src="{{Storage::url(@$service->thumbnail->url)}}" alt="Card image cap" />
            <div class="card-body">
                <h1 class="card-title overflow-ellipsis">{{$service->title}}</h1>
                <p class="card-text ipsum_text_1">{{$service->description}}</p>
            </div>
            <div class="card-footer">
                <div class="progress-wrapper mb-2">
                    <div id="example-caption-2">Php {{number_format($service->price)}} / Hour</div>
                </div>
                <div class="text-center">
                    <a class="btn btn-primary btn-sm btn-round" href="/service/{{$service->id}}" target="_blank">View</a>
                    <a href="{{route('jobseeker.services.edit', $service->id)}}" class="btn btn-primary btn-sm btn-round">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm btn-round btn-delete" data-id="{{$service->id}}">Delete</button>
                </div>
            </div>
        </div> -->
        <!-- Service Tiles - Start -->
        <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="c_img">
                                    <a href="{{route('service_view', $service->id)}}">
                                        <img class="c_img" src="{{$service->thumbnail_url != '' ? $service->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" >
                                    </a>
                                </div>                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="give_taital_1 overflow-ellipsis"><a href="{{route('service_view', $service->id)}}">{{$service->title}}</a></h1>
                                @foreach($service->categories as $category)
                                <p class="card_s_category">
                                        {{$category->name}} @if(!$loop->last)/@endif
                                </p>
                                @endforeach

                                <!-- <div class="row-md-12 s_img_jname">
                                    <div class="col-md-6 s_jname_spacing">
                                        <h3 class="s_j_name" >By: {{$service->jobseeker->userinformation->firstname}} {{$service->jobseeker->userinformation->lastname}}</h3>
                                    </div>
                                    <div class="col-md-6 s_image">
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        (5)
                                    </div>
                                    
                                </div> -->
                                
                                <!-- <div class="s_card_s_desc"><hr class="hr_m_2">{{$service->description}}</div> -->
                                <div class="j_c_desc">Control No:  #{{$service->id}}</div>
                                
                                <div>
                                    <!-- <h3 class="s_location" style="font-weight: normal;"><span style="font-weight:600">Location:</span> {{$service->location}}</h3>  -->
                                    <h3 class="s_card_s_loc"><hr><span class="s_hlocation">Location:</span> {{$service->location}}</h3>
                                </div>
                                <div>
                                <h3 class="s_duration"><span class="s_hduration">Duration:</span>
                                    @if( $service->duration_hours > 1 ) {{$service->duration_hours}} Hrs @elseif( $service->duration_hours == 0 )  @else {{$service->duration_hours}} Hr @endif
                                    @if( $service->duration_minutes > 1 ) {{$service->duration_minutes}} Mins @elseif( $service->duration_minutes == 0 )  @else {{$service->duration_minutes}} Min @endif
                                </h3>
                                </div>
                                <h5 class="service_price">₱{{$service->price}}</h5>
                                <!-- <div class="service_btn_main">
                                    <div class="service_btn_1"><a href="{{route('service_view', $service->id)}}">Avail</a></div>
                                </div> -->
                                <div class="text-center mb-2">
                                    <a class="btn btn-primary btn-sm btn-round" href="/service/{{$service->id}}" target="_blank">View</a>
                                    <a href="{{route('jobseeker.services.edit', $service->id)}}" class="btn btn-primary btn-sm btn-round">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm btn-round btn-delete" data-id="{{$service->id}}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Service Tiles - End -->
    </div>
    @empty 
    <div class="col-lg-12">
        <div class="card card-empty">
            <div class="card-body text-center d-flex justify-content-center align-items-center">
                <!-- main title -->
                <h2 class="text-primary">Create your very First Service Post Today!</h2>
            </div>
        </div>
    </div>
    @endforelse
</div>
</section>    
@endsection


@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/jobseeker/services.js') }}"></script>    
@endsection