@extends('layouts.app')

@section('content')
    <div class="row flex">
        <div class="col-3 mt-4">
            <h1>Campaign Title:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $campaign -> title}}</h3>
        </div>
        
        <!-- <div><a class="btn btn-sm btn-success" href="{{ route('jobseeker.campaigns.create') }}" role="button">Create Campaign</a></div> -->
    </div>

    <div class="row">
        <div class="col-2 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $campaign -> description}}</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign->id}}/edit" role="button">Edit</a>
                <!--                                    {{ route('jobseeker.campaigns.index') }}
                                                            {{$campaign -> path() }}
                                                            {{ $campaign -> path('/$campaign->id/edit') }}
                 -->
            </div>
        </div>
    </div>

    <div class="row">
        <a href="/jobseeker/campaigns/{{$campaign -> id}}/jobs/create" class="btn btn-dark">Add Job</a>
    </div>
@endsection