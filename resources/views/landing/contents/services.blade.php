@extends('landing.layouts.main')

@section('content')
<div class="events_section layout_padding">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">SERVICES</h1>
          </div>
          <div class="col-sm-12">
              <div class="row">
                  <div class="col-md-8 d-flex justify-content-start">
                        <div class="form-group mx-1">
                          <select name="category" id="" class="form-control">
                              <option value="">Category</option>
                          </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="type" id="" class="form-control">
                                <option value="">Type</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="region" id="" class="form-control">
                                <option value="">Region</option>
                            </select>
                        </div>
                  </div>
                  <div class="col-md-4">
                      <input type="text" class="form-control" placeholder="Search">
                  </div>
              </div>
          </div>
       </div>
       <div class="row">
            @forelse($services as $service)
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7"><img src="{{$service->thumbnail_url != '' ? $service->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></div>                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="give_taital_1">{{$service->title}}</h3>
                            <p class="ipsum_text_1">{{$service->description}}</p>
                            <h5 class="raised_text_1">Price: ₱{{$service->price}} <br><span class="text-danger">Duration: {{$service->duration}}/Hours</span></h5>
                            <div class="donate_btn_main">
                                <div class="donate_btn_1"><a href="donate.html">Avail</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty 
            @endforelse
        </div> 
    </div>
</div>    
@endsection