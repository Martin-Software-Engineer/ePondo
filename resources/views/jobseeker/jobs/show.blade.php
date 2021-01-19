@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-4 mt-4">
            <h1>Job Title:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $job -> title}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $job -> description}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Job Category:</h4>
        </div>
        
        <div class="col mt-4">
            @foreach($job->job_categories as $job_category)
            <p>{{ $job_category -> name }}</p>
            @endforeach
        </div>

    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Job Photos:</h4>
        </div>
        
        <div class="col mt-4">
            @foreach($job->photos as $photo)
                    <!-- <img src="{!! Storage::disk('s3')->url('campaign/' . $photo->filename) !!}" alt="c_pic" width="100" height="100"> -->
                    <img src="{{ 'https://awssoftdevmartin-epondo-images.s3-ap-southeast-1.amazonaws.com/job/' . $photo->filename }}" alt="campaign_pic" width="100" height="100" >
            @endforeach
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign}}/jobs/{{$job->id}}/edit" role="button">Edit Job Details</a>
            </div>
        </div>
    </div>

@endsection