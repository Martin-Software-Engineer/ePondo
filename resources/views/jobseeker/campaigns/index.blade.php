@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="mt-4"><h1>Campaigns</h1></div>
        <div><a class="btn btn-sm btn-success" href="{{ route('jobseeker.campaigns.create') }}" role="button">Create Campaign</a></div>
    </div>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Campaign ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
            <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            @foreach($campaign->campaign_categories as $campaign_category)
            @foreach($campaign->photos as $photo)
            <tr>
            <th scope="row">{{ $campaign->id }}</th>
            <td><a href="{{$campaign -> path() }}">{{ $campaign -> title }}</a></td>
            <td>{{ $campaign -> description }}</td>
            <td>{{ $campaign_category->id }}</td>
            <td>{{ $campaign_category->name }}</td>
            <td>
                    <a class="btn btn-sm btn-primary" href="{{$campaign -> path() }}" role="button">View</a>
            </td>
            <td>
                    <img src="{{Storage::disk('s3')->response('campaign/' . $photo->filename)}}" alt="">
            </td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $campaigns->links() }}
@endsection