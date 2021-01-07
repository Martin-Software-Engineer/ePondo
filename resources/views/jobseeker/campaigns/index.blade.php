@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="mt-4"><h1>Campaigns</h1></div>
        <div><a class="btn btn-sm btn-success" href="{{ route('jobseeker.campaigns.create') }}" role="button">Create Campaign</a></div>
    </div>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">#ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category Id</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            
            <tr>
            <th scope="row">{{ $campaign->id }}</th>
            <td>{{ $campaign -> title }}</td>
            <td>{{ $campaign -> description }}</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            
            @endforeach
        </tbody>
    </table>

@endsection