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
            <h2 class="float-left mb-0">Campaigns</h2>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <a class=" s_create_btn_2" href="{{route('jobseeker.campaigns.create')}}">Create +</a>
            
        </div>
    </div>
</section>
<section>
<div class="row match-height">
    @forelse($campaigns as $campaign)
    <div class="col-md-4 col-lg-3 mb-2">
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
                    <a class="c_card_title overflow-ellipsis" href="{{route('campaign_view', $campaign->id)}}">{{$campaign->title}}</a>
                    <p class="c_card_c_category">
                        @foreach($campaign->categories as $category)
                            {{$category->name}} @if(!$loop->last)/@endif
                        @endforeach
                    </p>
                    <div class="j_c_desc">Control No:  #{{$campaign->id}}</div>
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
                                aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%"
                                aria-describedby="example-caption-2">
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="card_c_targetd">{{date('F d, Y', strtotime($campaign->target_date))}}</p>
                    </div>
                    <div class="text-center mb-2">
                        <a class="btn btn-primary btn-sm btn-round" href="/campaign/{{$campaign->id}}" target="_blank">View</a>
                        <a href="{{route('jobseeker.campaigns.edit', $campaign->id)}}" class="btn btn-primary btn-sm btn-round">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm btn-round btn-delete" data-id="{{$campaign->id}}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-lg-12">
        <div class="card card-empty">
            <div class="card-body text-center d-flex justify-content-center align-items-center">
                <!-- Main title -->
                <h2 class="text-primary">Create your very First Campaign Post Today!</h2>
            </div>
        </div>
    </div>
    @endforelse
</div>
</section>
@endsection


@section('vendors_js')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/jquery/jquery.tagsinput.js')}}"></script>
@endsection
@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/jobseeker/campaigns.js') }}"></script>
@endsection
