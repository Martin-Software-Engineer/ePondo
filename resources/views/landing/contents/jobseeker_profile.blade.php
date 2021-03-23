@extends('landing.layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile">
                <img src="{{asset('app-assets/images/avatars/noface.png')}}" alt="">
                <h5 class="profile-name">{{$user->name}}</h5>
                <p class="profile-role">
                    @foreach($user->roles as $role)
                        {{$role->name}}
                        @if(!$loop->last)
                        /
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="about">
                <p></p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="jobseeker-info">
                <h3>JOBSEEKER INFORMATION</h3>
                <div class="row jobseeker-info-details">
                    <div class="col-md-6">
                        <ul>
                            <li><b>Name:</b></li>
                            <li><b>Age:</b></li>
                            <li><b>Gender:</b></li>
                            <li><b>Birthdate:</b></li>
                            <li><b>Frequency of Work:</b></li>
                            <li><b>Main source of income:</b></li>
                            <li><b>Daily Income:</b></li>
                            <li><b>Skills:</b></li>
                            <li><b>Work Experience:</b></li>
                            <li><b>Access to Water:</b></li>
                            <li><b>Access to Clean clothes:</b></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li><b>Phone Number:</b></li>
                            <li><b>Address:</b></li>
                            <li><b>Current Job:</b></li>
                            <li><b>Employment Type:</b></li>
                            <li><b>Main source of income:</b></li>
                            <li><b>Other source of income:</b></li>
                            <li><b>Daily Expenses:</b></li>
                            <li><b>Type of Housing:</b></li>
                            <li><b>How many meals a day:</b></li>
                            <li><b>Access to Electricity:</b></li>
                            <li><b>Number of Kids:</b></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="jobseeker-campaigns">
                <h3>CAMPAIGNS</h3>
                <div class="row">
                    @forelse($campaigns as $campaign)
                        <div class="col-md-3">
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
                                    <h5 class="raised_text_1">Raised: ₱{{$campaign->donations()->sum('amount')}} <br><span class="text-danger">Goal: ₱{{$campaign->target_amount}}</span></h5>
                                    <div class="donate_btn_main">
                                        <div class="donate_btn_1"><a href="donate.html">Donate Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty 
                    @endforelse
                </div>
            </div>

            <div class="jobseeker-services">
                <h3>SERVICES</h3>
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

            <div class="jobseeker-raf">
                <h3>RATING AND FEEDBACKS</h3>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection