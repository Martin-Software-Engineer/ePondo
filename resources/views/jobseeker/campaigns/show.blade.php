@extends('layouts.app')

@section('content')
    <div class="row">
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
            <div class="col-4">
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign->id}}/edit" role="button">Edit Campaign Details</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="/jobseeker/campaigns/{{$campaign -> id}}/jobs/create" class="btn btn-dark">Add Job</a>
            </div>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
            <th scope="col">Job ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            @foreach($job->job_categories as $job_category)
            <tr>
            <th scope="row">{{ $job->id }}</th>
            <td><a href="#">{{ $job -> title }}</a></td>
            <td>{{ $job -> description }}</td>
            <td>{{ $job_category->id }}</td>
            <td>{{ $job_category->name }}</td>
            <td>
                    <a class="btn btn-sm btn-primary" href="#" role="button">View Job Not Yet working</a>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $jobs->links() }}

@endsection