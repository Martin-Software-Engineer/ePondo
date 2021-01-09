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
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            @foreach($campaign->campaign_categories as $campaign_category)
            <tr>
            <th scope="row">{{ $campaign->id }}</th>
            <td>{{ $campaign -> title }}</td>
            <td>{{ $campaign -> description }}</td>
            <td>{{ $campaign_category->id }}</td>
            <td>{{ $campaign_category->name }}</td>
            <td></td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $campaigns->links() }}
@endsection