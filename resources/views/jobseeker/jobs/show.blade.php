@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-3 mt-4">
            <h1>Job Title:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $job -> title}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-2 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $job -> description}}</p>
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