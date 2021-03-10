@extends('landing.layouts.main')

@section('content')
<div class="events_section layout_padding">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
             <h1 class="pb-0">{{$service->title}}</h1>
             <span class="text-muted">
                 @foreach($service->categories as $category)
                    {{$category->name}} @if(!$loop->last)/@endif
                 @endforeach
             </span>
          </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('app-assets/images/banner/banner-1.jpg')}}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('app-assets/images/banner/banner-2.jpg')}}" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('app-assets/images/banner/banner-3.jpg')}}" alt="Third slide">
                      </div>
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
                      <a class="nav-link" id="jobseeker-tab" data-toggle="tab" href="#jobseeker" role="tab" aria-controls="jobseeker" aria-selected="false">Jobseeker Data</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating" aria-selected="false">Rating & Feedback</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                        <div class="card">
                            <div class="card-header">About Service</div>
                            <div class="card-body">
                                {{$service->description}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="jobseeker" role="tabpanel" aria-labelledby="jobseeker-tab">...</div>
                    <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
                    <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">...</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="card-title">{{$service->title}}</h3>
                        <p>Php {{$service->price}}</p>
                        <p>{{$service->description}}</p>

                    </div>
                    <div class="card-body">
                        <button class="btn btn-block btn-success">Avail Service</button>
                    </div>
                    <div class="card-footer d-flex justify-content-start">
                        <div class="avatar mr-2">
                            <img src="{{asset('app-assets/images/avatars/noface.png')}}" width="100" class="rounded-circle" alt="">
                        </div>
                        <div class="info">
                            <h3>Posted By</h3>
                            <h3><strong>{{$service->jobseeker->name}}</strong></h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      
@endsection