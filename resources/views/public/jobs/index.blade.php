@extends('layouts.app')

@section('content')
<div class="row">
        <div class="mt-4"><h1>Public Path Services!</h1></div>
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
            @foreach($jobs as $job)
            @foreach($job->job_categories as $job_category)
            <tr>
            <td><a href="#">{{ $job -> title }}</a></td>
            <td>{{ $job -> description }}</td>
            <td>{{ $job_category->name }}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="#" role="button">View</a>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $jobs->links() }}
@endsection