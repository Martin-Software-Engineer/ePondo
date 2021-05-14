@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
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
        <div class="col-md-3">
            <a class="float-right btn btn-primary btn-round" href="{{route('jobseeker.campaigns.create')}}">Create</a>
        </div>
    </div>
</section>
<section>
<div class="row match-height">
    @forelse($campaigns as $campaign)
    <div class="col-md-4 col-lg-3">
        <div class="card text-center">
            <img class="card-img-top" src="{{Storage::url(@$campaign->thumbnail->url)}}" alt="Card image cap" />
            <div class="card-body">
                <h4 class="card-title">{{$campaign->title}}</h4>
                <p class="card-text">
                    {{$campaign->description}}
                </p>
            </div>
            <div class="card-footer">
                <div class="progress-wrapper mb-2">
                    <div id="example-caption-2">Php {{$campaign->progress->current_value}} Raised / Php {{$campaign->progress->target_value}}</div>
                    <div class="progress progress-bar-primary">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%" aria-describedby="example-caption-2"></div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-primary btn-sm btn-round" href="/campaign/{{$campaign->id}}" target="_blank">View</a>
                    <a href="{{route('jobseeker.campaigns.edit', $campaign->id)}}" class="btn btn-primary btn-sm btn-round">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm btn-round btn-delete" data-id="{{$campaign->id}}">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @empty 
    <div class="col-lg-12">
        <div class="card card-empty">
            <div class="card-body text-center d-flex justify-content-center align-items-center">
                <!-- main title -->
                <h2 class="text-primary">No Campaigns Found!</h2>
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