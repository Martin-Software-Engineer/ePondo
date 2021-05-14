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
            <a class="float-right btn btn-primary btn-round" href="{{route('jobseeker.services.create')}}">Create</a>
        </div>
    </div>
</section>
<section>
<div class="row match-height">
    @forelse($services as $service)
    <div class="col-md-4 col-lg-3">
        <div class="card text-center">
            <img class="card-img-top" src="{{Storage::url(@$service->thumbnail->url)}}" alt="Card image cap" />
            <div class="card-body">
                <h4 class="card-title">{{$service->title}}</h4>
                <p class="card-text">
                    {{$service->description}}
                </p>
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
        </div>
    </div>
    @empty 
    <div class="col-lg-12">
        <div class="card card-empty">
            <div class="card-body text-center d-flex justify-content-center align-items-center">
                <!-- main title -->
                <h2 class="text-primary">No Services Found!</h2>
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