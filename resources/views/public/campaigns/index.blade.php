@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="mt-4"><h1>Public Path Campaigns!</h1></div>
    </div>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            @foreach($campaign->campaign_categories as $campaign_category)
            <tr>
            <td><a href="#">{{ $campaign -> title }}</a></td>
            <td>{{ $campaign -> description }}</td>
            <td>{{ $campaign_category->name }}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{$campaign -> publicpath() }}" role="button">View</a>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $campaigns->links() }}
@endsection