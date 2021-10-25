@extends('landing.layouts.main')

@section('content')
<div class="events_section layout_padding_campaignspage">
    <div class="container">
       <div class="row mb-2">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">SERVICES</h1>
          </div>
          <div class="col-sm-12">
              <div class="row">
                  <div class="col-md-8 d-flex justify-content-start">
                        <div class="dropdown dropdown-category mr-1">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{route('services')}}">All</a>
                                @foreach($categories as $category)
                                <a class="dropdown-item" href="#" data-value="{{$category->id}}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="dropdown dropdown-type mr-1">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Type
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                 <a class="dropdown-item" href="#" data-value="all">All</a>
                                 <a class="dropdown-item" href="#" data-value="latest">Latest</a>
                                 <a class="dropdown-item" href="#" data-value="popular">Popular</a>
                            </div>
                        </div>
                        <div class="dropdown dropdown-location mr-1">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Location
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item" href="#" data-value="all">All</a>
                                @foreach($regions as $region)
                                    @foreach($region->cities as $city)
                                    <a class="dropdown-item" href="#" data-value="{{$city->name}}, {{$region->name}}">{{$region->name}} - {{$city->name}}</a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                  </div>
                  <div class="col-md-4 d-flex">
                      <input type="text" name="filter_search" class="form-control" placeholder="Search">
                      <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i> Search</button>
                  </div>
              </div>
          </div>
       </div>
       <div class="row">
            @forelse($services as $service)
                <div class="col-md-3 pt-4">
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
                                <a href="{{route('service_view', $service->id)}}" class="stretched-link"><h1 class="card_s_title overflow-ellipsis">{{$service->title}}</h1>
                                <p class="card_s_category overflow-ellipsis">
                                @foreach($service->categories as $category)
                                <span class="badge badge-info" style="background-color:#120a78;font-size:10px;">{{$category->name}}</span> @if(!$loop->last)@endif
                                @endforeach
                                </p>
                                <div class="row-md-12 s_img_jname">
                                    <div class="col-md-12 s_jname_spacing">
                                        <h3 class="s_j_name overflow-ellipsis" style="width:100%">By: {{@$service->jobseeker->userinformation->firstname}} {{@$service->jobseeker->userinformation->lastname}}</h3>
                                    </div>
                                </div>
                                <div class="row-md-12 s_img_jname" style="align-items:center;">
                                    @if($service->ratings > 0)
                                    <div class="s_image">
                                        @for($i = 0; $i < $service->ratings; $i++)
                                        <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                        @endfor
                                    </div>
                                    <h3 class="s_j_name ml-2" style="font-size:9px;text-align:center;align-items:center;">({{$service->ratings}})</h3>
                                    @else
                                    <h3 class="s_j_name" style="font-weight:300;font-size:9px;" >(No Rating)</h3>
                                    @endif
                                </div>
                                
                                <hr class="hr_m_2">
                                <div class="c_card_c_desc">{{$service->description}}</div>
                                
                                <div>
                                    <h3 class="card_s_loc"><strong>Location:</strong> {{$service->location}}</h3>
                                </div>
                                <div>
                                <h3 class="card_s_loc"><strong>Duration:</strong>
                                    @if( $service->duration_hours > 1 ) {{$service->duration_hours}} Hrs @elseif( $service->duration_hours == 0 )  @else {{$service->duration_hours}} Hr @endif
                                    @if( $service->duration_minutes > 1 ) {{$service->duration_minutes}} Mins @elseif( $service->duration_minutes == 0 )  @else {{$service->duration_minutes}} Min @endif
                                </h3>
                                </div>
                                <h5 class="service_price">₱{{$service->price}}</h5></a>
                            </div>
                        </div>
                    </div>
                    <!-- Service Tiles - End -->
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="card card-empty mt-4">
                        <div class="card-body text-center d-flex justify-content-center align-items-center">
                            <!-- main title -->
                            <h1 style="color:#0f073b;font-size:30px;font-weight:500;">Sorry No Results Found!</h1>
                        </div>
                    </div>
                </div> 
            @endforelse
        </div> 
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $services->links() }}
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
            dropdownCategory = $('.dropdown-category'),
            dropdownType = $('.dropdown-type'),
            dropdownLocation = $('.dropdown-location'),
            btnSearch = $('.btn-search'),
            cardPayment = $('.card-payment');
        
        var filter = {
            category: param('category'),
            type: param('type'),
            location: param('location'),
            search: param('search')
        };

        loadFilterDefault();

        dropdownCategory.on('click', '.dropdown-item', function(){
            dropdownCategory.find('.dropdown-toggle').text($(this).text());
            filter.category = $(this).data('value');
            searchFilter(filter);
        });
        dropdownType.on('click', '.dropdown-item', function(){
            dropdownType.find('.dropdown-toggle').text($(this).text());
            filter.type = $(this).data('value');
            searchFilter(filter);
        });
        dropdownLocation.on('click', '.dropdown-item', function(){
            dropdownLocation.find('.dropdown-toggle').text($(this).text());
            filter.location = $(this).data('value');
            searchFilter(filter);
        });
        btnSearch.on('click', function(){
            filter.search = $('input[name=filter_search]').val();
            searchFilter(filter);
        });
        function loadFilterDefault(){
            if(filter.category != ''){
                var text = dropdownCategory.find('a[data-value='+filter.category+']').text();
                dropdownCategory.find('.dropdown-toggle').text(text);
            }
                
            if(filter.type != ''){
                var text = dropdownType.find('a[data-value='+filter.type+']').text();
                dropdownType.find('.dropdown-toggle').text(text);
            }
                
            if(filter.location != ''){

                var text = dropdownLocation.find('a[data-value="'+decodeURIComponent(filter.location)+'"]').text();
                dropdownLocation.find('.dropdown-toggle').text(text);
            }
                
            if(filter.search != ''){
                $('input[name=filter_search]').val(filter.search);
            }
                
            
        }
        function searchFilter(filter){
            var params = [];
            var domain = window.location.origin;
            if(filter.category != ''){
                params.push('category='+filter.category);
            }
            if(filter.type != ''){
                params.push('type='+filter.type);
            }
            if(filter.location != ''){
                params.push('location='+filter.location);
            }
            if(filter.search != ''){
                params.push('search='+filter.search);
            }

            var newUrl = domain+'/services?'+params.join('&');
            window.location.href = newUrl;
        }

        function param(name) {
            return (location.search.split(name + '=')[1] || '').split('&')[0];
        }
    });
</script>    
@endsection